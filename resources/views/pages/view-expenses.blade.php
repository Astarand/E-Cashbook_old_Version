@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>View Expenses</h5>
                </div>
            </div>
			<form  action="javascript:void(0);" method="POST" name="addExpenseFrm" id="addExpenseFrm">
			<input type="hidden" name="id" id="eId" value="{{ $expenses->id }}">
			@csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group ">
                                        <label>Expenses Category</label>
                                        <div class="form-group">
                                            <select class="form-select" name="expense_cat"  id="expense_cat" onchange="getExpenseOptions(this);">
                                                <option value="">Select</option>
                                                <option value="op_expenses" <?php echo ($expenses->expense_cat=='op_expenses')? "selected":"" ?>>Operating Expense</option>
												<option value="non_op_expenses" <?php echo ($expenses->expense_cat=='non_op_expenses')? "selected":"" ?>>Non Operating Expense</option>
												<option value="non_op_income" <?php echo ($expenses->expense_cat=='non_op_income')? "selected":"" ?>>Non Operating Income</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
								<div class="col-lg-4 col-md-6 col-sm-12">
									<label>Expenses Details</label>						
									<select class="form-control select-style" name="expense_type" id="expense_type">
										<option value="">Select</option>										
										@foreach($expenseCatOpt as $k=>$catOpt)
										<option value="{{ $catOpt->opt_val }}" <?php echo ($catOpt->opt_val==$expenses->expense_type)? "selected":"" ?>>{{ $catOpt->opt_val }}</option>
										@endforeach
									</select>
								</div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group" id="other">
                                        <label>Other Expenses</label>
                                        <input type="text" class="form-control" placeholder="Other Expenses" name="other" disabled>
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
                                    <label>Date</label>
                                    <input type="date" name="expense_date" id="expense_date" value="{{ $expenses->expense_date }}" class="form-control" placeholder="date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Invoice / Referance no.</label>
                                    <input type="text" name="exp_invno" id="exp_invno" value="{{ $expenses->exp_invno }}" class="form-control"  placeholder="Invoice / Referance no.">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Amount</label>
                                    <input type="text" name="expense_amt" id="expense_amt" value="{{ $expenses->expense_amt }}" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Payment Method</label>
                                    <div class="form-group">
                                        <select class="form-select" name="mode_of_expense" id="mode_of_expense">
                                            <option value="">Select</option>
                                            <option value="NEFT" <?php echo ($expenses->mode_of_expense=='NEFT')? "selected":"" ?>>NEFT</option>
                                            <option value="IMPS" <?php echo ($expenses->mode_of_expense=='IMPS')? "selected":"" ?>>IMPS</option>
                                            <option value="RTGS" <?php echo ($expenses->mode_of_expense=='RTGS')? "selected":"" ?>>RTGS</option>
                                            <option value="Cheque" <?php echo ($expenses->mode_of_expense=='Cheque')? "selected":"" ?>>Cheque</option>
                                            <option value="Demand Draft" <?php echo ($expenses->mode_of_expense=='Demand Draft')? "selected":"" ?>>Demand Draft</option>
                                            <option value="Pay Order" <?php echo ($expenses->mode_of_expense=='Pay Order')? "selected":"" ?>>Pay Order</option>
                                            <option value="UPI" <?php echo ($expenses->mode_of_expense=='UPI')? "selected":"" ?>>UPI</option>
                                            <option value="Cash" <?php echo ($expenses->mode_of_expense=='Cash')? "selected":"" ?>>Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Description of Expenses</label>
                                    <input type="text" name="pur_of_expense" id="pur_of_expense" value="{{ $expenses->pur_of_expense }}" class="form-control" placeholder="Description & Expenses">
                                </div>
                            </div>
                            <h6 class="mb-3">Approval By</h6>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Name</label>
                                    <input type="text" name="approved_by" id="approved_by" value="{{ $expenses->approved_by }}" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Designation</label>
                                    <input type="text" name="designation" id="designation" value="{{ $expenses->designation }}" class="form-control" placeholder="Designation">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Date</label>
                                    <input type="date" name="approved_date" id="approved_date" value="{{ $expenses->approved_date }}" class="form-control" placeholder="date">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                <div class="form-group" id="summernote_container">
                                    <label class="form-control-label">Special Notes/Command</label>
                                    <textarea class="summernote form-control" name="spec_note" id="spec_note" placeholder="Special Notes/Command" rows="7">{{ $expenses->spec_note }}</textarea>
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
									
									@if(@$expenses->exp_inv_doc !="")
										<div class="downloadFile pb-3"><a target="_blank" href="{{ asset('/public/uploads/expense-invoice/'.$expenses->exp_inv_doc) }}">Download</a></div>
									@endif
                                                                        
                                </div>
                            </div>                           
                        </div>
					
                </div>
            </div>
			
            <div class="message-container"></div>
			<div id="expenseLoader" class="loader"></div>
			<div class="add-customer-btns text-end">
				<a href="{{ url('/expenses') }}" class="btn customer-btn-cancel">Cancel</a>
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
