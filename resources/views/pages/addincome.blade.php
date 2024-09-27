@extends('layouts.default')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Add Other Income</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('income.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="dateInput" id="dateInput" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Category of Income<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select id="categoryIncome" name="categoryIncome" class="form-select">
                                                <option value="">Select Services</option>
                                                <option value="Interest Income">Interest Income</option>
                                                <option value="Rental Income">Rental Income</option>
                                                <option value="Dividend Income">Dividend Income</option>
                                                <option value="Royalty Income">Royalty Income</option>
                                                <option value="Capital Gain">Capital Gain</option>
                                                <option value="Other Income">Other Income</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount ">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Specification</label>
                                        <input type="text" class="form-control" name="specification" id="specification" placeholder="Enter Specification">
                                    </div>
                                </div>
                                <div id="otherIncomeField" class="col-lg-12 col-md-6 col-sm-12" style="display: none;">
                                    <div class="input-block mb-3">
                                        <label>Other Income <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" id="other_income" name="other_income" placeholder="Enter other income"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                                
                                <button type="button" class="btn customer-btn-cancel">Cancel</button>
                                
                                <button type="submit" class="btn customer-btn-save" name="addOtherIncome">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    var categorySelect = document.getElementById('categoryIncome');
    var otherIncomeField = document.getElementById('otherIncomeField');

    // Hide "Other Income" field by default
    otherIncomeField.style.display = 'none';

    // Add event listener to the select element
    categorySelect.addEventListener('change', function() {
        if (categorySelect.value === 'Other Income') {
            otherIncomeField.style.display = 'block';
        } else {
            otherIncomeField.style.display = 'none';
        }
    });
});


</script>