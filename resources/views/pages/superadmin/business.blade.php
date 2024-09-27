@extends('layouts.default')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-5 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Package Analytics</h5>
                            <div class="dropdown main">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Weekly
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" id="weekly" class="dropdown-item pack_analytics">Weekly</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="monthly" class="dropdown-item pack_analytics">Monthly</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="yearly" class="dropdown-item pack_analytics">Yearly</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="s-col"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 d-flex">
                <div class="row">
                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-2">
                                        <i class="fa-regular fa-building"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Total Companies</div>
                                        <div class="dash-counts">
                                            <p id="total_companies"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-6" role="progressbar" style="width: 75%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0" id="since_lastweek_total_company">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-2">
                                        <i class="fa-solid fa-user-check"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Total CA/Accountant No.</div>
                                        <div class="dash-counts">
                                            <p id="total_ca"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-6" role="progressbar" style="width: 65%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0" id="since_totalCa"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-3">
                                        <i class="fa-solid fa-user-large"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Direct Attachment</div>
                                        <div class="dash-counts">
                                            <p id="total_direct_attached"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-7" role="progressbar" style="width: 85%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0" id="since_directAttach"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-3">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Attached by CA</div>
                                        <div class="dash-counts">
                                            <p id="total_added_ca"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-7" role="progressbar" style="width: 45%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0" id="since_attached_ca"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-4">
                                        <i class="fa-solid fa-person-circle-check"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Total Subscriber</div>
                                        <div class="dash-counts">
                                            <p id="total_subscribers"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-8" role="progressbar" style="width: 85%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0" id="since_total_subsctiber"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-4">
                                        <i class="fa-solid fa-person-circle-exclamation"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">Total Trail user</div>
                                        <div class="dash-counts">
                                            <p id="total_trial_user"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-8" role="progressbar" style="width: 45%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0" id="since_trial_user"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-1">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title">Total Earning</div>
                                <div class="dash-counts">
                                    <p id="total_Earning"> <i class="fa-solid fa-indian-rupee-sign"></i> </p>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-3">
                            <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted mt-3 mb-0" id="since_total_earning"></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-1">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title">Total CA/Accountant Earnings</div>
                                <div class="dash-counts">
                                    <p id="total_Ca_Earning"> <i class="fa-solid fa-indian-rupee-sign"></i> </p>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-3">
                            <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted mt-3 mb-0" id="since_ca_earning"></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-1">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title">Net Profit</div>
                                <div class="dash-counts">
                                    <p id="total_Net_Amount"> <i class="fa-solid fa-indian-rupee-sign"></i> </p>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-3">
                            <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted mt-3 mb-0" id="since_net_profit"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="align-center">
                        <div class="form-control me-3">
                            <label class="custom_radio me-3 mb-0">
                                <input type="radio" class="form-control" name="cus_sub" chacked="">
                                <span class="checkmark"></span> Customer
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="custom_radio mb-0">
                                <input type="radio" name="ca_sub">
                                <span class="checkmark"></span> Ca Firm / Accountant
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-header">
            <div class="content-page-header">
                <h5></h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Filter"><span class="me-2"><img
                                        src="{{asset('public/assets/img/icons/filter-icon.svg')}}"
                                        alt="filter"></span>Filter </a>
                        </li>
                        <li>
                            <a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="List-View"><span><i class="fe fe-list"></i></span>
                            </a>
                        </li>
                        <li>
                            <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Grid-View"><span><i class="fe fe-grid"></i></span>
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
                                                    class="far fa-file-text me-2"></i>CVS</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
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
        <div class="row" id="cus_sub">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable" id="customer_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Package Name</th>
                                        <th>Subscription Type</th>
                                        <th>Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Transaction Id</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Rittik Sadhukhan</td>
                                        <td>Enterprise</td>
                                        <td>Monthly</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 199</td>
                                        <td> 19th February 2024</td>
                                        <td> 19th March 2024</td>
                                        <td>123456789</td>

                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="ca_sub">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable" id="ca_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Accountant Name</th>
                                        <th>Total Company Attach</th>
                                        <th>Subscriber</th>
                                        <th>Trail User</th>
                                        <th>Commission</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('/business_ca') }}" class="avatar avatar-md me-2"><img
                                                        class="avatar-img rounded-circle"
                                                        src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}"
                                                        alt="User Image"></a>
                                                <a href="{{ url('/business_ca') }}">John Smith <span><span
                                                            class="__cf_email__"
                                                            data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">xyz@gmail.com</span></span></a>
                                            </h2>
                                        </td>
                                        <td>500</td>
                                        <td>300</td>
                                        <td>200</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 4000</td>

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
</div>
<div class="toggle-sidebar">
    <div class="sidebar-layout-filter">
        <div class="sidebar-header">
            <h5>Filter</h5>
            <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
        </div>
        <div class="sidebar-body" id="customer_table_filter">
            <form action="#" autocomplete="off">
                
            
                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    By Fields Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="company_name" value="Company Name">
                                            <span class="checkmark"></span> Company Name
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="package_name" value="Package Name">
                                            <span class="checkmark"></span> Package Name
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="amount" value="Amount">
                                            <span class="checkmark"></span> Amount
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="start_date" value="Start Date">
                                            <span class="checkmark"></span> Start Date
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="end_date" value="End Date">
                                            <span class="checkmark"></span> End Date
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingFour">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Order By
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="radio" name="order_by" value="Ascending Order">
                                            <span class="checkmark"></span> Ascending Order
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="radio" name="order_by" value="Descending Order">
                                            <span class="checkmark"></span> Descending Order
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button id="customer_reset_button" class="btn btn-danger">Reset</button>
                            {{-- <button id="ca_reset_button" class="btn btn-danger">Reset </button> --}}
                        </div>
                    </div>
                
            </form>
        </div>
        <div class="sidebar-body" id="ca_table_filter">
            <form action="#" autocomplete="off">
                
            
                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    By Fields Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="accountant_name" value="Accountant Name">
                                            <span class="checkmark"></span> Accountant Name
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="total_company_attach" value="Total Company Attach">
                                            <span class="checkmark"></span> Total Company Attach
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="subscriber" value="Subscriber">
                                            <span class="checkmark"></span> Subscriber
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="trail_user" value="Trail User">
                                            <span class="checkmark"></span> Trail User
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="commission" value="Commission">
                                            <span class="checkmark"></span> Commission
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion border-0" id="accordionMain3">
                        <div class="card-header-new" id="headingFour">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Order By
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="radio" name="order_by" value="Ascending Order">
                                            <span class="checkmark"></span> Ascending Order
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="radio" name="order_by" value="Descending Order">
                                            <span class="checkmark"></span> Descending Order
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <button id="customer_reset_button" class="btn btn-danger">Reset</button> --}}
                            <button id="ca_reset_button" class="btn btn-danger">Reset </button>
                        </div>
                    </div>
                
            </form>
        </div>

    </div>
</div>
<div class="modal custom-modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Customer</h3>
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

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownItems = document.querySelectorAll(".dropdown-item");

        dropdownItems.forEach(item => {
            item.addEventListener("click", function() {
                const selectedText = this.textContent.trim();
                const dropdownButton = document.getElementById("dropdownMenuButton");
                dropdownButton.textContent = selectedText;
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const radioContainer = document.querySelector('.align-center');
        const cusSubRadio = document.querySelector('input[name="cus_sub"]');
        const caSubRadio = document.querySelector('input[name="ca_sub"]');
        const cusSubDiv = document.getElementById('cus_sub');
        const caSubDiv = document.getElementById('ca_sub');
        caSubDiv.style.display = 'none';

        radioContainer.addEventListener('click', function(event) {
            const target = event.target;

            if (target.type === 'radio') {
                if (target === cusSubRadio && target.checked) {
                    cusSubDiv.style.display = 'block';
                    caSubDiv.style.display = 'none';
                    caSubRadio.checked = false;
                } else if (target === caSubRadio && target.checked) {
                    caSubDiv.style.display = 'block';
                    cusSubDiv.style.display = 'none';
                    cusSubRadio.checked = false;
                }
            }
        });
    });

    
    document.addEventListener('DOMContentLoaded', function () {
        

        function handleDropdownChange(selectedValue) {
            
            switch (selectedValue) {
                case 'weekly':

                    var today = new Date();
                    var firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
                    var lastDayOfWeek  = new Date(today.setDate(today.getDate() - today.getDay() + 6));

                    var formattedFirstDay = formatDate(firstDayOfWeek);
                    var formattedLastDay = formatDate(lastDayOfWeek);

                //console.log(formattedFirstDay);

                $.ajax({
						url: '{{ route("get.cardData") }}',
						type: 'GET',
						data: { 
                            
                            startDate: formattedFirstDay,
                            endDate: formattedLastDay
                        },
						success: function(data) {

							
                            document.getElementById('total_companies').textContent = data.total_company;
                            document.getElementById('total_ca').textContent = data.total_ca;
                            document.getElementById('total_direct_attached').textContent = data.total_direct_attached;
                            document.getElementById('total_added_ca').textContent = data.total_added_ca;
                            document.getElementById('total_subscribers').textContent = data.total_subscribers;
                            document.getElementById('total_trial_user').textContent = data.total_trial_user;
                            document.getElementById('total_Net_Amount').textContent = data.total_Net_Amount;
                            document.getElementById('total_Ca_Earning').textContent = data.total_Ca_Earning;
                            document.getElementById('total_Earning').textContent = data.total_Earning;

                            if (data.percentageDifferenceCompanyProfile > 0) {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            } else if (data.percentageDifferenceCompanyProfile < 0) {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            } else {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            }


                            if (data.percentageDifferenceUsers_ca > 0) {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            } else if (data.percentageDifferenceUsers_ca < 0) {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            } else {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            }


                            if (data.percentageDifferenceDirectAttached > 0) {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            } else if (data.percentageDifferenceDirectAttached < 0) {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            } else {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            }

                            if (data.percentageDifferentAttachedCa > 0) {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            } else if (data.percentageDifferentAttachedCa < 0) {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            } else {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceSubscriber > 0) {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            } else if (data.percentageDiffercenceSubscriber < 0) {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            } else {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceTrialUser > 0) {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            } else if (data.percentageDiffercenceTrialUser < 0) {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            } else {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceTotalEarning > 0) {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            } else if (data.percentageDiffercenceTotalEarning < 0) {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            } else {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceCaEarning > 0) {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            } else if (data.percentageDiffercenceCaEarning < 0) {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            } else {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceNetProfit > 0) {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            } else if (data.percentageDiffercenceNetProfit < 0) {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            } else {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            }
						},

						error: function(xhr, status, error) {
							console.error(error);
						}
					});

                    
                    
                    break;
                case 'monthly':
                var today = new Date();
                var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

                var formattedFirstDayOfMonth = formatDate(firstDayOfMonth);
                var formattedLastDayOfMonth = formatDate(lastDayOfMonth);

                    $.ajax({
						url: '{{ route("get.cardData") }}',
						type: 'GET',
						data: { 
                            
                            startDate: formattedFirstDayOfMonth,
                            endDate: formattedLastDayOfMonth
                        },
						success: function(data) {

							
                            document.getElementById('total_companies').textContent = data.total_company;
                            document.getElementById('total_ca').textContent = data.total_ca;
                            document.getElementById('total_direct_attached').textContent = data.total_direct_attached;
                            document.getElementById('total_added_ca').textContent = data.total_added_ca;
                            document.getElementById('total_subscribers').textContent = data.total_subscribers;
                            document.getElementById('total_trial_user').textContent = data.total_trial_user;
                            document.getElementById('total_Net_Amount').textContent = data.total_Net_Amount;
                            document.getElementById('total_Ca_Earning').textContent = data.total_Ca_Earning;
                            document.getElementById('total_Earning').textContent = data.total_Earning;

                            if (data.percentageDifferenceCompanyProfile > 0) {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            } else if (data.percentageDifferenceCompanyProfile < 0) {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            } else {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            }


                            if (data.percentageDifferenceUsers_ca > 0) {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            } else if (data.percentageDifferenceUsers_ca < 0) {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            } else {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            }


                            if (data.percentageDifferenceDirectAttached > 0) {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            } else if (data.percentageDifferenceDirectAttached < 0) {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            } else {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            }

                            if (data.percentageDifferentAttachedCa > 0) {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            } else if (data.percentageDifferentAttachedCa < 0) {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            } else {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceSubscriber > 0) {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            } else if (data.percentageDiffercenceSubscriber < 0) {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            } else {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceTrialUser > 0) {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            } else if (data.percentageDiffercenceTrialUser < 0) {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            } else {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceTotalEarning > 0) {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            } else if (data.percentageDiffercenceTotalEarning < 0) {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            } else {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceCaEarning > 0) {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            } else if (data.percentageDiffercenceCaEarning < 0) {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            } else {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceNetProfit > 0) {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            } else if (data.percentageDiffercenceNetProfit < 0) {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            } else {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            }
						},

						error: function(xhr, status, error) {
							console.error(error);
						}
					});
                    break;
                case 'yearly':
                var today = new Date();
                var firstDayOfYear = new Date(today.getFullYear(), 0, 1);
                var lastDayOfYear = new Date(today.getFullYear(), 11, 31);
                var formattedFirstDayOfYear = formatDate(firstDayOfYear);
                var formattedLastDayOfYear = formatDate(lastDayOfYear);

                $.ajax({
						url: '{{ route("get.cardData") }}',
						type: 'GET',
						data: { 
                            
                            startDate: formattedFirstDayOfYear,
                            endDate: formattedLastDayOfYear
                        },
						success: function(data) {

							
                            document.getElementById('total_companies').textContent = data.total_company;
                            document.getElementById('total_ca').textContent = data.total_ca;
                            document.getElementById('total_direct_attached').textContent = data.total_direct_attached;
                            document.getElementById('total_added_ca').textContent = data.total_added_ca;
                            document.getElementById('total_subscribers').textContent = data.total_subscribers;
                            document.getElementById('total_trial_user').textContent = data.total_trial_user;
                            document.getElementById('total_Net_Amount').textContent = data.total_Net_Amount;
                            document.getElementById('total_Ca_Earning').textContent = data.total_Ca_Earning;
                            document.getElementById('total_Earning').textContent = data.total_Earning;

                            if (data.percentageDifferenceCompanyProfile > 0) {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            } else if (data.percentageDifferenceCompanyProfile < 0) {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            } else {
                                document.getElementById('since_lastweek_total_company').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceCompanyProfile + '%</span> since last week';
                            }


                            if (data.percentageDifferenceUsers_ca > 0) {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            } else if (data.percentageDifferenceUsers_ca < 0) {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            } else {
                                document.getElementById('since_totalCa').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceUsers_ca + '%</span> since last week';
                            }


                            if (data.percentageDifferenceDirectAttached > 0) {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            } else if (data.percentageDifferenceDirectAttached < 0) {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            } else {
                                document.getElementById('since_directAttach').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferenceDirectAttached + '%</span> since last week';
                            }

                            if (data.percentageDifferentAttachedCa > 0) {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            } else if (data.percentageDifferentAttachedCa < 0) {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            } else {
                                document.getElementById('since_attached_ca').innerHTML = '<span class="text-danger me-1">' + data.percentageDifferentAttachedCa + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceSubscriber > 0) {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            } else if (data.percentageDiffercenceSubscriber < 0) {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            } else {
                                document.getElementById('since_total_subsctiber').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceSubscriber + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceTrialUser > 0) {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            } else if (data.percentageDiffercenceTrialUser < 0) {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            } else {
                                document.getElementById('since_trial_user').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceTrialUser + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceTotalEarning > 0) {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            } else if (data.percentageDiffercenceTotalEarning < 0) {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            } else {
                                document.getElementById('since_total_earning').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceTotalEarning + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceCaEarning > 0) {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            } else if (data.percentageDiffercenceCaEarning < 0) {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            } else {
                                document.getElementById('since_ca_earning').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceCaEarning + '%</span> since last week';
                            }

                            if (data.percentageDiffercenceNetProfit > 0) {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-up me-1"></i>' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            } else if (data.percentageDiffercenceNetProfit < 0) {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            } else {
                                document.getElementById('since_net_profit').innerHTML = '<span class="text-danger me-1">' + data.percentageDiffercenceNetProfit + '%</span> since last week';
                            }
						},

						error: function(xhr, status, error) {
							console.error(error);
						}
					});
                    break;
                default:
                    break;
            }
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }
        
        function initializePage() {
            // Get the dropdown menu items
            var dropdownItems = document.querySelectorAll('.pack_analytics');

            // Loop through each dropdown menu item
            dropdownItems.forEach(function (item) {
                // Add event listener for click event
                item.addEventListener('click', function () {
                    // Get the selected dropdown value
                    var selectedValue = item.id;

                    // Call the handleDropdownChange function
                    handleDropdownChange(selectedValue);
                });
            });
        }

        
        initializePage();
        $(document).ready(function() {
            let wek = 'weekly';
            handleDropdownChange(wek); // ----------- packeg -----------
        })
    });

    




</script>



<script>
    
        $(document).ready(function() {
            
        
        function fetchSubscribers(business) {
            
				if(business=="customer"){	

						$.ajax({
						url: '{{ route("get.business_earning") }}',
						type: 'GET',
						data: { customer: business },
						success: function(data) {
							$('#customer_table tbody').empty();

							if (data.length > 0) {
								$.each(data, function(index, subscriber) {
									var row = '<tr>' +
										'<td>' + (index + 1) + '</td>' +
										'<td>' + (subscriber.company_name ? subscriber.company_name : 'N/A') + '</td>' +
										'<td>' + (subscriber.package_name ? subscriber.package_name : 'N/A') + '</td>' +
										'<td>' + (subscriber.subscription_type ? subscriber.subscription_type : 'N/A') + '</td>' +
										'<td><i class="fa-solid fa-indian-rupee-sign"></i> ' + subscriber.paid_amount + '</td>' +
										'<td>' + (subscriber.start_at ? subscriber.start_at : 'N/A') + '</td>' +
										'<td>' + (subscriber.end_at ? subscriber.end_at : 'N/A') + '</td>' +
										'<td>' + (subscriber.transaction_id ? subscriber.transaction_id : 'N/A') + '</td>' +
										'</tr>';
									$('#customer_table tbody').append(row);
								});
							} else {
								$('#customer_table tbody').append('<tr><td colspan="9" class="text-center">Data not found</td></tr>');
							}
						},

						error: function(xhr, status, error) {
							console.error(error);
						}
					});

				}else{

					
					//------------ CA Firm -------------
					
					$.ajax({
						url: '{{ route("get.ca_firm") }}',
						type: 'GET',
						data: { customer: business },
						success: function(data) {
						$('#ca_table tbody').empty();

						if (data.length > 0) {
								$.each(data, function(index, subscriber) {
                                    var userId = btoa(subscriber.user_id); // Encode user ID to base64
                                    //var url = '/business_ca/' + userId; // Construct the URL
									var row = '<tr>' +
										'<td>' + (index + 1) + '</td>' +
										'<td>' +
										'<h2 class="table-avatar">' +
                                        // '<a href="' + url + '" class="avatar avatar-md me-2">' +
										'<a href="{{ url("/business_ca") }}/' + userId + '" class="avatar avatar-md me-2">' +
										'<img class="avatar-img rounded-circle" src="{{asset("public/assets/img/profiles/avatar-14.jpg")}}" alt="User Image">' +
										'</a>' +
										'<a href="{{ url("/business_ca") }}/'+ userId +'">' + subscriber.name + '<span><span class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">' + subscriber.email + '</span></span></a>' +
										'</h2>' +
										'</td>' +
										'<td>' + subscriber.company_attach + '</td>' +
										'<td>' + subscriber.total_subscriber + '</td>' +
										'<td>' + subscriber.total_trial + '</td>' +
										'<td><i class="fa-solid fa-indian-rupee-sign"></i> ' + subscriber.Commission + '</td>' +
										'</tr>';
									$('#ca_table tbody').append(row);
								});																
							} else {
								$('#ca_table tbody').append('<tr><td colspan="6" class="text-center">Data not found</td></tr>');
							}
						},


						error: function(xhr, status, error) {
							console.error(error);
						}
					});


				}
        }

        // Event listener for radio button change
        $('input[name="cus_sub"], input[name="ca_sub"]').change(function() {
            var business = $(this).val();
            fetchSubscribers(business);
        });

        fetchSubscribers('customer');
    });
    
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const customerRadio = document.querySelector('input[name="cus_sub"]');
        const caRadio = document.querySelector('input[name="ca_sub"]');
        const customerFilter = document.getElementById('customer_table_filter');
        const caFilter = document.getElementById('ca_table_filter');
        const customerResetButton = document.getElementById('customer_reset_button');
        const caResetButton = document.getElementById('ca_reset_button');

        // Function to toggle visibility based on radio button selection
        function toggleFilterVisibility() {
            if (customerRadio.checked) {
                customerFilter.style.display = 'block';
                caFilter.style.display = 'none';
            } else if (caRadio.checked) {
                customerFilter.style.display = 'none';
                caFilter.style.display = 'block';
            }
        }

        // Initial call to set initial visibility
        toggleFilterVisibility();

        // Event listener to toggle visibility when radio buttons are changed
        customerRadio.addEventListener('change', toggleFilterVisibility);
        caRadio.addEventListener('change', toggleFilterVisibility);

        // Function to check if a cell is empty or contains "N/A"
        function isEmpty(cell) {
            const content = cell.textContent.trim();
            return content === '' || content.toUpperCase() === 'N/A' || content === '0';
        }

        // Function to filter data based on selected checkboxes
        function filterData(tableId, filterId) {
            const table = document.getElementById(tableId);
            const checkboxes = document.querySelectorAll(`#${filterId} input[type="checkbox"]:checked`);

            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                let shouldDisplay = true;
                checkboxes.forEach(checkbox => {
                    const columnName = checkbox.value;
                    const columnIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === columnName);
                    if (columnIndex !== -1 && isEmpty(row.cells[columnIndex])) {
                        shouldDisplay = false;
                    }
                });
                row.style.display = shouldDisplay ? 'table-row' : 'none';
            });
        }

        // Function to sort data based on selected order
        function sortData(tableId, filterId) {
            const table = document.getElementById(tableId);
            const radios = document.querySelectorAll(`#${filterId} input[type="radio"]:checked`);

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const tbody = table.querySelector('tbody');

            rows.sort((a, b) => {
                const order = radios[0].value === 'Ascending Order' ? 1 : -1;
                const cellA = a.cells[0].textContent.trim();
                const cellB = b.cells[0].textContent.trim();

                if (cellA < cellB) return -1 * order;
                if (cellA > cellB) return 1 * order;
                return 0;
            });

            rows.forEach(row => tbody.appendChild(row));
        }

        // Function to reset filters
        function resetFilters() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            const radios = document.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });

            // Reset table display
            filterData('customer_table', 'customer_table_filter');
            filterData('ca_table', 'ca_table_filter');
        }

        // Event listener for customer reset button
        customerResetButton.addEventListener('click', resetFilters);

        // Event listener for CA reset button
        caResetButton.addEventListener('click', resetFilters);

        // Event listener to trigger filtering when checkboxes are changed
        document.querySelectorAll('#customer_table_filter input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', () => filterData('customer_table', 'customer_table_filter'));
        });

        document.querySelectorAll('#ca_table_filter input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', () => filterData('ca_table', 'ca_table_filter'));
        });

        // Event listener to trigger sorting when radio buttons are changed
        document.querySelectorAll('#customer_table_filter input[type="radio"]').forEach(input => {
            input.addEventListener('change', () => sortData('customer_table', 'customer_table_filter'));
        });

        document.querySelectorAll('#ca_table_filter input[type="radio"]').forEach(input => {
            input.addEventListener('change', () => sortData('ca_table', 'ca_table_filter'));
        });
    });
</script>











