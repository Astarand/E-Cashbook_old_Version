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
use App\Expenses;
use App\Expense_cats;
use App\Expense_cat_options;
use App\Income;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class IncomeController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $incomes = Income::where('addBy', $userId)
                        ->orderBy('id', 'desc')
                        ->get();
        //$this->middleware('auth');
        return view('pages.income')->with('incomes', $incomes);
    }

    public function addincome()
    {
        //$this->middleware('auth');
        return view('pages.addincome')->with([

        ]);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        // Validate the form data
        // $request->validate([
        //     'dateInput' => 'required|date',
        //     'amount' => 'required|numeric|max:255',
        //     'categoryIncome' => 'required|string',
        // ]);

        try {
            // Create a new Income record
            $income = new Income();
            $income->addBy = $userId;
            $income->dateInput = $request->input('dateInput');
            $income->categoryIncome = $request->input('categoryIncome');
            $income->amount = $request->input('amount');
            $income->specification = $request->input('specification');

            // Save 'other_income' only if 'Other Income' category is selected
            if ($request->input('categoryIncome') == 'Other Income') {
                $income->other_income = $request->input('other_income');
            } else {
                $income->other_income = null;
            }

            // Save the income record
            $income->save();

            
            // Redirect with success message
            return redirect('/income')->with('success', 'Income details saved successfully!');
        } catch (\Exception $e) {
            //print_r($e->getMessage());
            // Log the error for debugging purposes (optional)
            //\Log::error('Income saving failed: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to save income details. Please try again.');
        }
    }


    public function getViewIncome($id){
        
        $decodedId = base64_decode($id);

        $income = Income::find($decodedId);
        
        if (!$income) {
            return redirect()->back()->with('error', 'Income record not found.');
        }

        return view('pages.viewIncome', compact('income'));

    }
    public function editIncome($id){
        
        $decodedId = base64_decode($id);

        $income = Income::find($decodedId);
        
        if (!$income) {
            return redirect()->back()->with('error', 'Income record not found.');
        }

        return view('pages.editIncome', compact('income'));

    }

    public function updateIncome(Request $request)
    {
        // Find the income record by ID
        $income = Income::find($request->id);

        
        if ($income) {
            $income->dateInput = $request->input('dateInput');
            $income->categoryIncome = $request->input('categoryIncome');
            $income->amount = $request->input('amount');
            $income->specification = $request->input('specification');
            $income->other_income = $request->input('other_income', null);

            $income->save();

            //return redirect()->back()->with('success', 'Income record updated successfully.');
            // return redirect()->route('income.index')->with('success', 'Income record updated successfully.');
            return redirect('/income')->with('success', 'Income details saved successfully!');
        } else {
            
            return redirect()->back()->with('error', 'Income record not found.');
        }
    }

    public function getIncomeData(Request $request)
    {
        $userId = Auth::user()->id;

        $incomeType = $request->input('incomeType');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

            $fullPayments = DB::table('sales')
                            ->where('added_by', $userId)
                            ->whereBetween('created_at', [$fromDate, $toDate])
                            // ->where('pay_status', 'Full')
                            ->get();
            
                $totalIncome =0;
                
            foreach ($fullPayments as $payment) {
                
                    $totalIncome += DB::table('sales_values')
                                    ->where('sid', $payment->id)
                                    ->sum(DB::raw('amount + tax_amt'));
                
            }

        if ($incomeType == 'gross_income') {
            
            $incomeType='Gross Income';
            $income = $totalIncome;
        } else {
            $vouchers = DB::table('vouchers')
                            ->where('added_by', $userId)
                            ->where('note_type', 'Credit')
                            ->whereBetween('created_at', [$fromDate, $toDate])
                            ->sum(DB::raw('credit_debit_amount + adjusted_amount'));
                            // ->where('pay_status', 'Full')
                            //->get();
            
        
                            // ->where('pay_status', 'Full')
            $total_discound = '0';
                    foreach ($fullPayments as $payment) {
        
                        $total_discound += DB::table('sales_values')
                                        ->where('sid', $payment->id)
                                        ->sum('disc_amt');;
                    
                            }
                            
            
            
            $income = $totalIncome - ($vouchers + $total_discound);
            $incomeType='Net Income';
        }

        return response()->json(['income' => number_format($income, 2, '.', ''), 'incomeType'=> $incomeType]);
    }



}