<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Country;
use App\City;


/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);

Route::get('/', 'HomeController@index');
Route::get('/userlogin', 'HomeController@login');
Route::get('/logout', 'HomeController@logout');
Route::get('/signup', 'HomeController@register');
Route::get('/about-us', 'HomeController@about_us');
Route::post('/register/user', 'HomeController@registerUser');
Route::post('/login/user', 'HomeController@loginUser');
Route::get('/forgotpassword', 'HomeController@forgotpassword');
Route::post('/save_forgotpassword', 'HomeController@save_forgotpassword');

Route::get('/getState', 'CompanyProfileController@getState');
Route::get('/getCity', 'CompanyProfileController@getCity');



Auth::routes();
Route::group(['middleware' => ['auth','SubscriberStatus']],function(){
	//Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/charterd', 'ChaterdController@index');
	Route::get('/items', 'ItemsController@index');
	Route::get('/additem', 'ItemsController@additem');

	Route::get('/vendors', 'VendorController@index');
	Route::get('/addvendor', 'VendorController@addvendor');
	Route::get('/edit-vendor/{vendorId}', 'VendorController@edit_vendor');
	Route::post('/update_vendor', 'VendorController@update_vendor');
	Route::post('/saveaddvendor', 'VendorController@saveaddvendor');
	Route::get('/view-vendor/{vendorId}', 'VendorController@view_vendor');
	Route::get('deleteVendor', 'VendorController@deleteVendor');

	Route::get('/projects', 'ProjectController@index');
	Route::get('/addproject', 'ProjectController@addproject');

	//Designation Controller
	Route::get('/designation', 'DesignationController@index');
	Route::get('/adddesignation', 'DesignationController@adddesignation');
	//End of Designation Controller

	//Sales Controller
	Route::get('/sales-invoice', 'SalesController@salesInvoiceIndex');
	Route::get('/add-sales-invoice', 'SalesController@addSalesInvoice');
	Route::get('/sales-credit-debit', 'SalesController@CreditDebitIndex');
	Route::get('/add-sales-credit-debit', 'SalesController@addCreditDebit');
	//End of Sales Controller

	//Purchase Controller
	Route::get('/purchase-invoice', 'PurchaseController@PurchaseInvoiceIndex');
	Route::get('/add-purchase-invoice', 'PurchaseController@addPurchaseInvoice');
	Route::get('/purchase-credit-debit', 'PurchaseController@CreditDebitIndex');
	Route::get('/add-purchase-credit-debit', 'PurchaseController@addCreditDebit');
	//End of Purchase Controller

	//Asset Controller
	Route::get('/assets', 'FixedAssetController@FixedAssetIndex');
	Route::get('/addasset', 'FixedAssetController@addFixedAsset');
	Route::get('/asset-voucher', 'FixedAssetController@AssetVoucherIndex');
	Route::get('/add-asset-voucher', 'FixedAssetController@addAssetVoucher');
	//End of Asset Controller
	Route::get('/superadmin', 'AdminHomeController@index');
	//Statutory Controller

	//End of Statutory Controller
	//GST 
	Route::get('/gst', 'GSTController@Index');
	//Payment Controller
	Route::get('/payment', 'PaymentController@index');
	Route::get('/addpayment', 'PaymentController@addpayment');
	Route::get('/viewmonthpayment', 'PaymentController@viewmonthpayment');
	Route::post('/savepayment', 'PaymentController@savepayment');
	Route::get('/view-payment/{paymentId}', 'PaymentController@view_payment');
	Route::get('/edit-payment/{payId}', 'PaymentController@edit_payment');
	Route::get('/viewmonthpayment/{monthWise}/{custId}', 'PaymentController@viewmonthpayment');
	Route::post('/update_payment', 'PaymentController@update_payment');
	Route::get('delPayment', 'PaymentController@delPayment');
	//End of Payment Controller

	//Expenses Controller
	Route::get('/expenses', 'ExpensesController@index');
	Route::get('/addexpenses', 'ExpensesController@addexpenses');
	Route::get('/viewmonthexpenses/{monthWise}/{added_by}', 'ExpensesController@viewmonthexpenses');
	//End of Expenses Controller

	//Cash & Bank Controller
	Route::get('/banks', 'CashController@BankIndex');
	Route::get('/addbank', 'CashController@addBank');
	Route::get('/bank-statement', 'CashController@BankStatement');
	Route::get('/add-bank-transaction', 'CashController@AddBankTransaction');

	Route::get('/loans', 'CashController@LoanIndex');
	Route::get('/addloan', 'CashController@addLoan');



	Route::get('/cash', 'CashController@CashIndex');
	Route::get('/add-cash-credit', 'CashController@CashCredit');
	Route::get('/add-cash-debit', 'CashController@CashDebit');
	//End of Cash & Bank Controller

	


	//CA Panel

	//CA Panel

	//Dashboard
	Route::get('/cahome', 'CaHomeController@Index');
	//CA Profile
	Route::get('/caprofile', 'CaProfileController@Index');
	//Client
	Route::get('/client', 'ClientController@Index');
	Route::get('/addclient', 'ClientController@AddClient');
	Route::get('/editclient/{clientId}', 'ClientController@EditClient');
	Route::get('/client-view/{custId}', 'ClientController@ClientDetails');
	Route::post('/update_client', 'ClientController@update_client');
	Route::post('/save_client', 'ClientController@save_client');
	//Customer Assignment
	Route::get('/customerassignment', 'CustomerAssignmentController@Index');
	Route::get('/assignment-details', 'CustomerAssignmentController@AssignmentDetails');
	//Employee
	Route::get('/employee', 'EmployeeController@Index');
	Route::get('/addemployee', 'EmployeeController@AddEmployee');

	//Commission Management
	Route::get('/commission','CommissionController@Index');
	Route::get('/comm-payout','CommissionController@CommissonPayout');
	//Task
	Route::get('/task', 'TaskController@Index');
	Route::get('/addtask', 'TaskController@AddTask');
	Route::post('/save_task', 'TaskController@save_task');
	Route::get('/edit-task/{taskId}', 'TaskController@edit_task');
	Route::get('/view-task/{taskId}', 'TaskController@view_task');
	Route::post('/update_task', 'TaskController@update_task');
	Route::get('delTask', 'TaskController@delTask');
	Route::post('getcat', 'TaskController@getcat');
	//Reminder
	Route::get('/reminder', 'ReminderController@Index');
	//Payments
	Route::get('/capayments', 'CaPaymentsController@Index');
	//Quote Set
	Route::get('/quote', 'QuoteController@Index');
	Route::get('/addquote', 'QuoteController@AddQuote');
	Route::post('/save_quote', 'QuoteController@save_quote');
	Route::get('/edit-quote/{quoteId}', 'QuoteController@edit_quote');
	Route::post('/update_quote', 'QuoteController@update_quote');
	Route::get('delQuote', 'QuoteController@delQuote');

	//Agent
	Route::get('/agent', 'AgentController@Index');
	Route::get('/addagent', 'AgentController@AddAgent');

	//Liabilities Controller
	Route::get('/liabilities', 'LiabilitiesController@Index');
	Route::get('/addliabilities', 'LiabilitiesController@AddLiabilities');

	//Super Admin Panel

	//Dashboard
	Route::get('/superadmin', 'AdminHomeController@index');

	//CA Portal
	Route::get('/caportal', 'AdminCAController@caportal');


	//Customer Portal
	Route::get('/customerportal', 'AdminCustomerController@customerportal');


	//Subscription
	Route::get('/subscribers', 'SubscriptionController@Subscribers');
	Route::get('/plans', 'SubscriptionController@Plans');
	Route::get('/addplans', 'SubscriptionController@AddPlans');

	//TicketList
	Route::get('/caticketlist', 'TicketController@CATicketList');
	Route::get('/customerticketlist', 'TicketController@CustomerTicketList');
	Route::get('/ticket', 'TicketController@Ticket');

	//Business& Earning
	Route::get('/business', 'BusinessController@EarningIndex');	
	Route::get('/business_ca/{userId}', 'BusinessController@businessCA')->name('business_ca');
	Route::get('/get/business_earning', 'BusinessController@getBusinessEarning')->name('get.business_earning');
	Route::get('/get/ca_firm', 'BusinessController@getCaFirm')->name('get.ca_firm');
	Route::get('/get/cardData', 'BusinessController@getCardData')->name('get.cardData');
	

	//Payment Management
    Route::get('/transaction', 'PaymentManagementController@PaymentManagementIndex');
    // Route::get('/transaction_ca', 'PaymentManagementController@PaymentManagementCA');
    // Route::get('/get/ca_transaction_data', 'paymentmanagementcontroller@getca_transaction_data')->name('get.ca_transaction_data');
    // Route::get('/get/cus_transaction_data', 'paymentmanagementcontroller@getcus_transaction_data')->name('get.cus_transaction_data');


    Route::get('/get/ca_transaction_data', 'PaymentManagementController@getca_transaction_data')->name('get.ca_transaction_data');
    Route::get('/get/cus_transaction_data', 'PaymentManagementController@getcus_transaction_data')->name('get.cus_transaction_data');
	//------ Khokan ------------
	Route::get('/transaction_ca/{userId}', 'PaymentManagementController@PaymentManagementCA')->name('transaction_ca');
	Route::post('/payment_ca_data', 'PaymentManagementController@payment_ca_data')->name('payment_ca_data');
	Route::get('/comp_transactions_invoice/{uid}', 'PaymentManagementController@getcomp_tran_invoice');
	Route::post('/comp_refund_data', 'PaymentManagementController@storeRefundData')->name('comp_refund_data');
	//CA Reminder
	Route::get('/ca-reminder', 'ReminderController@Index');

	Route::get('/reset-password','ResetPasswordController@create');
	Route::post('/reset-password','ResetPasswordController@store')->name('reset.password.store');
	Route::get('/companyprofile', 'CompanyProfileController@index');
	Route::post('/update_compdet', 'CompanyProfileController@update_compdet');
	Route::post('/update_businessdet', 'CompanyProfileController@update_businessdet');
	Route::post('/update_bankdet', 'CompanyProfileController@update_bankdet');
	Route::post('/update_comp_attachment', 'CompanyProfileController@update_comp_attachment');
	Route::get('/customers', 'CustomerController@index');
	Route::get('/addcustomer', 'CustomerController@addcustomer');
	Route::post('/add_customer', 'CustomerController@add_customer');

	Route::get('/edit-customer/{custId}', 'CustomerController@edit_customer');
	Route::post('/update_customer', 'CustomerController@update_customer');
	Route::get('/view-customer/{custId}', 'CustomerController@view_customer');
	Route::get('changeStatus', 'CustomerController@changeStatus');
	Route::get('delCustomer', 'CustomerController@delCustomer');

	

	Route::post('/choose_ca', 'ChaterdController@choose_ca');
	Route::post('/register_ca', 'ChaterdController@register_ca');
	Route::get('/ca-requested', 'CaRequestController@index');
	Route::get('completeStatus', 'CaRequestController@completeStatus');
	Route::get('isEmailStatus', 'CaRequestController@isEmailStatus');
	Route::get('isWhatsappStatus', 'CaRequestController@isWhatsappStatus');
	Route::get('/our-ca', 'OurCaController@index');
	Route::get('/add-ca', 'OurCaController@add_ca');
	Route::get('/edit-ca/{caId}', 'OurCaController@edit_ca');
	Route::post('/update_ca', 'OurCaController@update_ca');
	Route::get('/updateCaStatus', 'OurCaController@updateCaStatus');
	Route::post('/register_our_ca', 'OurCaController@register_our_ca');
	Route::post('/assign_ca', 'ChaterdController@assign_ca');
	Route::post('/get_ca_set_permission', 'CaRequestController@get_ca_set_permission');

	Route::post('/save_add_item', 'ItemsController@save_add_item');
	Route::get('/edit-item/{itemId}', 'ItemsController@edit_item');
	Route::post('/update_item', 'ItemsController@update_item');
	Route::get('delItem', 'ItemsController@delItem');
	Route::get('/view-item/{itemId}', 'ItemsController@view_item');
	
	//added on 29-10-2023
	Route::post('/save_add_project', 'ProjectController@save_add_project');
	Route::get('/edit-project/{projId}', 'ProjectController@edit_project');
	Route::post('/update_project', 'ProjectController@update_project');
	Route::get('delProject', 'ProjectController@delProject');
	Route::get('/view-project/{projId}', 'ProjectController@view_project');
	Route::get('changeProjectStatus', 'ProjectController@changeProjectStatus');
	
	//added on 05-11-2023
	Route::post('/save_add_asset', 'FixedAssetController@save_add_asset');
	Route::get('/edit-asset/{assetId}', 'FixedAssetController@edit_asset');
	Route::post('/update_asset', 'FixedAssetController@update_asset');
	Route::get('delAsset', 'FixedAssetController@delAsset');
	Route::get('/view-asset/{assetId}', 'FixedAssetController@view_asset');
	
	Route::post('/save_add_voucher', 'FixedAssetController@save_add_voucher');
	Route::get('/edit-asset-voucher/{vId}', 'FixedAssetController@edit_asset_voucher');
	Route::get('/view-asset-voucher/{vId}', 'FixedAssetController@view_asset_voucher');
	Route::post('/update_voucher', 'FixedAssetController@update_voucher');
	Route::get('delAssetVoucher', 'FixedAssetController@delAssetVoucher');
	Route::post('/save_add_series_name', 'FixedAssetController@save_add_series_name');
	
	//added on 11-11-2023
	Route::post('/save_sales_invoice', 'SalesController@save_sales_invoice');
	Route::get('/edit-sales-invoice/{sId}', 'SalesController@edit_sales_invoice');
	Route::get('/view-sales-invoice/{sId}', 'SalesController@view_sales_invoice');
	Route::post('/update_sales_invoice', 'SalesController@update_sales_invoice');
	Route::post('/sales_items_display', 'SalesController@sales_items_display');
	Route::post('/delSalesItem', 'SalesController@delSalesItem');
	Route::post('/update_sales_item', 'SalesController@update_sales_item');
	Route::post('/update_sales_item_quantity', 'SalesController@update_sales_item_quantity');
	Route::post('/update_sales_item_rate', 'SalesController@update_sales_item_rate');
	Route::post('/update_sales_invoice_final', 'SalesController@update_sales_invoice_final');
	Route::get('/delInvoice', 'SalesController@delInvoice');
	Route::get('/activateStatus', 'SalesController@activateStatus');
	Route::get('getinvcust', 'SalesController@getinvcust');
	Route::post('/update_sales_customer', 'SalesController@update_sales_customer'); //added on 01-04-2024
	Route::post('/update_sales_other', 'SalesController@update_sales_other'); //added on 01-04-2024
	Route::post('/getProductType', 'SalesController@getProductType');	//added on 01-04-2024
	Route::post('/getProduct', 'SalesController@getProduct');	//added on 01-04-2024
	
	//added on 12-11-2023
	Route::post('/save_sales_invoice_creditdebit', 'SalesController@save_sales_invoice_creditdebit');
	Route::get('/edit-sales-credit-debit/{sId}', 'SalesController@edit_sales_invoice_credit_debit');
	Route::get('/view-sales-credit-debit/{sId}', 'SalesController@view_sales_invoice_credit_debit');
	Route::post('/update_sales_invoice_creditdebit', 'SalesController@update_sales_invoice_creditdebit');
	Route::post('/sales_items_display_creditdebit', 'SalesController@sales_items_display_creditdebit');
	Route::post('/delSalesItemCreditDebit', 'SalesController@delSalesItemCreditDebit');
	Route::post('/update_sales_item_creditdebit', 'SalesController@update_sales_item_creditdebit');
	Route::post('/update_sales_item_quantity_creditdebit', 'SalesController@update_sales_item_quantity_creditdebit');
	Route::post('/update_sales_item_rate_creditdebit', 'SalesController@update_sales_item_rate_creditdebit');
	Route::post('/update_sales_invoice_final_creditdebit', 'SalesController@update_sales_invoice_final_creditdebit');
	Route::get('/delInvoiceCreditDebit', 'SalesController@delInvoiceCreditDebit');
	Route::get('/activateSalesCreditDebitStatus', 'SalesController@activateSalesCreditDebitStatus');
	Route::get('/paidInvCreditDebit', 'SalesController@paidInvCreditDebit');
	Route::get('/invoice-pdf/{id}', 'SalesController@getPdfSales');
	Route::get('/invoice-credit-debit-pdf/{id}', 'SalesController@getPdfSalesCreditDebit');
	
	
	Route::post('/save_purchase_invoice', 'PurchaseController@save_purchase_invoice');
	Route::get('/edit-purchase-invoice/{sId}', 'PurchaseController@edit_purchase_invoice');
	Route::get('/view-purchase-invoice/{sId}', 'PurchaseController@view_purchase_invoice');
	Route::post('/update_purchase_invoice', 'PurchaseController@update_purchase_invoice');
	Route::post('/purchase_items_display', 'PurchaseController@purchase_items_display');
	Route::post('/delPurchaseItem', 'PurchaseController@delPurchaseItem');
	Route::post('/update_purchase_item', 'PurchaseController@update_purchase_item');
	Route::post('/update_purchase_item_quantity', 'PurchaseController@update_purchase_item_quantity');
	Route::post('/update_purchase_item_rate', 'PurchaseController@update_purchase_item_rate');
	Route::post('/update_purchase_invoice_final', 'PurchaseController@update_purchase_invoice_final');
	Route::get('/delInvoicePurchase', 'PurchaseController@delInvoicePurchase');
	Route::get('/activateStatusPurchase', 'PurchaseController@activateStatusPurchase');
	Route::get('/purchase-invoice-pdf/{id}', 'PurchaseController@getPdfPurchase');
	
	Route::post('/save_purchase_invoice_creditdebit', 'PurchaseController@save_purchase_invoice_creditdebit');
	Route::get('/edit-purchase-credit-debit/{sId}', 'PurchaseController@edit_purchase_invoice_credit_debit');
	Route::get('/view-purchase-credit-debit/{sId}', 'PurchaseController@view_purchase_invoice_credit_debit');
	Route::post('/update_purchase_invoice_creditdebit', 'PurchaseController@update_purchase_invoice_creditdebit');
	Route::post('/purchase_items_display_creditdebit', 'PurchaseController@purchase_items_display_creditdebit');
	Route::post('/delPurchaseItemCreditDebit', 'PurchaseController@delPurchaseItemCreditDebit');
	Route::post('/update_purchase_item_creditdebit', 'PurchaseController@update_purchase_item_creditdebit');
	Route::post('/update_purchase_item_quantity_creditdebit', 'PurchaseController@update_purchase_item_quantity_creditdebit');
	Route::post('/update_purchase_item_rate_creditdebit', 'PurchaseController@update_purchase_item_rate_creditdebit');
	Route::post('/update_purchase_invoice_final_creditdebit', 'PurchaseController@update_purchase_invoice_final_creditdebit');
	Route::get('/delPurchaseCreditDebit', 'PurchaseController@delPurchaseCreditDebit');
	Route::get('/activatePurchaseCreditDebitStatus', 'PurchaseController@activatePurchaseCreditDebitStatus');
	Route::get('/paidPurchaseCreditDebit', 'PurchaseController@paidPurchaseCreditDebit');
	Route::get('/purchase-credit-debit-pdf/{id}', 'PurchaseController@getPdfPurchaseCreditDebit');
	Route::post('/update_seller_details', 'PurchaseController@update_seller_details');	//added on 01-04-2024
	Route::post('/update_purchase_other', 'PurchaseController@update_purchase_other');	//added on 01-04-2024
	
	//added on 25-11-2023
	Route::post('/save_expenses', 'ExpensesController@save_expenses');
	Route::get('/edit-expenses/{eId}', 'ExpensesController@edit_expenses');
	Route::get('/view-expenses/{eId}', 'ExpensesController@view_expenses');
	Route::post('/update_expenses', 'ExpensesController@update_expenses');
	Route::get('/getExpenseOptions', 'ExpensesController@getExpenseOptions');
	Route::get('/delExpenses', 'ExpensesController@delExpenses');
	
	Route::get('/statutory', 'StatutoryController@statutory');
	Route::get('/addstatutory', 'StatutoryController@addstatutory');
	Route::get('/editstatutory/{sId}', 'StatutoryController@editstatutory');
	Route::get('/viewstatutory/{sId}', 'StatutoryController@viewstatutory');
	Route::post('/save_statutory', 'StatutoryController@save_statutory');
	Route::post('/update_statutory', 'StatutoryController@update_statutory');
	
	Route::get('/chat-response/{caId}/{uid}/{id}', 'StatutoryController@chat_response');
	Route::post('/upload_file','MessageController@upload_file');
	Route::post('/insert_chat','MessageController@insert_chat');
	Route::post('/fetch_user_chat_history/{from_user_id}/{to_user_id}','MessageController@fetch_user_chat_history');
	
	//added on 02-12-2023
	Route::post('/save_bank', 'CashController@save_bank');
	Route::get('/edit-bank/{bankId}', 'CashController@edit_bank');
	Route::post('/update_bank', 'CashController@update_bank');
	Route::get('/bank-statement/{bankId}', 'CashController@BankStatement');
	Route::get('/add-bank-transaction/{loanId}', 'CashController@AddBankTransaction');
	Route::post('/save_transaction', 'CashController@save_transaction');

	Route::post('/save_loan', 'CashController@save_loan');
	Route::get('/edit-loan/{loanId}', 'CashController@edit_loan');
	Route::get('/loan-statement/{loanId}', 'CashController@LoanStatement');
	Route::post('/update_loan', 'CashController@update_loan');
	Route::post('/update_cashinhand', 'CashController@update_cashinhand');
	
	Route::get('/add-loan-installment/{loanId}', 'CashController@AddLoanInstallment');
	Route::post('/save_installment', 'CashController@save_installment');
	Route::get('/edit-installment/{loanId}', 'CashController@edit_installment');
	Route::get('/view-installment/{loanId}', 'CashController@view_installment');
	Route::post('/update_installment', 'CashController@update_installment');
	Route::get('/delInstallment', 'CashController@delInstallment');
	
	Route::post('/save_cash_credit', 'CashController@save_cash_credit');
	Route::post('/update_cash_credit', 'CashController@update_cash_credit');
	Route::get('/edit-cash-credit/{cId}', 'CashController@edit_cash_credit');
	Route::get('/view-cash-credit/{cId}', 'CashController@view_cash_credit');
	Route::post('/save_cash_debit', 'CashController@save_cash_debit');
	Route::post('/update_cash_debit', 'CashController@update_cash_debit');
	Route::get('/edit-cash-debit/{cId}', 'CashController@edit_cash_debit');
	Route::get('/view-cash-debit/{cId}', 'CashController@view_cash_debit');
	
	Route::get('/bank-statement-upload', 'CashController@bank_statement_upload');
	Route::post('/uploadBank_statement', 'CashController@uploadBank_statement');
	
	Route::get('/view-all-notification', 'NotificationController@index');
	
	//added on 16-12-2023
	Route::post('/update_comp_logo', 'CompanyProfileController@update_comp_logo');
	Route::post('/delete_comp_logo', 'CompanyProfileController@delete_comp_logo');
	
	Route::post('/update_comp_logo_ca', 'CaProfileController@update_comp_logo_ca');
	Route::post('/delete_comp_logo_ca', 'CaProfileController@delete_comp_logo_ca');
	Route::post('/update_compdet_ca', 'CaProfileController@update_compdet_ca');
	Route::post('/update_ca_speclization', 'CaProfileController@update_ca_speclization');
	Route::post('/update_bankdet_ca', 'CaProfileController@update_bankdet_ca');
	Route::post('/update_partner_ca', 'CaProfileController@update_partner_ca');
	Route::post('/update_ca_attachment', 'CaProfileController@update_ca_attachment');
	
	Route::get('/changeCustomerStatus', 'ClientController@changeCustomerStatus');
	Route::post('/clearNotification', 'NotificationController@clearNotification');
	
	Route::post('/viewCustomerDet', 'CustomerAssignmentController@viewCustomerDet');
	Route::get('/acceptCustomerStatus', 'CustomerAssignmentController@acceptCustomerStatus');
	
	//added on 23-12-2023
	
	Route::post('/save_agent', 'AgentController@save_agent');
	Route::get('/edit-agent/{agentId}', 'AgentController@edit_agent');
	Route::post('/update_agent', 'AgentController@update_agent');
	Route::get('/agent-view/{agentId}', 'AgentController@AgentDetails');
	Route::get('changeAgentStatus', 'AgentController@changeAgentStatus');
	Route::get('delAgent', 'AgentController@delAgent');
	
	//Assign request chart
	Route::post('/getAssignRequestChart', 'CustomerAssignmentController@getAssignRequestChart');
	
	//added on 25-12-2023
	Route::post('/save_employee', 'EmployeeController@save_employee');
	Route::get('/edit-employee/{empId}', 'EmployeeController@edit_employee');
	Route::post('/update_employee', 'EmployeeController@update_employee');
	Route::get('/view-employee/{empId}', 'EmployeeController@view_employee');
	Route::get('changeEmployeeStatus', 'EmployeeController@changeEmployeeStatus');
	Route::get('delEmployee', 'EmployeeController@delEmployee');
	Route::get('/getDesignationOptions', 'EmployeeController@getDesignationOptions');
	
	Route::post('/add_depertment', 'EmployeeController@add_depertment');
	Route::post('/add_designation', 'EmployeeController@add_designation');
	
	//added on 07-01-2024
	Route::post('/company_task_list', 'ReminderController@company_task_list');
	Route::post('/send_bulk_message', 'ReminderController@send_bulk_message');
	Route::get('/getPaymentOptions', 'PaymentController@getPaymentOptions');
	
	Route::post('/saveLiabilities', 'LiabilitiesController@saveLiabilities');
	Route::get('/edit-liabilities/{liabId}', 'LiabilitiesController@edit_liabilities');
	Route::post('/updateLiabilities', 'LiabilitiesController@updateLiabilities');
	Route::get('delLiabilities', 'LiabilitiesController@delLiabilities');
	Route::post('/save_baseUnit', 'ItemsController@save_baseUnit');
	
	Route::get('/item-history/{itemId}', 'ItemsController@item_history');
	Route::post('/update_stock_other', 'ItemsController@update_stock_other');
	
	//admin section
	Route::get('/caStatus', 'AdminCAController@caStatus');
	Route::get('/cadetails/{caId}', 'AdminCAController@cadetails');
	Route::get('/customerprofile/{cId}', 'AdminCustomerController@customerprofile');
	
	Route::get('/messages/{uId}', 'AdminMessagesController@index');
	Route::post('/send_message', 'AdminMessagesController@send_message');
	
	Route::get('/admin-employee', 'AdminEmployeeController@Index');
	Route::get('/addadminemployee', 'AdminEmployeeController@AddAdminEmployee');
	Route::post('/save_admin_employee', 'AdminEmployeeController@save_admin_employee');
	Route::get('/edit-admin-employee/{empId}', 'AdminEmployeeController@edit_admin_employee');
	Route::post('/update_admin_employee', 'AdminEmployeeController@update_admin_employee');
	Route::get('/view-admin-employee/{empId}', 'AdminEmployeeController@view_admin_employee');
	Route::get('changeAdminEmployeeStatus', 'AdminEmployeeController@changeAdminEmployeeStatus');
	Route::get('delAdminEmployee', 'AdminEmployeeController@delAdminEmployee');
	Route::get('/getAdminDesignationOptions', 'AdminEmployeeController@getAdminDesignationOptions');
	
	Route::post('/add_admin_depertment', 'AdminEmployeeController@add_admin_depertment');
	Route::post('/add_admin_designation', 'AdminEmployeeController@add_admin_designation');
	Route::post('/assign_unassign_ca', 'AdminCAController@assign_unassign_ca');
	
	Route::post('/save_plan', 'SubscriptionController@save_plan');
	Route::post('/update_plan', 'SubscriptionController@update_plan');
	Route::get('/editplan/{id}', 'SubscriptionController@edit_plan');
	
	Route::get('/invoice', 'InvoiceController@Index');
	Route::get('/sales-invoice-pdf/{id}/{invType}', 'InvoiceController@getSalesInvoice');
	Route::post('/tally_credit_debit', 'CashController@tally_credit_debit');
	Route::get('/edit-bank-transaction/{id}', 'CashController@edit_transaction');
	Route::get('/view-bank-transaction/{id}', 'CashController@view_transaction');
	Route::post('/userLists', 'ReminderController@userLists');
	Route::post('/sendReminder', 'ReminderController@sendReminder');
	Route::get('/profit-loss', 'ReportController@profit_loss');
	Route::post('/gen_profit_loss', 'ReportController@gen_profit_loss');
	
	
	
});

Route::get('/subscriber-plans', 'SubscriptionController@subscriber_plans');
Route::post('/ajax_show_plan', 'SubscriptionController@ajax_show_plan');
//24-02-2024
Route::get('/buy-plan/{planId}', 'SubscriptionBuyController@index');
Route::post('pay-now', [\App\Http\Controllers\SubscriptionBuyController::class, 'submitPaymentForm'])->name('pay-now');
Route::post('phonepe-callback', [\App\Http\Controllers\SubscriptionBuyController::class, 'callback'])->name('phonepe-callback');
Route::get('payment-success', 'SubscriptionBuyController@payment_success')->name('payment-success');
Route::get('payment-error', 'SubscriptionBuyController@payment_error')->name('payment-error');

Route::get('/verify_email/{id}/{email}', 'HomeController@verify_email');
Route::get('/test_email', 'HomeController@test_email');

Route::namespace("Admin")->prefix('admin')->group(function(){

	Route:: get('/','AdminController@index')->name('admin/home');

});



