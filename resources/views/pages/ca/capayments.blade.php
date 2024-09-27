@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Payment List of Customers</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Share"><i class="fa-brands fa-whatsapp"></i></span> </a>
                            </li>
                            <li>
                                <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                    <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="d-block">
                                            <li>
                                                <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-pdf me-2"></i>PDF</a>
                                            </li>
                                            <li>
                                                <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-text me-2"></i>Excel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
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

                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Total payments</th>
                                        <th>Advance Payments</th>
                                        <th>Due Payments</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php $i = 1; ?>
										@foreach ($payments as $payment)
                                        <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a></a>
                                                <a href="{{ url('/client-view/'.base64_encode($payment->company_id)) }}">{{ $payment->comp_name }} </a>
                                            </h2>
                                        </td>
                                        <td>{{ $payment->comp_phone }}</td>
                                        <td><span class="badge badge-pill bg-primary-light"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $payment->total_amount }}</span></td>
                                        <td><span class="badge badge-pill bg-success-light"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $payment->advance_payment }}</span></td>
                                        <td><span class="badge badge-pill bg-danger-light"><i class="fa-solid fa-indian-rupee-sign"></i> {{ ($payment->due_amount)  }}</span></td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ url('/client-view/'.base64_encode($payment->company_id)) }}" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i>view</a>
                                        </td>
                                    </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
								<div class="d-flex justify-content-center">
									<?php echo $payments_pagination->links() ?>
								</div>
                            </div>
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
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseName" aria-expanded="true" aria-controls="collapseName">
                                    Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseName" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-custom">
                                            <input type="text" class="form-control" id="name_field" placeholder="Enter customer name">
                                            <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Phone Filter -->
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingTwo">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="true" aria-controls="collapsePhone">
                                    Phone
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapsePhone" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-custom">
                                            <input type="number" class="form-control" id="phone_field" placeholder="Enter phone number">
                                            <span><img src="{{asset('public/assets/img/icons/phone.svg')}}" alt="img"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Total Payments Filter -->
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseTotalPayments" aria-expanded="true" aria-controls="collapseTotalPayments">
                                    Total Payments
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseTotalPayments" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-custom">
                                            <input type="number" class="form-control" id="total_payments_field" placeholder="Enter total payments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Advance Payments Filter -->
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingFour">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseAdvancePayments" aria-expanded="true" aria-controls="collapseAdvancePayments">
                                    Advance Payments
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseAdvancePayments" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-custom">
                                            <input type="number" class="form-control" id="advance_payments_field" placeholder="Enter advance payments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Due Payments Filter -->
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingFive">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseDuePayments" aria-expanded="true" aria-controls="collapseDuePayments">
                                    Due Payments
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseDuePayments" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-custom">
                                            <input type="number" class="form-control" id="due_payments_field" placeholder="Enter due payments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Status Filter -->
                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingSix">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseStatus" aria-expanded="true" aria-controls="collapseStatus">
                                    By Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        
                    </div>
                
                    <div class="filter-buttons">
                        <button type="reset" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
                            Reset
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const nameField = document.getElementById("name_field");
        const phoneField = document.getElementById("phone_field");
        const totalPaymentsField = document.getElementById("total_payments_field");
        const advancePaymentsField = document.getElementById("advance_payments_field");
        const duePaymentsField = document.getElementById("due_payments_field");
        const statusCheckboxes = document.querySelectorAll('input[name="bystatus"]');
        const tableRows = document.querySelectorAll(".datatable tbody tr");

        // Listen for input and change events
        nameField.addEventListener("input", filterTable);
        phoneField.addEventListener("input", filterTable);
        totalPaymentsField.addEventListener("input", filterTable);
        advancePaymentsField.addEventListener("input", filterTable);
        duePaymentsField.addEventListener("input", filterTable);
        statusCheckboxes.forEach(checkbox => checkbox.addEventListener("change", filterTable));

        function filterTable() {
            const nameValue = nameField.value.toLowerCase();
            const phoneValue = phoneField.value;
            const totalPaymentsValue = totalPaymentsField.value;
            const advancePaymentsValue = advancePaymentsField.value;
            const duePaymentsValue = duePaymentsField.value;

            let selectedStatus = [];
            statusCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedStatus.push(checkbox.value);
                }
            });

            tableRows.forEach((row) => {
                const nameText = row.cells[1].innerText.toLowerCase();
                const phoneText = row.cells[2].innerText;
                const totalPaymentsText = row.cells[3].innerText.replace(/[^0-9]/g, ""); // Remove currency symbols
                const advancePaymentsText = row.cells[4].innerText.replace(/[^0-9]/g, ""); // Remove currency symbols
                const duePaymentsText = row.cells[5].innerText.replace(/[^0-9]/g, ""); // Remove currency symbols

                const matchesName = nameText.includes(nameValue);
                const matchesPhone = phoneValue ? phoneText.includes(phoneValue) : true;
                const matchesTotalPayments = totalPaymentsValue ? parseFloat(totalPaymentsText) >= parseFloat(totalPaymentsValue) : true;
                const matchesAdvancePayments = advancePaymentsValue ? parseFloat(advancePaymentsText) >= parseFloat(advancePaymentsValue) : true;
                const matchesDuePayments = duePaymentsValue ? parseFloat(duePaymentsText) >= parseFloat(duePaymentsValue) : true;

                // Get the status from the data attribute if available
                const rowStatus = row.getAttribute('data-status');
                const matchesStatus = selectedStatus.length === 0 || selectedStatus.includes(rowStatus);

                if (
                    matchesName &&
                    matchesPhone &&
                    matchesTotalPayments &&
                    matchesAdvancePayments &&
                    matchesDuePayments &&
                    matchesStatus
                ) {
                    row.style.display = ""; // Show the row
                } else {
                    row.style.display = "none"; // Hide the row
                }
            });
        }
    });



    </script>

@endsection
