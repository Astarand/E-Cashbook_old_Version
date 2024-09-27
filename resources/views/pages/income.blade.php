@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            @if (session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
            @endif
            <div class="content-page-header">
                <h5>Income</h5>

                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Filter"><span class="me-2"><img
                                        src="{{asset('public/assets/img/icons/filter-icon.svg')}}"
                                        alt="filter"></span>Filter </a>
                        </li>
                        <li>
                            <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Share"><i class="fa-brands fa-whatsapp"></i></span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Download">
                                <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i
                                            class="fe fe-download"></i></span></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="d-block">
                                        <li>
                                            <a class="d-flex align-items-center download-item"
                                                href="javascript:void(0);" download=""><i
                                                    class="far fa-file-pdf me-2"></i>PDF</a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center download-item"
                                                href="javascript:void(0);" download=""><i
                                                    class="far fa-file-text me-2"></i>Excel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="{{ url('/addincome') }}"><i class="fa fa-plus-circle me-2"
                                    aria-hidden="true"></i>Add Other Income</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="filter_inputs" class="card filter-card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <!--<form action="#">-->
                <div class="card-body">

                    <div class="card">
                        <div class="card-body">
                            <form id="GetIncomeForm">
                                <div class="row">
                                    <div class="form-group-customer customer-additional-form">
                                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                            <div class="form-check form-check-inline" style="font-size:16px;">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="gross_income" value="gross_income">
                                                <label class="form-check-label" for="gross_income">Gross Sales Income</label>
                                            </div>
                                            <div class="form-check form-check-inline" style="font-size:16px;">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="net_income" value="net_income">
                                                <label class="form-check-label" for="net_income">Net Income</label>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>From Date <span class="text-danger">*</span></label>
                                            <input type="date" name="from_date" class="form-control" id="from_date">
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>To Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter Name">
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <button type="button" class="btn btn-primary w-100" id="GetIncomeFormSubmit" style="padding:7px; margin-top:27px;">Submit</button>
                                    </div>
                                </div>
                            </form>
                            
                            
                        </div>
                    </div>

                </div>
                <!--</form>-->
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group-customer customer-additional-form">
                            <h2 class="text-center">Total Income</h2>
                            <p class="text-center" id="invoiceType"></p>
                        </div>
                        <h2 class="text-success text-center mt-4 mb-5" id="totalAmount">₹00/-</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h5 class="form-title">Other Income</h5>
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Category of Income</th>
                                        <th>Specifiation</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incomes as $index => $income)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($income->dateInput)->format('d M Y') }}</td>
                                        <td>{{ $income->categoryIncome }}</td>
                                        <td>{{ $income->specification }}</td>
                                        <td>₹ {{ number_format($income->amount, 2) }}</td>
                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ url('/view-income/'.base64_encode($income->id)) }}"><i
                                                                    class="fa fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ url('/edit-income/'.base64_encode($income->id)) }}"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ url('/view-item/'.base64_encode($income->id)) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_income_{{ $income->id }}"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="modal custom-modal fade" id="delete_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Income</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="reset" data-bs-dismiss="modal"
                                        class="w-100 btn btn-primary paid-continue-btn">Delete</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" data-bs-dismiss="modal"
                                        class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="grossincome_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="javascript:void(0);">
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>From Date</label>
                                            <input type="text" class="form-control" value="23-08-2024" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>To Date </label>
                                            <input type="text" class="form-control" value="23-08-2024" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Total Gross Sales Income</label>
                                            <textarea type="text" class="form-control" disabled> ₹5000</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="netincome_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="javascript:void(0);">
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>From Date</label>
                                            <input type="text" class="form-control" value="23-08-2024" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>To Date </label>
                                            <input type="text" class="form-control" value="23-08-2024" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label>Total Net Income</label>
                                            <textarea type="text" class="form-control" disabled> ₹5000</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toggle-sidebar">
    <div class="sidebar-layout-filter">
        <div class="sidebar-header">
            <h5>Filter</h5>
            <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
        </div>
        <div class="sidebar-body">
            <form action="#" autocomplete="off">
                <!-- Date Field -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" placeholder="Select Date">
                </div>
            
                <!-- Category of Income Field -->
                <div class="form-group">
                    <label for="category_of_income">Category of Income</label>
                    <input type="text" class="form-control" id="category_of_income" placeholder="Enter Category of Income">
                </div>
            
                <!-- Specification Field -->
                <div class="form-group">
                    <label for="specification">Specification</label>
                    <input type="text" class="form-control" id="specification" placeholder="Enter Specification">
                </div>
            
                <!-- Amount Field -->
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" placeholder="Enter Amount">
                </div>
            
                <!-- Reset Button -->
                <div class="form-buttons mt-3">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
            
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let delId   =   0;
        $(document).on('click', '.delete_vendor', function(){
            delId   =   $(this).data('id');
            $('#delete_modal').modal('show');
        });
        $(document).on('click', '#delete-continue-btn', function(){
            window.location.href = "{{url('/deletevendor/')}}/"+delId;
        });

        $("#delete_modal").on("hidden.bs.modal", function () {
            delId   =   0;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Check if the success message exists
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            // Set a timeout to hide the message after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000);
        }
    });

    //--------- Table filter ----------

    document.addEventListener('DOMContentLoaded', function() {
    // Get form fields
    const dateInput = document.getElementById('date');
    const categoryIncomeInput = document.getElementById('category_of_income');
    const specificationInput = document.getElementById('specification');
    const amountInput = document.getElementById('amount');

    // Get the table and table rows
    const table = document.querySelector('.datatable tbody');
    const rows = table.querySelectorAll('tr');

    // Add event listeners to form fields
    dateInput.addEventListener('input', filterTable);
    categoryIncomeInput.addEventListener('input', filterTable);
    specificationInput.addEventListener('input', filterTable);
    amountInput.addEventListener('input', filterTable);

    // Add event listener to reset button
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        // Clear the form fields
        dateInput.value = '';
        categoryIncomeInput.value = '';
        specificationInput.value = '';
        amountInput.value = '';

        // Show all rows
        showAllRows();
    });

    function filterTable() {
        const date = dateInput.value;
        const categoryIncome = categoryIncomeInput.value.toLowerCase();
        const specification = specificationInput.value.toLowerCase();
        const amount = amountInput.value;

        // Loop through each row of the table
        rows.forEach(function(row) {
            const rowDate = row.cells[1].textContent.trim();
            const rowCategoryIncome = row.cells[2].textContent.toLowerCase().trim();
            const rowSpecification = row.cells[3].textContent.toLowerCase().trim();
            const rowAmount = row.cells[4].textContent.replace(/[^0-9.-]+/g, "").trim(); // Remove currency symbols and trim

            let isMatch = true;

            // Apply the filters
            if (date && !rowDate.includes(formatDate(date))) {
                isMatch = false;
            }
            if (categoryIncome && !rowCategoryIncome.includes(categoryIncome)) {
                isMatch = false;
            }
            if (specification && !rowSpecification.includes(specification)) {
                isMatch = false;
            }
            if (amount && rowAmount != amount) {
                isMatch = false;
            }

            // Show or hide the row based on matching criteria
            row.style.display = isMatch ? '' : 'none';
        });
    }

    function showAllRows() {
        rows.forEach(function(row) {
            row.style.display = '';
        });
    }

    // Helper function to format the date to 'd M Y'
    function formatDate(inputDate) {
        const date = new Date(inputDate);
        const options = { day: '2-digit', month: 'short', year: 'numeric' };
        return date.toLocaleDateString('en-GB', options); // 'en-GB' to get 'd M Y' format
    }
});



</script>
@endsection