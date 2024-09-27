<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Redirect;
use DB;
use Auth;
use Validator;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Statutorys;
use App\Task_managements;
use Helper; 
use Image;
use Illuminate\Support\Facades\Cookie;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
	public function getBankDetails(Request $request)
    {
        $uid = Auth::user()->id;
        $Get_financial_year = $request->Get_financial_year;

        // Parse the financial year into start and end dates
        $financial_year_dates = explode('-', $Get_financial_year);
        $start_date = $financial_year_dates[0] . '-04-01';
        $end_date = ($financial_year_dates[1]) . '-03-31';

        $allBanks = DB::table('banks')
                    ->where('id', '=', $request->id)
                    ->get();
        
        // Get bank credit debits details
        $credit_debits = DB::table('cash_credit_debits')
                        ->select(
                            DB::raw('IFNULL(FORMAT(SUM(CASE WHEN cd_type = "cr" THEN cd_amount ELSE 0 END), 2), "00.00") as total_credit'),
                            DB::raw('IFNULL(FORMAT(SUM(CASE WHEN cd_type = "dr" THEN cd_amount ELSE 0 END), 2), "00.00") as total_debit'),
                            DB::raw('IFNULL(FORMAT((SUM(CASE WHEN cd_type = "cr" THEN cd_amount ELSE 0 END) - SUM(CASE WHEN cd_type = "dr" THEN cd_amount ELSE 0 END)), 2), "00.00") as total_balance')
                        )
                        ->where('added_by', '=', $uid)
                        ->where('statement_id', '=', $request->id)
                        ->whereBetween('cd_date', [$start_date, $end_date])
                        ->first();


            $total_loan = DB::table('loans')
                        ->where('added_by', '=', $uid)
                        ->where('bank_name', '=', $request->id)
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->sum('credit_limit');
            



        
        if ($allBanks->isNotEmpty()) {
            return response()->json([
                'bank_name' => $allBanks[0]->bank_name,
                'bank_ac_no' => $allBanks[0]->bank_ac_no,
                'accholder_name' => $allBanks[0]->accholder_name,
                'ifsc_code' => $allBanks[0]->ifsc_code,
                'bank_branch' => $allBanks[0]->bank_branch,
                'swift_code' => $allBanks[0]->swift_code,
                'credit_debits' => $credit_debits,
                'total_loan' => $total_loan ? number_format($total_loan, 2) : '00.00'
                
            ]);
        } else {
            return response()->json([
                'error' => 'Bank not found'
            ], 404);
        }
    }



    public function getMonthlyData(Request $request)
    {
        $uid = Auth::user()->id;
        
        // Get the selected financial year from the request
        $SelectFinincialYear = $request->input('financial_year'); 
        list($startYear, $endYear) = explode('-', $SelectFinincialYear);

        $startDate = "$startYear-04-01"; // Financial year starts from April 1st
        $endDate = ($endYear + 1) . "-03-31"; // Financial year ends on March 31st of the next year

        // Fetch data grouped by month and calculate total receipts and expenses
        $creditDebits = DB::table('cash_credit_debits')
                    ->select(
                        DB::raw("SUM(CASE WHEN cd_type = 'cr' THEN cd_amount ELSE 0 END) as total_credit"),
                        DB::raw("SUM(CASE WHEN cd_type = 'dr' THEN cd_amount ELSE 0 END) as total_debit"),
                        DB::raw("MONTH(cd_date) as month")
                    )
                    ->where('added_by', '=', $uid)
                    ->whereBetween('cd_date', [$startDate, $endDate]) 
                    ->groupBy(DB::raw("MONTH(cd_date)"))
                    ->orderBy(DB::raw("MONTH(cd_date)"))  // Ensures correct month ordering
                    ->get();
                
                $receivedData = array_fill(1, 12, 0); 
                $expensesData = array_fill(1, 12, 0);
                $totalReceipts = 0;
                $totalExpenses = 0;
                
                foreach ($creditDebits as $cd) {
                    // Adjust month for financial year (e.g., Apr = 1, May = 2, ..., Mar = 12)
                    $financialMonth = ($cd->month - 3) <= 0 ? ($cd->month + 9) : ($cd->month - 3);
                    
                    $receivedData[$financialMonth] = $cd->total_credit;
                    $expensesData[$financialMonth] = $cd->total_debit;
                
                    // Accumulate totals
                    $totalReceipts += $cd->total_credit;
                    $totalExpenses += $cd->total_debit;
                }
                
                // Convert data to a format suitable for the chart
                $receivedDataFormatted = array_values($receivedData);
                $expensesDataFormatted = array_values($expensesData);
                
                return response()->json([
                    'received' => $receivedDataFormatted,
                    'expenses' => $expensesDataFormatted,
                    'total_receipts' => number_format($totalReceipts, 2), 
                    'total_expenses' => number_format($totalExpenses, 2)  
                ]);
    }


    public function getStatutoryData(Request $request) {
        $uid = Auth::user()->id;
    
        // Get the selected financial year from the request (e.g., '2024-2025')
        $SelectFinincialYear = $request->input('financial_year'); 
        list($startYear, $endYear) = explode('-', $SelectFinincialYear);
    
        // Define the start and end date for the financial year
        $startDate = "$startYear-04-01 00:00:00"; 
        $endDate = "$endYear-03-31 23:59:59"; 
    
        // Fetch the statutory data with financial year and exact date filter
        $statutory_data = DB::table('statutorys')
                            ->select(DB::raw('statutorys.*, company_profiles.comp_name, ca_assigns.ca_id'))
                            ->leftJoin('company_profiles', 'statutorys.compId', '=', 'company_profiles.userId')
                            ->leftJoin('ca_assigns', 'statutorys.compId', '=', 'ca_assigns.comp_id')
                            ->where('statutorys.compId', '=', $uid) 
                            ->where('ca_assigns.ca_assign_status', '=', 1)
                            ->whereBetween('statutorys.created_at', [$startDate, $endDate]) 
                            ->orderBy('id', 'DESC')
                            ->take(10)
                            ->get();
    
        // Return empty array if no data matches the criteria
        if ($statutory_data->isEmpty()) {
            return response()->json([]);
        }
    
        // Return the fetched data if matches are found
        return response()->json([
            'received' => $statutory_data,
        ]);
    }
    
    public function getCustomerData(Request $request){
        $uid = Auth::user()->id;
    
        // Get current week's start and end dates
        $currentWeekStart = \Carbon\Carbon::now()->startOfWeek();
        $currentWeekEnd = \Carbon\Carbon::now()->endOfWeek();
    
        // Get last week's start and end dates
        $lastWeekStart = \Carbon\Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = \Carbon\Carbon::now()->subWeek()->endOfWeek();
    
        // Count customers added this week
        $currentWeekCustomers = DB::table('customers')
                                ->where('userId', '=', $uid)
                                ->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])
                                ->count();
    
        // // Count customers added last week
        $lastWeekCustomers = DB::table('customers')
                                ->where('userId', '=', $uid)
                                ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                                ->count();

                            
    
        // Calculate the percentage change
        if ($lastWeekCustomers == 0) {
            if ($currentWeekCustomers > 0) {
                $percentageChange = 100; 
            } else {
                $percentageChange = 0; 
            }
        } else {
            $percentageChange = (($currentWeekCustomers - $lastWeekCustomers) / $lastWeekCustomers) * 100;
        }
    
        // Get the total number of customers
        $totalCustomers = DB::table('customers')
                            ->where('userId', '=', $uid)
                            ->count();
    
        return response()->json([
            'total_customers' => $totalCustomers,
            'current_week_customers' => $currentWeekCustomers,
            'percentage_change' => $percentageChange,
            
        ]);
    }
    
    public function getMonthlyturnoverData(Request $request)
    {
        $uid = Auth::user()->id;
        $SelectFinincialYear = $request->input('financial_year'); 
        list($startYear, $endYear) = explode('-', $SelectFinincialYear);

        // Define the start and end date for the financial year
        $startDate = "$startYear-04-01 00:00:00"; 
        $endDate = "$endYear-03-31 23:59:59"; 

        // Fetch month-wise sales data within the specified financial year
        $monthlyData = DB::table('sales')
                        ->join('sales_values', 'sales.id', '=', 'sales_values.sid')
                        ->leftJoin('vouchers', 'sales.inv_num', '=', 'vouchers.invoice_number')
                        ->select(
                            DB::raw('DATE_FORMAT(sales.created_at, "%Y-%m") as month'),
                            DB::raw('SUM(sales_values.amount + sales_values.tax_amt) as base_total'),
                            DB::raw('SUM(
                                CASE
                                    WHEN vouchers.note_type = "Credit" THEN vouchers.adjusted_amount
                                    WHEN vouchers.note_type = "Debit" THEN -vouchers.adjusted_amount
                                    ELSE 0
                                END
                            ) as adjusted_total'),
                            DB::raw('SUM(sales_values.amount + sales_values.tax_amt +
                                CASE
                                    WHEN vouchers.note_type = "Credit" THEN vouchers.adjusted_amount
                                    WHEN vouchers.note_type = "Debit" THEN -vouchers.adjusted_amount
                                    ELSE 0
                                END
                            ) as total_amount')
                        )
                        ->where('sales.added_by', $uid)
                        ->whereBetween('sales.created_at', [$startDate, $endDate])
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        // Return the monthly total amounts
        return response()->json($monthlyData);
    }

    // public function getReceivablesData(Request $request){
    //     $uid = Auth::user()->id;
    //     $SelectFinancialYear = $request->input('financial_year'); 
    //     $MonthName = $request->input('Month'); 
    //     list($startYear, $endYear) = explode('-', $SelectFinancialYear);
    
    //     // Convert month name to month number
    //     $monthNumbers = [
    //         'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
    //         'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
    //         'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
    //     ];
    //     $Month = $monthNumbers[$MonthName];
    
    //     // Define the start and end date for the financial year
    //     $startDate = "$startYear-04-01 00:00:00"; 
    //     $endDate = "$endYear-03-31 23:59:59"; 
    
    //     // Calculate unpaid bills based on the provided month and year
    //     $unpaidBills = DB::table('sales')
    //         ->where('added_by', $uid)
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->whereMonth('created_at', '=', $Month) 
    //         ->where(function($query) use ($startYear, $endYear) {
    //             $query->whereYear('created_at', $startYear)
    //                   ->orWhereYear('created_at', $endYear);
    //         })
    //         ->where(function($query) {
    //             $query->where('pay_status', 'Partial')
    //                   ->orWhere('pay_status', 'Due');
    //         })
    //         ->get();
    
    //     $partialSum = 0;
    //     $dueSum = 0;
        
    
    //     foreach ($unpaidBills as $bill) {
    //         if ($bill->pay_status === 'Partial') {
    //             $partialSum += $bill->due_amount;
    //         } elseif ($bill->pay_status === 'Due') {
    //             $dueSum += DB::table('sales_values')
    //                         ->where('sid', $bill->id)
    //                         ->sum(DB::raw('amount + tax_amt'));
    //         }
    //     }
    //     $totalUnpaid = $partialSum + $dueSum;

    //     //---------------- Current and Overdue Calculation -------------





    
    //     return response()->json([
    //         'partial_sum' => number_format($partialSum, 2, '.', ''),
    //         'due_sum' => number_format($dueSum, 2, '.', ''),
    //         'total_unpaid' => number_format($totalUnpaid, 2, '.', ''),
    //     ]);
    // }

    public function getReceivablesData(Request $request){
        $uid = Auth::user()->id;
        $SelectFinancialYear = $request->input('financial_year'); 
        $MonthName = $request->input('Month'); 
        list($startYear, $endYear) = explode('-', $SelectFinancialYear);
    
        // Convert month name to month number
        $monthNumbers = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];
        $Month = $monthNumbers[$MonthName];
    
        // Define the start and end date for the financial year
        $startDate = "$startYear-04-01 00:00:00"; 
        $endDate = "$endYear-03-31 23:59:59"; 
    
        // Calculate unpaid bills based on the provided month and year
        $unpaidBills = DB::table('sales')
            ->where('added_by', $uid)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereMonth('created_at', '=', $Month) 
            ->where(function($query) use ($startYear, $endYear) {
                $query->whereYear('created_at', $startYear)
                      ->orWhereYear('created_at', $endYear);
            })
            ->where(function($query) {
                $query->where('pay_status', 'Partial')
                      ->orWhere('pay_status', 'Due');
            })
            ->get();
    
        $partialSum = 0;
        $dueSum = 0;
        $totalPayment = 0; 
        $totalDuePayment = 0;
    
        foreach ($unpaidBills as $bill) {
            if ($bill->pay_status === 'Partial') {
                $partialSum += $bill->due_amount;
                $totalPayment += $bill->advance_amount;  // Sum advance amount for Partial payments
            } elseif ($bill->pay_status === 'Due') {
                $dueSum += DB::table('sales_values')
                            ->where('sid', $bill->id)
                            ->sum(DB::raw('amount + tax_amt'));
            }
        }
    
        // Calculate the total payment for "Full" status
        $fullPayments = DB::table('sales')
                    ->where('added_by', $uid)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->whereMonth('created_at', '=', $Month)
                    ->where(function($query) use ($startYear, $endYear) {
                        $query->whereYear('created_at', $startYear)
                                ->orWhereYear('created_at', $endYear);
                    })
                    ->where('pay_status', 'Full')
                    ->get();
    
        foreach ($fullPayments as $payment) {
            $totalPayment += DB::table('sales_values')
                                ->where('sid', $payment->id)
                                ->sum(DB::raw('amount + tax_amt'));
        }
    
        $totalUnpaid = $partialSum + $dueSum;

        //------------- Due Payment ------ 
            $currentMonth = date('m'); 
            $currentYear = date('Y');  

            $duePayments = DB::table('sales')
                            ->where('added_by', $uid)
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->where('pay_status', 'Due')
                            ->where(function($query) use ($currentMonth, $currentYear) {
                                $query->where(function($query) use ($currentMonth, $currentYear) {
                                    $query->whereYear('created_at', '<>', $currentYear)
                                        ->orWhere(function($query) use ($currentMonth) {
                                            $query->whereYear('created_at', date('Y'))
                                                    ->whereMonth('created_at', '<>', $currentMonth);
                                        });
                                });
                            })
                            ->get();

            foreach ($duePayments as $paymentDue) {
                $totalDuePayment += DB::table('sales_values')
                                    ->where('sid', $paymentDue->id)
                                    ->sum(DB::raw('amount + tax_amt'));
            }
    
        return response()->json([
            'partial_sum' => number_format($partialSum, 2, '.', ''),
            'due_sum' => number_format($dueSum, 2, '.', ''),
            'total_unpaid' => number_format($totalUnpaid, 2, '.', ''),
            'total_payment_receivables' => number_format($totalPayment, 2, '.', ''),  
            'total_over_due_receivables' => number_format($totalDuePayment, 2, '.', ''),  
        ]);
    }
    
    
    public function getPayablesData(Request $request){
        $uid = Auth::user()->id;
        $SelectFinancialYear = $request->input('financial_year'); 
        $MonthName = $request->input('Month'); 
        list($startYear, $endYear) = explode('-', $SelectFinancialYear);
    
        // Convert month name to month number
        $monthNumbers = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];
        $Month = $monthNumbers[$MonthName];
    
        // Define the start and end date for the financial year
        $startDate = "$startYear-04-01 00:00:00"; 
        $endDate = "$endYear-03-31 23:59:59"; 

        // Calculate unpaid bills based on the provided month and year
        $unpaidBills = DB::table('purchases')
                    ->where('added_by', $uid)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->whereMonth('created_at', '=', $Month) 
                    ->where(function($query) use ($startYear, $endYear) {
                        $query->whereYear('created_at', $startYear)
                            ->orWhereYear('created_at', $endYear);
                    })
                    ->where(function($query) {
                        $query->where('pay_status', 'Partial')
                            ->orWhere('pay_status', 'Due');
                    })
                    ->get();
    
        $partialSum = 0;
        $dueSum = 0;
        $totalPayment = 0; 
        $totalDuePayment = 0;
    
        foreach ($unpaidBills as $bill) {
            if ($bill->pay_status === 'Partial') {
                $partialSum += $bill->due_amount;
                $totalPayment += $bill->advance_amount;  // Sum advance amount for Partial payments
            } elseif ($bill->pay_status === 'Due') {
                $dueSum += DB::table('purchase_values')
                            ->where('sid', $bill->id)
                            ->sum(DB::raw('amount + tax_amt'));
            }
        }
        $totalUnpaid = $partialSum + $dueSum;

        // Calculate the total payment for "Full" status
        $fullPayments = DB::table('purchases')
                    ->where('added_by', $uid)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->whereMonth('created_at', '=', $Month)
                    ->where(function($query) use ($startYear, $endYear) {
                        $query->whereYear('created_at', $startYear)
                                ->orWhereYear('created_at', $endYear);
                    })
                    ->where('pay_status', 'Full')
                    ->get();
    
        foreach ($fullPayments as $payment) {
            $totalPayment += DB::table('purchase_values')
                                ->where('sid', $payment->id)
                                ->sum(DB::raw('amount + tax_amt'));
        }

        $currentMonth = date('m'); 
            $currentYear = date('Y');  

            $duePayments = DB::table('purchases')
                            ->where('added_by', $uid)
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->where('pay_status', 'Due')
                            ->where(function($query) use ($currentMonth, $currentYear) {
                                $query->where(function($query) use ($currentMonth, $currentYear) {
                                    $query->whereYear('created_at', '<>', $currentYear)
                                        ->orWhere(function($query) use ($currentMonth) {
                                            $query->whereYear('created_at', date('Y'))
                                                    ->whereMonth('created_at', '<>', $currentMonth);
                                        });
                                });
                            })
                            ->get();

            foreach ($duePayments as $paymentDue) {
                $totalDuePayment += DB::table('purchase_values')
                                    ->where('sid', $paymentDue->id)
                                    ->sum(DB::raw('amount + tax_amt'));
            }




        return response()->json([
            'partial_sum_Payables' => number_format($partialSum, 2, '.', ''),
            'due_sum_Payables' => number_format($dueSum, 2, '.', ''),
            'total_unpaid_Payables' => number_format($totalUnpaid, 2, '.', ''),
            'total_payment_Payables' => number_format($totalPayment, 2, '.', ''),  
            'total_over_due_Payables' => number_format($totalDuePayment, 2, '.', ''),
            
        ]);


    }
    
    
    
    
    





}
