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
use App\Task_managements;
use App\Company_profiles;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class CaDashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function getCustomerPayment(Request $request) {
        $uid = Auth::user()->id;
        $select_ca_financial_year = $request->select_ca_financial_year;
        $customer_payment_month = $request->customer_payment_month;
    
        // Parse the financial year into start and end dates
        $financial_year_dates = explode('-', $select_ca_financial_year);
        $start_date = $financial_year_dates[0] . '-04-01';
        $end_date = $financial_year_dates[1] . '-03-31';
    
        // Map month name to month number
        $monthNumbers = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];
        $Month = $monthNumbers[$customer_payment_month];
    
        // Query to calculate earnings, received, pending, and overdue
        $results = DB::table('task_managements')
            ->select(
                DB::raw('IFNULL(SUM(total_amount), 0.00) as total_earning'),
                DB::raw('IFNULL(SUM(advance_payment), 0.00) as total_received'),
                DB::raw('IFNULL(SUM(due_amount), 0.00) as total_pending'),
                DB::raw('IFNULL(SUM(CASE WHEN due_date < NOW() - INTERVAL 1 MONTH THEN due_amount ELSE 0 END), 0.00) as total_overdue')
            )
            ->where('added_by', $uid)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereMonth('created_at', $Month)
            ->first();
    
        return response()->json([
            
            'total_earning' => $results->total_earning,
            'total_received' => $results->total_received,
            'total_pending' => $results->total_pending,
            'total_overdue' => $results->total_overdue,
        ]);
    }
    
    public function getTaskStatus(Request $request) {
        $uid = Auth::user()->id;
        $select_ca_financial_year = $request->select_ca_financial_year;
        $task_status_month = $request->task_status_month;
    
        // Parse the financial year into start and end dates
        $financial_year_dates = explode('-', $select_ca_financial_year);
        $start_date = $financial_year_dates[0] . '-04-01';
        $end_date = $financial_year_dates[1] . '-03-31';
    
        // Map month name to month number
        $monthNumbers = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];
        $Month = $monthNumbers[$task_status_month];
    
        // Create a Carbon instance for the selected month
        $startOfMonth = \Carbon\Carbon::create($financial_year_dates[0], $Month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
    
        // Query the task_managements table with a join on users to get client names
        $tasks = DB::table('task_managements')
            ->join('users', 'task_managements.company_id', '=', 'users.id')
            ->where('task_managements.added_by', $uid)
            ->whereBetween('task_managements.task_date', [$start_date, $end_date])
            ->whereMonth('task_managements.task_date', $Month)
            ->select('task_managements.*', 'users.name as client_name') 
            ->get();
    
        // Total Tasks
        $totalTasks = $tasks->count();
    
        // Completed Tasks (project_status = 3)
        $completedTasks = $tasks->where('project_status', 3)->count();
    
        // Pending Tasks (project_status = 1)
        $pendingTasks = $tasks->where('project_status', 1)->count();
    
        // Overdue Tasks
        $overdueTasks = $tasks->filter(function ($task) {
            return \Carbon\Carbon::parse($task->due_date)->lt(\Carbon\Carbon::now()->subMonth());
        })->count();
    
        return response()->json([
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'pending_tasks' => $pendingTasks,
            'overdue_tasks' => $overdueTasks,
            'tasks' => $tasks 
        ]);
    }
    
    public function getTaskClient(Request $request) {
        $uid = Auth::user()->id;
        $select_ca_financial_year = $request->financialYear;
    
        // Parse the financial year into start and end dates
        $financial_year_dates = explode('-', $select_ca_financial_year);
        $start_date = $financial_year_dates[0] . '-04-01';
        $end_date = $financial_year_dates[1] . '-03-31';
    
        // Fetch the users where 'ca_add_by' = $uid and 'u_type' = 2
        $users = DB::table('users')
            ->where('ca_add_by', $uid)
            ->where('u_type', 2)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
    
        $serviceCounts = [
            'Company Incorporation' => 0,
            'Company Compliances' => 0,
            'ROC Return' => 0,
            'Accounts Preparation' => 0,
            'GST & Taxation' => 0,
            'Auditing' => 0,
            'Auditor Recruitment' => 0,
            'Income Tax Return' => 0,
            'TDS' => 0,
            'PF & ESIC' => 0,
            'P-tax' => 0,
            'Project Report / DPR with CMA Data' => 0,
            'Outsourcing of work' => 0,
            'Outsourcing of employee' => 0,
            'Other' => 0
        ];
    
        foreach ($users as $user) {
            // Fetch the company profile where 'userId' = 'users.id'
            $companyProfile = DB::table('company_profiles')
                ->where('userId', $user->id)
                ->first();
    
            if ($companyProfile) {
                // Explode the 'compincorp' field into an array of services
                $services = explode(',', $companyProfile->compincorp);
    
                // Count each service occurrence
                foreach ($services as $service) {
                    $service = trim($service);
                    if (array_key_exists($service, $serviceCounts)) {
                        $serviceCounts[$service]++;
                    } else {
                        $serviceCounts['Other']++;
                    }
                }
            }
        }
    
        return response()->json([
            'serviceCounts' => $serviceCounts,
        ]);
    }
    
    public function getMonthWishClient(Request $request)
    {
        $uid = Auth::user()->id;
        $select_ca_financial_year = $request->finincialYear;

        // Parse the financial year into start and end dates
        $financial_year_dates = explode('-', $select_ca_financial_year);
        $start_date = $financial_year_dates[0] . '-04-01';
        $end_date = $financial_year_dates[1] . '-03-31';

        $task_status_month = $request->selectMonth;

        // Map month name to month number
        $monthNumbers = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];
        $month = $monthNumbers[$task_status_month];

        $customersQuery = DB::table('users')
            ->select(DB::raw('users.*,ca_assigns.ca_assign_status,ca_assigns.ca_current_status,
                company_profiles.comp_logo,company_profiles.comp_name,company_profiles.comp_bill_addone,
                company_profiles.comp_bill_country,company_profiles.comp_bill_state,
                company_profiles.comp_bill_city,company_profiles.comp_bill_pin'))
            ->leftJoin('company_profiles', 'users.id', '=', 'company_profiles.userId')
            ->leftJoin('ca_assigns', 'users.id', '=', 'ca_assigns.comp_id')
            ->where('users.u_type', '=', 2)
            ->where('ca_assigns.ca_assign_status', '=', 1)
            ->where('ca_assigns.ca_current_status', '!=', 0)
            ->whereMonth('ca_assigns.created_at', '=', $month)
            ->whereBetween('ca_assigns.created_at', [$start_date, $end_date]);

        // Count requested assignments (ca_add_by = 0)
        $requestedAssignCount = clone $customersQuery;
        $requestedAssignCount = $requestedAssignCount->where('users.ca_add_by', '=', 0)->count();

        // Count own assignments (ca_add_by = 1)
        $ownAssignCount = clone $customersQuery;
        $ownAssignCount = $ownAssignCount->where('users.ca_add_by', '!=', 0)->count();

        // Total assignments
        $totalAssignCount = clone $customersQuery;
        $totalAssignCount = $totalAssignCount->count();

        return response()->json([
            
            'requested_assign' => $requestedAssignCount,
            'own_assign' => $ownAssignCount,
            'total_assign' => $totalAssignCount,
        ]);
    }

    public function getMonthWishPayment(Request $request){
        $uid = Auth::user()->id;
        $select_ca_financial_year = $request->finincialYear;
    
        // Parse the financial year into start and end dates
        $financial_year_dates = explode('-', $select_ca_financial_year);
        $start_date = $financial_year_dates[0] . '-04-01';
        $end_date = $financial_year_dates[1] . '-03-31';
    
        $task_status_month = $request->month_payment_status_month;
    
        // Map month name to month number
        $monthNumbers = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];
        $month = $monthNumbers[$task_status_month];
    
        // Query the task_managements table
        $query = DB::table('task_managements')
            ->select(
                DB::raw('IFNULL(SUM(gov_fees), 0) as total_gov_fees_paid'),
                DB::raw('IFNULL(SUM(total_amount), 0) as total_amount_received'),
                DB::raw('IFNULL(SUM(due_amount), 0) as total_payment_due')
            )
            ->where('added_by', $uid)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereMonth('created_at', $month)
            ->first();
    
        // Format the values to return "00.00" if they are zero
        $total_gov_fees_paid = $query->total_gov_fees_paid > 0 ? number_format($query->total_gov_fees_paid, 2) : "00.00";
        $total_amount_received = $query->total_amount_received > 0 ? number_format($query->total_amount_received, 2) : "00.00";
        $total_payment_due = $query->total_payment_due > 0 ? number_format($query->total_payment_due, 2) : "00.00";
    
        return response()->json([
            
            'total_gov_fees_paid' => $total_gov_fees_paid,
            'total_amount_received' => $total_amount_received,
            'total_payment_due' => $total_payment_due,
        ]);
    }
    
    
    
    
    
}


