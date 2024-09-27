@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add Expenses</h5>
                </div>
            </div>
			<form  action="javascript:void(0);" method="POST" name="addExpenseFrm" id="addExpenseFrm">
			<input type="hidden" name="id" id="eId" value="">
			@csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Expenses Category <span class="text-danger"> *</span></label>
                                        <div class="form-group">
                                            <select class="form-select" name="expense_cat"  id="expense_cat" onchange="getExpenseOptions(this);">
                                                <option value="">Select</option>
                                                <option value="op_expenses">Operating Expense</option>
                                                <option value="non_op_expenses">Non Operating Expense</option>
                                                <option value="non_op_income">Non Operating Income</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
								<div class="col-lg-4 col-md-6 col-sm-12">
									<label>Expenses Details <span class="text-danger"> *</span></label>						
									<select class="form-control select-style" name="expense_type" id="expense_type">
										<option value="">Select</option>
										
									</select>
								</div>
                                <!--<div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group" id="op_expenses">
                                        <label>Expenses Details</label>
                                        <div class="form-group">
                                            <select class="form-select" disabled>
                                                <option value="">Select</option>
                                                <option value="">Salaries and Wages</option>
                                                <option value="">Employee Benefits</option>
                                                <option value="">Rent Expense</option>
                                                <option value="">Utilities</option>
                                                <option value="">Office Supplies</option>
                                                <option value="">Repairs and maintenance</option>
                                                <option value="">Travel and Transportation</option>
                                                <option value="">Advertising and Marketing</option>
                                                <option value="">Professional Services</option>
                                                <option value="">Insurance</option>
                                                <option value="">Depreciation</option>
                                                <option value="">Bank Charges and Interest</option>
                                                <option value="">Miscellaneous Expenses</option>
                                                <option value="other">Other </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="non_op_expenses" style="display: none;">
                                        <label>Expenses Details</label>
                                        <div class="form-group">
                                            <select class="form-select" disabled>
                                                <option value="">Select</option>
                                                <option value="">Interest Expense</option>
                                                <option value="">Foreign Exchange Losses</option>
                                                <option value="">Impairment Losses</option>
                                                <option value="">Loss on Sale of Assets</option>
                                                <option value="">Litigation Expenses</option>
                                                <option value="">Restructuring Costs</option>
                                                <option value="">Donations and Contributions</option>
                                                <option value="">Gain/Loss on Investments</option>
                                                <option value="">Discontinued Operations</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="non_op_income" style="display: none;">
                                        <label>Expenses Details</label>
                                        <div class="form-group">
                                            <select class="form-select" disable>
                                                <option value="">Select</option>
                                                <option value="">Interest Income</option>
                                                <option value="">Dividend Income</option>
                                                <option value="">Rental Income</option>
                                                <option value="">Gain on Sale of Assets</option>
                                                <option value="">Insurance Proceeds</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group" id="other">
                                        <label>Other Expenses</label>
                                        {{-- <input type="text" class="form-control" placeholder="Other Expenses" name="other" disabled> --}}
                                        <input type="text" class="form-control" placeholder="Other Expenses" name="other" id="other">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Date <span class="text-danger"> *</span></label>
                                    <input type="date" name="expense_date" id="expense_date" class="form-control" placeholder="date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Invoice / Referance no. <span class="text-danger"> *</span></label>
                                    <input type="text" name="exp_invno" id="exp_invno" class="form-control" placeholder="Invoice / Referance no.">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Amount <span class="text-danger"> *</span></label>
                                    <input type="text" name="expense_amt" id="expense_amt" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Payment Method <span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <select class="form-select" name="mode_of_expense" id="mode_of_expense">
                                            <option value="">Select</option>
                                            <option value="NEFT">NEFT</option>
                                            <option value="IMPS">IMPS</option>
                                            <option value="RTGS">RTGS</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Demand Draft">Demand Draft</option>
                                            <option value="Pay Order">Pay Order</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Description of Expenses <span class="text-danger"> *</span></label>
                                    <input type="text" name="pur_of_expense" id="pur_of_expense" class="form-control" placeholder="Description & Expenses">
                                </div>
                            </div>
                            <h6 class="mb-3">Approval By</h6>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="approved_by" id="approved_by" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Designation <span class="text-danger"> *</span></label>
                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Date <span class="text-danger"> *</span></label>
                                    <input type="date" name="approved_date" id="approved_date" class="form-control" placeholder="date">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                <div class="form-group" id="summernote_container">
                                    <label class="form-control-label">Special Notes/Command</label>
                                    <textarea class="summernote form-control" name="spec_note" id="spec_note" placeholder="Special Notes/Command" rows="7"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">   
                                <div class="form-group service-bg mb-0 pb-0">
                                    <label>Invoice Attachment</label>
                                    <div class="form-group service-upload mb-0">
                                        <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                        <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                        <p class="text-muted">Maximum size: 50MB</p>
                                        <input type="file"  name="exp_inv_doc" id="exp_inv_doc">
                                        <div id="frames100"></div>
                                    </div>
                                    
                                    
                                </div>
                            </div>                           
                        </div>
					
                </div>
            </div>
			
            <div class="message-container"></div>
			<div id="expenseLoader" class="loader"></div>
			<div class="add-customer-btns text-end">
				<a href="{{ url('/expenses') }}" class="btn customer-btn-cancel">Cancel</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
        </div>
    </div>
 


    <script>
        /*document.addEventListener("DOMContentLoaded", function() {
            var expensesDetails = document.querySelector('[name="expenses_details"]');
            var opExpenses = document.getElementById("op_expenses");
            var nonOpExpenses = document.getElementById("non_op_expenses");
            var nonOpIncome = document.getElementById("non_op_income");
            var otherInput = document.querySelector('[name="other"]');
    
            // Initially hide non-op expenses and income sections
            nonOpExpenses.style.display = "none";
            nonOpIncome.style.display = "none";
    
            // Function to enable/disable select menus based on selection
            function toggleSelects() {
                var selects = document.querySelectorAll('.form-select');
                selects.forEach(function(select) {
                    if (select.parentElement.parentElement.style.display !== "none") {
                        select.disabled = false;
                    } else {
                        select.disabled = true;
                    }
                });
            }
    
            // Function to show/hide sections based on selection
            function toggleSections() {
                opExpenses.style.display = (expensesDetails.value === "op_expenses") ? "block" : "none";
                nonOpExpenses.style.display = (expensesDetails.value === "non_op_expenses") ? "block" : "none";
                nonOpIncome.style.display = (expensesDetails.value === "non_op_income") ? "block" : "none";
    
                // Enable/disable select menus based on selection
                toggleSelects();
            }
    
            // Function to enable/disable "other" input field based on selection
            function toggleOtherInput(selectElement) {
                if (selectElement.value === "other") {
                    otherInput.disabled = false;
                } else {
                    otherInput.disabled = true;
                }
            }
    
            // Add change event listener to expensesDetails dropdown
            expensesDetails.addEventListener("change", function() {
                toggleSections();
            });
    
            // Add change event listener to opExpenses dropdown
            opExpenses.addEventListener("change", function() {
                toggleOtherInput(opExpenses);
            });
        });*/
    </script>    
    
    
    
@endsection
