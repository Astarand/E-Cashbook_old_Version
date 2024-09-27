@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Transactions</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="align-center">
                        <div class="form-control me-3">
                            <label class="custom_radio me-3 mb-0">
                                <input type="radio" class="form-control" name="customer_transaction"
                                    value="customer_transaction_data" checked>
                                <span class="checkmark"></span> Subscriber / Company List
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="custom_radio mb-0">
                                <input type="radio" name="customer_transaction" value="ca_transaction">
                                <span class="checkmark"></span> CA / Accountant Payment List
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="page-header">
                <div class="content-page-header d-flex justify-content-end">
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img
                                            src="{{asset('public/assets/img/icons/filter-icon.svg')}}"
                                            alt="filter"></span>Filter </a>
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
            <div class="col-sm-12" id="customer_trans">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable" id='customer_tabel'>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Subscription Trough</th>
                                        <th>Package Name</th>
                                        <th>Subscription Type</th>
                                        <th>Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Transaction Id</th>
                                        <th>Transaction Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Rittik Sadhukhan</td>
                                        <td>CA(Rishi Basu)</td>
                                        <td>Enterprise</td>
                                        <td>Monthly</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 199</td>
                                        <td> 19th February 2024</td>
                                        <td> 19th March 2024</td>
                                        <td>123456789</td>
                                        <td><span class="badge bg-success-light">Success</span></td>
                                        <td class="d-flex align-items-center">
                                            <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                    class="fa-regular fa-eye me-1"></i>Generate Invoice</a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="far fa-edit me-2"></i>Refund</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Message</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="active-customers.html"><i
                                                                    class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="deactive-customers.html"><i
                                                                    class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Rittik Sadhukhan</td>
                                        <td>Individual</td>
                                        <td>Enterprise</td>
                                        <td>Monthly</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 199</td>
                                        <td> 19th February 2024</td>
                                        <td> 19th March 2024</td>
                                        <td>123456789</td>
                                        <td><span class="badge bg-danger-light">Failed</span></td>
                                        <td class="d-flex align-items-center">
                                            <a href="customers-ledger.html" class="btn btn-greys me-2"><i
                                                    class="fa-regular fa-eye me-1"></i>Generate Invoice</a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="far fa-edit me-2"></i>Refund</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Message</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="active-customers.html"><i
                                                                    class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="deactive-customers.html"><i
                                                                    class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="ca_trans">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover" id="ca_data_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Accountant Name</th>
                                        <th>Total Earning</th>
                                        <th>Total Payout</th>
                                        <th>Balance Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('/transaction_ca') }}"
                                                    class="avatar avatar-md me-2"><img class="avatar-img rounded-circle"
                                                        src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}"
                                                        alt="User Image"></a>
                                                <a href="{{ url('/transaction_ca') }}">John Smith <span><span
                                                            class="__cf_email__"
                                                            data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">xyz@gmail.com</span></span></a>
                                            </h2>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 4000</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 3000</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 1000</td>
                                        <td><span class="badge bg-success-light">Payment Done</span></td>
                                        <td class="d-flex align-items-center">
                                            <a href="#" class="btn btn-greys me-2"><i
                                                    class="fa-regular fa-eye me-1"></i> View Transaction</a>
                                            <div class="dropdown dropdown-action">
                                                <a href="{{ url('/transaction_ca') }}" class=" btn-action-icon "
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ url('/transaction_ca') }}"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('/transaction_ca') }}"
                                                    class="avatar avatar-md me-2"><img class="avatar-img rounded-circle"
                                                        src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}"
                                                        alt="User Image"></a>
                                                <a href="{{ url('/transaction_ca') }}">John Smith <span><span
                                                            class="__cf_email__"
                                                            data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">xyz@gmail.com</span></span></a>
                                            </h2>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 4000</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 3000</td>
                                        <<td><i class="fa-solid fa-indian-rupee-sign"></i> 1000</td>
                                            <td><span class="badge bg-danger-light">Payment Due</span></td>
                                            <td class="d-flex align-items-center">
                                                <a href="#" class="btn btn-greys me-2"><i
                                                        class="fa-regular fa-eye me-1"></i> View Transaction</a>
                                                <div class="dropdown dropdown-action">
                                                    <a href="{{ url('/transaction_ca') }}" class=" btn-action-icon "
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/transaction_ca') }}"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"><i
                                                                        class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toggle-sidebar ledge">
    <div class="sidebar-layout-filter">
        <div class="sidebar-header ledge">
            <h5>Filter</h5>
            <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
        </div>

        <div class="sidebar-body" id="customer_filter_sidebar">
            <form action="#" autocomplete="off">

                <div class="accordion accordion-last" id="accordionMain1">
                    <div class="card-header-new" id="headingOne">
                        <h6 class="filter-title">
                            <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Customers
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>

                        </h6>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample1">
                        <div class="card-body-chat">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <span>Company Name</span>
                                        <input type="text" name="comp_company_name" class="form-control" id="comp_company_name">
                                    </div>
                                    <div>
                                        <span>Subscription Trough</span>
                                        <select name="comp_subscription_trough" id="comp_subscription_trough" class="form-control"
                                            id="subscription_trough">
                                            <option>Select</option>
                                            <option value="ca">Ca</option>
                                            <option value="individual">Individual</option>
                                        </select>
                                    </div>
                                    <div>
                                        <span>Package Name</span>
                                        <input type="text" name="comp_package_name" class="form-control" id="comp_package_name">
                                    </div>
                                    <div>
                                        <span>Subscription Type</span>
                                        <input type="text" name="comp_subscription_type" class="form-control"
                                            id="comp_subscription_type">
                                    </div>
                                    <div>
                                        <span>Amount</span>
                                        <input type="text" name="comp_amount" class="form-control" id="comp_amount">
                                    </div>
                                    <div>
                                        <span>Start Date</span>
                                        <input type="date" name="comp_start_date" class="form-control" id="comp_start_date">
                                    </div>
                                    <div>
                                        <span>End Date</span>
                                        <input type="date" name="comp_end_date" class="form-control" id="comp_end_date">
                                    </div>
                                    <div>
                                        <span>Transaction Id</span>
                                        <input type="text" name="comp_transaction_id" class="form-control"
                                            id="comp_transaction_id">
                                    </div>
                                    

                                    <div>
                                        <span>Status</span>
                                        {{-- <input type="text" name="status" class="form-control" id="status"> --}}
                                        <select name="" name="comp_transaction_status" class="form-control" id="comp_transaction_status">
                                            <option>Select</option>
                                            <option value="Payment Done">Payment Done</option>
                                            <option value="Payment Not Success">Payment Not Success</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="card-header-new" id="headingOne2">
                        <h6 class="filter-title">

                            <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                data-bs-target="#orderbyCustomer" aria-expanded="true" aria-controls="orderbyCustomer">
                                Order by
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                        </h6>
                    </div>
                    <div id="orderbyCustomer" class="collapse show" aria-labelledby="headingOne2"
                        data-bs-parent="#accordionExample1">
                        <div class="card-body-chat">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="checkBoxes1">

                                        <div class="selectBox-cont">
                                            <label class="custom_check w-100">
                                                <input type="radio" value="ascending_order" name="cus_order">
                                                <span class="checkmark"></span> Ascending Order
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="radio" value="desending_order" name="cus_order">
                                                <span class="checkmark"></span> Descending Order
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                <button type="button" class="btn btn-danger" id="resetBtnCustomer">Reset</button>
            </form>

        </div>

        <div class="sidebar-body" id="ca_filter_sidebar">
            <form action="#" autocomplete="off">

                <div class="accordion accordion-last" id="accordionMain1">
                    <div class="card-header-new" id="headingOne">
                        <h6 class="filter-title">
                            <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Ca Filter
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample1">
                        <div class="card-body-chat">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <span>Accountant Name</span>
                                        <input type="text" name="accountant_name" class="form-control"
                                            id="accountant_name">
                                    </div>
                                    <div>
                                        <span>Total Earning</span>
                                        <input type="text" name="total_earning" class="form-control" id="total_earning">
                                    </div>
                                    <div>
                                        <span>Total Payout</span>
                                        <input type="text" name="total_payout" class="form-control" id="total_payout">
                                    </div>
                                    <div>
                                        <span>Balance Amount</span>
                                        <input type="text" name="balance_amount" class="form-control"
                                            id="balance_amount">
                                    </div>
                                    <div>
                                        <span>Status</span>
                                        {{-- <input type="text" name="status" class="form-control" id="status"> --}}
                                        <select name="" name="status" class="form-control" id="status">
                                            <option>Select</option>
                                            <option value="Payment Done">Payment Done</option>
                                            <option value="Payment Not Success">Payment Not Success</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card-header-new" id="headingOne2ca">
                        <h6 class="filter-title">

                            <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                data-bs-target="#orderbyCa" aria-expanded="true" aria-controls="orderbyCa">
                                Order by
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                        </h6>
                    </div> --}}
                    {{-- <div id="orderbyCa" class="collapse show" aria-labelledby="headingOne2ca"
                        data-bs-parent="#accordionExample1">
                        <div class="card-body-chat">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="checkBoxes1">

                                        <div class="selectBox-cont">
                                            <label class="custom_check w-100">
                                                <input type="radio" value="ascending_order" name="ca_order">
                                                <span class="checkmark"></span> Ascending Order
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="radio" value="desending_order" name="ca_order">
                                                <span class="checkmark"></span> Descending Order
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    <button type="button" class="btn btn-danger" id="resetBtnCa">Reset</button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    function loadCustomerTransactionData() {
                $.ajax({
                    url: '{{ route("get.cus_transaction_data") }}',
                    method: 'GET',
                    success: function(response) {

                        // console.log(response);
                        $('#customer_tabel tbody').empty();                         
                        $.each(response, function(index, transaction) {
                            var transactionRow = 
                            '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + transaction.company_name + '</td>' +
                                '<td>' + (transaction.ca_add_by != 0 ? 'CA' : 'Individual') + '</td>' +
                                '<td>' + transaction.package_name + '</td>' +
                                '<td>' + transaction.subscription_type + '</td>' +
                                '<td><i class="fa-solid fa-indian-rupee-sign"></i> ' + transaction.paid_amount + '</td>' +
                                '<td>' + transaction.start_at + '</td>' +
                                '<td>' + transaction.end_at + '</td>' +
                                '<td>' + transaction.transaction_id + '</td>' +
                                
                                

                                '<td><span class="badge bg-' + (transaction.payment_status == 'Payment Done' ? 'success' : 'danger') + '-light">' + transaction.payment_status + '</span></td>' +
                                '<td class="d-flex align-items-center">' +
                                    '<a href="{{ url("comp_transactions_invoice/") }}/' + btoa(transaction.user_id) + '" target="_blank" class="btn btn-greys me-2" ><i class="fa-regular fa-eye me-1"></i>Generate Invoice </a>' +

                                    '<div class="dropdown dropdown-action">' +
                                        '<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>' +
                                        '<div class="dropdown-menu dropdown-menu-end">' +
                                            '<ul>' +
                                                '<li><a class="dropdown-item" href="#"><i class="far fa-edit me-2"></i>Refund</a></li>' +
                                                '<li><a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Message</a></li>' +
                                                // '<li><a class="dropdown-item" href="active-customers.html"><i class="fa-solid fa-power-off me-2"></i>Activate</a></li>' +
                                                // '<li><a class="dropdown-item" href="deactive-customers.html"><i class="far fa-bell-slash me-2"></i>Deactivate</a></li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</td>' +
                            '</tr>';
                            $('#customer_tabel tbody').append(transactionRow);
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(status, error);
                    }
                });
            }
        
            document.addEventListener("DOMContentLoaded", function() {
                // Load customer transaction data when the page loads
                loadCustomerTransactionData();

                const radioContainer = document.querySelector('.align-center');
                const cusSubRadio = document.querySelector('input[value="customer_transaction_data"]');
                const caSubRadio = document.querySelector('input[value="ca_transaction"]');
                const cusSubDiv = document.getElementById('customer_trans');
                const caSubDiv = document.getElementById('ca_trans');
                caSubDiv.style.display = 'none';

                radioContainer.addEventListener('click', function(event) {
                    const target = event.target;

                    if (target.type === 'radio') {
                        if (target === cusSubRadio && target.checked) {
                            cusSubDiv.style.display = 'block';
                            caSubDiv.style.display = 'none';
                            caSubRadio.checked = false;

                            loadCustomerTransactionData();
                        } else if (target === caSubRadio && target.checked) {
                            caSubDiv.style.display = 'block';
                            cusSubDiv.style.display = 'none';
                            cusSubRadio.checked = false;

                            var business = "ca";
                            $.ajax({
                                    url: '{{ route("get.ca_transaction_data") }}',
                                    type: 'GET',
                                    data: { customer: business },
                                    success: function(data) {
                                        // console.log(data);
                                        // Function to populate the table with data
                                        function populateTable(data) {
                                            
                                            const tableBody = $('#ca_data_table tbody');
                                            tableBody.empty(); // Clear existing table rows

                                            data.forEach(function(item, index) {
                                                const row = `
                                                    <tr>
                                                        <td>${index + 1}</td>
                                                        

                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{ url('/transaction_ca') }}/${btoa(item.id)}" class="avatar avatar-md me-2"><img class="avatar-img rounded-circle"
                                                                        src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}" alt="User Image"></a>
                                                                <a href="{{ url('/transaction_ca') }}/${btoa(item.id)}">${item.name || 'NA'}<span><span
                                                                        class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">${item.email || 'NA'}</span></a>
                                                            </h2>
                                                        </td>




                                                        <td>${item.total_earning || 'NA'}</td>
                                                        <td>${item.total_payout || 'NA'}</td>
                                                        <td>${item.balance_amount || 'NA'}</td>
                                                        <td><span class="badge bg-${item.status === 'Payment Done' ? 'success' : 'danger'}-light">${item.status}</span></td>
                                                        <td class="d-flex align-items-center">
                                                            <a href="{{ url('/transaction_ca') }}/${btoa(item.id)}" class="btn btn-greys me-2"><i class="fa-regular fa-eye me-1"></i> View Transaction</a>
                                                            <div class="dropdown dropdown-action">
                                                                <a href="{{ url('/transaction_ca') }}/${btoa(item.id)}" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul>
                                                                        <li><a class="dropdown-item" href="{{ url('/transaction_ca') }}/${btoa(item.id)}"><i class="far fa-eye me-2"></i>View</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-power-off me-2"></i>Activate</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="far fa-bell-slash me-2"></i>Deactivate</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                `;
                                                tableBody.append(row); // Append row to table body
                                            });
                                        }

                                        // Call function to populate the table with retrieved data
                                        populateTable(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });

                        }
                    }
                });
            });

</script>

<script>
    // Function to toggle sidebar visibility based on radio button selection
    function toggleSidebar() {
        var customerTransactionRadio = document.querySelector('input[name="customer_transaction"][value="customer_transaction_data"]');
        var caTransactionRadio = document.querySelector('input[name="customer_transaction"][value="ca_transaction"]');

        var customerFilterSidebar = document.getElementById('customer_filter_sidebar');
        var caFilterSidebar = document.getElementById('ca_filter_sidebar');

        // Show/hide customer filter sidebar
        if (customerTransactionRadio.checked) {
            customerFilterSidebar.style.display = 'block';
        } else {
            customerFilterSidebar.style.display = 'none';
        }

        // Show/hide CA filter sidebar
        if (caTransactionRadio.checked) {
            caFilterSidebar.style.display = 'block';
        } else {
            caFilterSidebar.style.display = 'none';
        }
    }

    // Listen for changes in radio button selection
    document.querySelectorAll('input[name="customer_transaction"]').forEach(function(radio) {
        radio.addEventListener('change', toggleSidebar);
    });

    // Initial call to toggleSidebar to ensure correct sidebar is displayed on page load
    toggleSidebar();
</script>

<script>
    // Get the filter input fields
            var accountantNameInput = document.getElementById('accountant_name');
            var totalEarningInput = document.getElementById('total_earning');
            var totalPayoutInput = document.getElementById('total_payout');
            var balanceAmountInput = document.getElementById('balance_amount');
            var statusInput = document.getElementById('status');

            // Add event listeners to the filter input fields
            accountantNameInput.addEventListener('input', filterTable);
            totalEarningInput.addEventListener('input', filterTable);
            totalPayoutInput.addEventListener('input', filterTable);
            balanceAmountInput.addEventListener('input', filterTable);
            statusInput.addEventListener('change', filterTable); // Use 'change' event for select elements

            // Function to filter the table
            function filterTable() {
                var tableRows = document.querySelectorAll('#ca_data_table tbody tr');

                // Get the values entered in the filter input fields
                var filterAccountantName = accountantNameInput.value.toUpperCase();
                var filterTotalEarning = totalEarningInput.value.toUpperCase();
                var filterTotalPayout = totalPayoutInput.value.toUpperCase();
                var filterBalanceAmount = balanceAmountInput.value.toUpperCase();
                var filterStatus = statusInput.value.toUpperCase(); // For select element, use 'value' property

                var found = false; // Flag to check if any data is found

                // Loop through all table rows and filter based on the input values
                tableRows.forEach(function(row) {
                    var tdAccountantName = row.cells[1].textContent.toUpperCase();
                    var tdTotalEarning = row.cells[2].textContent.toUpperCase();
                    var tdTotalPayout = row.cells[3].textContent.toUpperCase();
                    var tdBalanceAmount = row.cells[4].textContent.toUpperCase();
                    var tdStatus = row.cells[5].textContent.toUpperCase(); // Assuming status is in the 6th column

                    // Check if the filter inputs are not empty
                    if ((filterAccountantName.trim() !== '' && !tdAccountantName.includes(filterAccountantName)) ||
                        (filterTotalEarning.trim() !== '' && !tdTotalEarning.includes(filterTotalEarning)) ||
                        (filterTotalPayout.trim() !== '' && !tdTotalPayout.includes(filterTotalPayout)) ||
                        (filterBalanceAmount.trim() !== '' && !tdBalanceAmount.includes(filterBalanceAmount)) ||
                        (filterStatus !== 'SELECT' && filterStatus !== tdStatus)) {
                        row.style.display = "none";
                    } else {
                        row.style.display = "";
                        found = true; // Data found
                    }
                });

                // Show a message if no data is found
                var messageRow = document.getElementById('no_data_found');
                if (!found) {
                    messageRow.style.display = ""; // Show the message
                } else {
                    messageRow.style.display = "none"; // Hide the message if data is found
                }
            }


            // Get the reset button
    var resetBtn = document.getElementById('resetBtnCa');

    // Add click event listener to the reset button
    resetBtn.addEventListener('click', function() {
        // Reset the value of all filter input fields to empty
        accountantNameInput.value = '';
        totalEarningInput.value = '';
        totalPayoutInput.value = '';
        balanceAmountInput.value = '';
        statusInput.value = 'Select'; // Reset select element to default option

        // Trigger the filter function to update the table based on reset values
        filterTable();
    });




</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the filter input fields
        var companyNameInput = document.getElementById('comp_company_name');
        var subscriptionTroughInput = document.getElementById('comp_subscription_trough');
        var packageNameInput = document.getElementById('comp_package_name');
        var subscriptionTypeInput = document.getElementById('comp_subscription_type');
        var amountInput = document.getElementById('comp_amount');
        var startDateInput = document.getElementById('comp_start_date');
        var endDateInput = document.getElementById('comp_end_date');
        var transactionIdInput = document.getElementById('comp_transaction_id');
        var transactionStatusInput = document.getElementById('comp_transaction_status');

        // Get the reset button
        var resetBtn = document.getElementById('resetBtnCustomer');

        if (companyNameInput && subscriptionTroughInput && packageNameInput && subscriptionTypeInput &&
            amountInput && startDateInput && endDateInput && transactionIdInput && transactionStatusInput &&
            resetBtn) {
            // Add event listeners to the filter input fields
            companyNameInput.addEventListener('input', filterTable);
            subscriptionTroughInput.addEventListener('change', filterTable);
            packageNameInput.addEventListener('input', filterTable);
            subscriptionTypeInput.addEventListener('input', filterTable);
            amountInput.addEventListener('input', filterTable);
            startDateInput.addEventListener('change', filterTable);
            endDateInput.addEventListener('change', filterTable);
            transactionIdInput.addEventListener('input', filterTable);
            transactionStatusInput.addEventListener('change', filterTable);

            // Add click event listener to the reset button
            resetBtn.addEventListener('click', function() {
                // Reset the value of all filter input fields to empty
                companyNameInput.value = '';
                subscriptionTroughInput.value = 'Select';
                packageNameInput.value = '';
                subscriptionTypeInput.value = '';
                amountInput.value = '';
                startDateInput.value = '';
                endDateInput.value = '';
                transactionIdInput.value = '';
                transactionStatusInput.value = 'Select';

                // Trigger the filter function to update the table based on reset values
                filterTable();
            });
        } else {
            console.error("Some input fields or the reset button is missing.");
        }

        // Function to filter the table
        function filterTable() {
            var tableRows = document.querySelectorAll('#customer_tabel tbody tr');
            var filterCompanyName = companyNameInput.value.toUpperCase();
            var filterSubscriptionTrough = subscriptionTroughInput.value.toUpperCase();
            var filterPackageName = packageNameInput.value.toUpperCase();
            var filterSubscriptionType = subscriptionTypeInput.value.toUpperCase();
            var filterAmount = amountInput.value.toUpperCase();
            var filterStartDate = startDateInput.value.toUpperCase();
            var filterEndDate = endDateInput.value.toUpperCase();
            var filterTransactionId = transactionIdInput.value.toUpperCase();
            var filterTransactionStatus = transactionStatusInput.value.toUpperCase();
            var found = false;

            tableRows.forEach(function(row) {
                var tdCompanyName = row.cells[1].textContent.toUpperCase();
                var tdSubscriptionTrough = row.cells[2].textContent.toUpperCase();
                var tdPackageName = row.cells[3].textContent.toUpperCase();
                var tdSubscriptionType = row.cells[4].textContent.toUpperCase();
                var tdAmount = row.cells[5].textContent.toUpperCase();
                var tdStartDate = row.cells[6].textContent.toUpperCase();
                var tdEndDate = row.cells[7].textContent.toUpperCase();
                var tdTransactionId = row.cells[8].textContent.toUpperCase();
                var tdTransactionStatus = row.cells[9].textContent.toUpperCase();

                if ((filterCompanyName.trim() !== '' && !tdCompanyName.includes(filterCompanyName)) ||
                    (filterSubscriptionTrough !== 'SELECT' && filterSubscriptionTrough !== tdSubscriptionTrough) ||
                    (filterPackageName.trim() !== '' && !tdPackageName.includes(filterPackageName)) ||
                    (filterSubscriptionType.trim() !== '' && !tdSubscriptionType.includes(filterSubscriptionType)) ||
                    (filterAmount.trim() !== '' && !tdAmount.includes(filterAmount)) ||
                    (filterStartDate.trim() !== '' && !tdStartDate.includes(filterStartDate)) ||
                    (filterEndDate.trim() !== '' && !tdEndDate.includes(filterEndDate)) ||
                    (filterTransactionId.trim() !== '' && !tdTransactionId.includes(filterTransactionId)) ||
                    (filterTransactionStatus !== 'SELECT' && filterTransactionStatus !== tdTransactionStatus)) {
                    row.style.display = "none";
                } else {
                    row.style.display = "";
                    found = true;
                }
            });

            var messageRow = document.getElementById('no_data_found_customer');
            if (!found) {
                messageRow.style.display = "";
            } else {
                messageRow.style.display = "none";
            }
        }
    });
</script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the filter input fields
        var companyNameInput = document.getElementById('comp_company_name');
        var subscriptionTroughInput = document.getElementById('comp_subscription_trough');
        var packageNameInput = document.getElementById('comp_package_name');
        var subscriptionTypeInput = document.getElementById('comp_subscription_type');

        // Get the reset button
        var resetBtn = document.getElementById('resetBtnCustomer');

        if (companyNameInput && subscriptionTroughInput && packageNameInput && subscriptionTypeInput && resetBtn) {
            // Add event listeners to the filter input fields
            companyNameInput.addEventListener('input', filterTable);
            subscriptionTroughInput.addEventListener('change', filterTable);
            packageNameInput.addEventListener('input', filterTable);
            subscriptionTypeInput.addEventListener('input', filterTable);

            // Add click event listener to the reset button
            resetBtn.addEventListener('click', function() {
                // Reset the values of the filter input fields to empty or default
                companyNameInput.value = '';
                subscriptionTroughInput.value = 'Select';
                packageNameInput.value = '';
                subscriptionTypeInput.value = '';

                // Trigger the filter function to update the table based on reset values
                filterTable();
            });
        } else {
            console.error("One or more input fields or the reset button is missing.");
        }

        // Function to filter the table
        function filterTable() {
            var tableRows = document.querySelectorAll('#customer_tabel tbody tr');
            var filterCompanyName = companyNameInput.value.toUpperCase();
            var filterSubscriptionTrough = subscriptionTroughInput.value.toUpperCase();
            var filterPackageName = packageNameInput.value.toUpperCase();
            var filterSubscriptionType = subscriptionTypeInput.value.toUpperCase();
            var found = false;

            tableRows.forEach(function(row) {
                var tdCompanyName = row.cells[1].textContent.toUpperCase();
                var tdSubscriptionTrough = row.cells[2].textContent.toUpperCase();
                var tdPackageName = row.cells[3].textContent.toUpperCase();
                var tdSubscriptionType = row.cells[4].textContent.toUpperCase();

                if ((filterCompanyName.trim() !== '' && !tdCompanyName.includes(filterCompanyName)) ||
                    (filterSubscriptionTrough !== 'SELECT' && filterSubscriptionTrough !== tdSubscriptionTrough) ||
                    (filterPackageName.trim() !== '' && !tdPackageName.includes(filterPackageName)) ||
                    (filterSubscriptionType.trim() !== '' && !tdSubscriptionType.includes(filterSubscriptionType))) {
                    row.style.display = "none";
                } else {
                    row.style.display = "";
                    found = true;
                }
            });

            var messageRow = document.getElementById('no_data_found_customer');
            if (!found) {
                messageRow.style.display = "";
            } else {
                messageRow.style.display = "none";
            }
        }
    });
</script> --}}













@endsection