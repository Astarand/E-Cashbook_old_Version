@extends('layouts.default')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>View Other Income</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form >
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="dateInput" id="dateInput" value="{{ old('dateInput', $income->dateInput) }}">
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Category of Income<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select id="categoryIncome" name="categoryIncome" class="form-select">
                                                <option value="">Select Services</option>
                                                <option value="Interest Income" {{ old('categoryIncome', $income->categoryIncome) == 'Interest Income' ? 'selected' : '' }}>Interest Income</option>
                                                <option value="Rental Income" {{ old('categoryIncome', $income->categoryIncome) == 'Rental Income' ? 'selected' : '' }}>Rental Income</option>
                                                <option value="Dividend Income" {{ old('categoryIncome', $income->categoryIncome) == 'Dividend Income' ? 'selected' : '' }}>Dividend Income</option>
                                                <option value="Royalty Income" {{ old('categoryIncome', $income->categoryIncome) == 'Royalty Income' ? 'selected' : '' }}>Royalty Income</option>
                                                <option value="Capital Gain" {{ old('categoryIncome', $income->categoryIncome) == 'Capital Gain' ? 'selected' : '' }}>Capital Gain</option>
                                                <option value="Other Income" {{ old('categoryIncome', $income->categoryIncome) == 'Other Income' ? 'selected' : '' }}>Other Income</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $income->amount) }}" placeholder="Enter Amount">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label>Specification</label>
                                        <input type="text" class="form-control" name="specification" id="specification" value="{{ old('specification', $income->specification) }}" placeholder="Enter Specification">
                                    </div>
                                </div>
                                <div id="otherIncomeField" class="col-lg-12 col-md-6 col-sm-12" style="display: none;">
                                    <div class="input-block mb-3">
                                        <label>Other Income <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" id="other_income" name="other_income" placeholder="Enter other income">{{ old('other_income', $income->other_income) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                                <button type="button" class="btn customer-btn-cancel">Cancel</button>
                                
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

    // Show "Other Income" field if selected
    if (categorySelect.value === 'Other Income') {
        otherIncomeField.style.display = 'block';
    }

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
