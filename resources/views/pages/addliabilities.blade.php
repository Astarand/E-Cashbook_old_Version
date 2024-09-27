@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add New Liabilities</h5>
                </div>
            </div>
			<form action="javascript:void(0);" method="post" name="addFrmLiabilities" id="addFrmLiabilities">
			<input type="hidden" name="liabId" id="liabId" value="">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Liabilities Type<span class="text-danger"> *</span></label>
                        <div class="align-center">
                            <div class="form-control me-3">
                                <label class="custom_radio me-3 mb-0">
                                    <input type="radio" class="form-control" name="liab_type" value="c_liabilities" checked onclick="showLiabilities('c_liabilities')">
                                    <span class="checkmark"></span> Current Liabilities
                                </label>
                            </div>
                            <div class="form-control">
                                <label class="custom_radio mb-0">
                                    <input type="radio" name="liab_type" value="long_liabilities" onclick="showLiabilities('long_liabilities')">
                                    <span class="checkmark"></span> Long-Term Liabilities
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12" id="c_liabilities">
                        <div class="form-group">

                            <div class="align-center">
                                <div class="form-control me-3">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" class="form-control" name="liabilities" id="liabilities" value="Accounts Payable" onclick="showAmountField(this)">
                                        <span class="checkmark"></span> Accounts Payable
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities" id="liabilities" value="Short-Term Loans" onclick="showAmountField(this)">
                                        <span class="checkmark"></span> Short-Term Loans
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities" id="liabilities" value="Accrued Liabilities" onclick="showAmountField(this)">
                                        <span class="checkmark"></span> Accrued Liabilities
                                    </label>
                                </div>
                            </div>
                            <div class="align-center">
                                <div class="form-control me-3">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" class="form-control" name="liabilities" id="liabilities" value="Short-Term Portion of Long-Term Debt" onclick="showAmountField(this)">
                                        <span class="checkmark"></span> Short-Term Portion of Long-Term Debt
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities" id="liabilities" value="Unearned Revenue" onclick="showAmountField(this)">
                                        <span class="checkmark"></span> Unearned Revenue
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities" id="liabilities" value="Other Current Liabilities" onclick="showAmountField(this)">
                                        <span class="checkmark"></span> Other Current Liabilities
                                    </label>
                                </div>
                            </div>
                            <div class="form-control" id="other_liabilities_name" style="display: none;">
                                <label>Type Name</label>
                                <input type="text" class="form-control" name="other_liabilities_name" id="other_liabilities_name" value="" >

                            </div>
                            <div class="form-control" id="current_liabilities_amount" style="display: none;">
                                <label>Type Amount</label>
                                <input type="number" class="form-control" name="curr_amount" id="curr_amount" value="" >

                            </div>



                            {{-- <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Accounts Payable </label>
                                        <input type="text" name="ac_payable" id="ac_payable" class="form-control" placeholder="Enter Accounts Payable">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Short-Term Loans<span class="text-danger"></span></label>
                                        <input type="text" name="short_term_loans" id="short_term_loans" class="form-control" placeholder="Enter Short-Term Loans">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Accrued Liabilities<span class="text-danger"></span></label>
                                        <input type="text" name="accrued_liabilities" id="accrued_liabilities" class="form-control" placeholder="Enter Accrued Liabilities">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Short-Term Portion of Long-Term Debt<span class="text-danger"></span></label>
                                        <input type="text" name="long_term_debt" id="long_term_debt" class="form-control" placeholder="Enter Short-Term Portion of Long-Term Debt">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Unearned Revenue<span class="text-danger"></span></label>
                                        <input type="text" name="unearned_revenue" id="unearned_revenue" class="form-control" placeholder="Enter Unearned Revenue">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Other Current Liabilities<span class="text-danger"></span></label>
                                        <input type="text" name="current_liabilities" id="current_liabilities" class="form-control" placeholder="Enter Other Current Liabilities">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12" id="long_liabilities" style="display: none;">
                        <div class="form-group">

                            <div class="align-center">
                                <div class="form-control me-3">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" class="form-control" name="liabilities_long" id="liabilities_long" value="Accounts Payable" onclick="showAmountField_long(this)">
                                        <span class="checkmark"></span> Accounts Payable
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities_long" id="liabilities_long" value="Long-Term Debt" onclick="showAmountField_long(this)">
                                        <span class="checkmark"></span> Long-Term Debt
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities_long" id="liabilities_long" value="Deferred Tax Liabilities" onclick="showAmountField_long(this)">
                                        <span class="checkmark"></span> Deferred Tax Liabilities
                                    </label>
                                </div>
                            </div>
                            <div class="align-center">
                                <div class="form-control me-3">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" class="form-control" name="liabilities_long" id="liabilities_long" value="Pension Liabilities" onclick="showAmountField_long(this)">
                                        <span class="checkmark"></span> Pension Liabilities
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities_long" id="liabilities_long" value="Lease Liabilities" onclick="showAmountField_long(this)">
                                        <span class="checkmark"></span> Lease Liabilities
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="custom_radio me-3 mb-0">
                                        <input type="radio" name="liabilities_long" id="liabilities_long" value="Other Long-Term Liabilities" onclick="showAmountField_long(this)">
                                        <span class="checkmark"></span> Other Long-Term Liabilities
                                    </label>
                                </div>
                            </div>

                            <div class="form-control" id="long_liabilities_name" style="display: none;">
                                <label>Type Name</label>
                                <input type="text" class="form-control" name="other_long_liabilities_name" id="other_long_liabilities_name" value="" >

                            </div>
                            <div class="form-control" id="long_liabilities_amount" style="display: none;">
                                <label>Type Amount</label>
                                <input type="number" class="form-control" name="long_amount" id="long_amount" value="" >

                            </div>

                            

                            {{-- <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Accounts Payable <span class="text-danger"> *</span></label>
                                        <input type="text" name="ac_payable_two" id="ac_payable_two" class="form-control" placeholder="Enter Accounts Payable">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Long-Term Debt<span class="text-danger"> *</span></label>
                                        <input type="text" name="long_term_debt_two" id="long_term_debt_two" class="form-control" placeholder="Enter Long-Term Debt">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Deferred Tax Liabilities<span class="text-danger"> *</span></label>
                                        <input type="text" name="deferred_tax_liabilities" id="deferred_tax_liabilities" class="form-control" placeholder="Enter Deferred Tax Liabilities">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Pension Liabilities<span class="text-danger"> *</span></label>
                                        <input type="text" name="pension_liabilities" id="pension_liabilities" class="form-control" placeholder="Enter Pension Liabilities">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Lease Liabilities<span class="text-danger"> *</span></label>
                                        <input type="text" name="lease_liabilities" id="lease_liabilities" class="form-control" placeholder="Enter Lease Liabilities">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Other Long-Term Liabilities<span class="text-danger"> *</span></label>
                                        <input type="text" name="long_term_liabilities" id="long_term_liabilities" class="form-control" placeholder="Enter Other Long-Term Liabilities">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    
					<div class="message-container"></div>
                    <div class="add-customer-btns text-end">
                    <div id="liabLoader" class="loader"></div>
                        <a href="{{ url('/liabilities') }}" class="btn customer-btn-cancel">Cancel</a>
                        <button type="submit" class="btn customer-btn-save" >Add Liabilities</button>
                        
                    </div>
                </div>

            </div>
			</form>
        </div>
    </div>
@endsection
<script>
    function showLiabilities(liabilitiesType) {
        document.getElementById('c_liabilities').style.display = 'none';
        document.getElementById('long_liabilities').style.display = 'none';

        document.getElementById(liabilitiesType).style.display = 'block';
        document.getElementById('long_liabilities_amount').style.display = 'none';
        document.getElementById('current_liabilities_amount').style.display = 'none';
    }


</script>

<script>
    function showAmountField(radio) {
        document.getElementById('current_liabilities_amount').style.display = 'block';
        document.getElementById('long_liabilities_amount').style.display = 'none';


        if(radio.value == 'Other Current Liabilities'){
            document.getElementById('other_liabilities_name').style.display = 'block';
            document.getElementById('long_liabilities_name').style.display = 'none';


        }else{
            document.getElementById('other_liabilities_name').style.display = 'none';
            document.getElementById('long_liabilities_name').style.display = 'block';


        }

    }
    function showAmountField_long(radio) {
        document.getElementById('current_liabilities_amount').style.display = 'none';
        document.getElementById('long_liabilities_amount').style.display = 'block';

        if(radio.value == 'Other Long-Term Liabilities'){
            document.getElementById('other_liabilities_name').style.display = 'none';
            document.getElementById('long_liabilities_name').style.display = 'block';

        }else{
            document.getElementById('other_liabilities_name').style.display = 'block';
            document.getElementById('long_liabilities_name').style.display = 'none';

        }

    }

</script>
