@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

        <div class="row">
            <div class="col-xl-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Company Assignment Details</h6>
                            <div class="dropdown main">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Monthly
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" data-type="weekly" onclick="getAssignRequestChart(this);" class="dropdown-item">Weekly</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" data-type="monthly" onclick="getAssignRequestChart(this);" class="dropdown-item">Monthly</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" data-type="yearly" onclick="getAssignRequestChart(this);" class="dropdown-item">Yearly</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                            <div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                                <div>
                                    <span>Total Request</span>
                                    <p class="h3 text-primary me-5" id="reqTot">0</p>
                                </div>
                                <div>
                                    <span>Accepted</span>
                                    <p class="h3 text-success me-5" id="reqAce">0</p>
                                </div>
                                <div>
                                    <span>Rejected</span>
                                    <p class="h3 text-danger me-5" id="reqRej">0</p>
                                </div>
                            </div>
                        </div>
                        <div id="assign_chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Requested List</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <div>
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-light">
                                    <tr>

                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Company Name</th>
                                        <th>Requested For</th>
                                        <th>View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php $j = 1; ?>
									@foreach ($customerLists as $customer)
                                    <tr>
                                        <td><?php echo $j++; ?></td>
                                        <td>{{ date("d M Y",strtotime($customer->created_at)) }}</td>
                                        <td>{{ ($customer->comp_name!="")?$customer->comp_name:$customer->name }}</td>
                                        <td>{{$customer->request_for}} </td>
                                        <td><a href="javascript:void(0);" data-id="{{$customer->id}}" class="viewCustomerDet" data-bs-toggle="modal" data-bs-target="#request-modal"><i class="fa-regular fa-eye"></i></a></td>
                                    </tr>
									@endforeach
                                    </tbody>
                                </table>
								<div class="d-flex justify-content-center">
									<?php echo $customerLists_pagination->links() ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="page-header">
                <div class="content-page-header">
                    <h5>Accepted Request Company List</h5>
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
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Company Entity</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($customers as $customer)
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td>{{ date("d M Y",strtotime($customer->created_at)) }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a></a>
                                                    <a href="{{ url('/client-view/'.base64_encode($customer->id)) }}">{{ ($customer->comp_name!="")?$customer->comp_name:$customer->name }} <span><span class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">[email&#160;protected]</span></span></a>
                                                </h2>
                                            </td>
                                            <td>{{ $customer->exact_comp_nature }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>
                                                @if ($customer->ca_current_status==0)
                                                <span class="badge badge-pill bg-primary-light">Requested</span>
                                                @elseif ($customer->ca_current_status==1)
                                                <span class="badge badge-pill bg-success-light">Active</span></td>
                                                @elseif ($customer->ca_current_status==2)
                                                <span class="badge badge-pill bg-danger-light">Deactive</span></td>
                                                @elseif ($customer->ca_current_status==3)
                                                <span class="badge badge-pill bg-danger-light">Rejected</span></td>
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ url('/editclient/'.base64_encode($customer->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="mailto:psadhukhan77@gmail.com"><i class="fa-regular fa-paper-plane"></i>&nbsp;Send</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ url('/assignment-details/'.base64_encode($customer->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                            </li>
                                                            @if ($customer->ca_current_status==0 || $customer->ca_current_status==2)
                                                            <li>
                                                                <a data-id="{{$customer->id}}" data-stat="1" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                            </li>
                                                            @elseif ($customer->ca_current_status==1)
                                                            <li>
                                                                <a data-id="{{$customer->id}}" data-stat="2" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                            </li>
                                                            @endif
                                                            @if ($customer->ca_current_status==0)
                                                            <li>
                                                                <a data-id="{{$customer->id}}" data-stat="3" class="dropdown-item custCAactive" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Reject</a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
								<div class="d-flex justify-content-center">
									<?php echo $customers_pagination->links() ?>
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseDate" aria-expanded="true" aria-controls="collapseDate">
                                    Date
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseDate" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="date" class="form-control" id="date_field" placeholder="Select date">
                                                <span><img src="{{asset('public/assets/img/icons/calendar.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingTwo">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseName" aria-expanded="true" aria-controls="collapseName">
                                    Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseName" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="name_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseEntity" aria-expanded="true" aria-controls="collapseEntity">
                                    Company Entity
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseEntity" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="company_entity_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingFour">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="true" aria-controls="collapsePhone">
                                    Phone Number
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapsePhone" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="tel" class="form-control" id="phone_number_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <button type="reset" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="request-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card customer-details-group">
                        <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-img d-inline-flex">
                                    <img class="rounded-circle" id="cLogo" src="{{asset('public/assets/img/profiles/avatar-14.jpg')}}" alt="">
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6 id="cName"></h6>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-mail"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>Email Address</h6>
                                            <p id="cEmail"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-phone"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>Phone Number</h6>
                                            <p id="cPhone"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-airplay"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>Company Name</h6>
                                            <p id="cCompName"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-globe"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>Website</h6>
                                            <p class="customer-mail"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fab fa-whatsapp"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>WhatsApp</h6>
                                            <p class="customer-whatsapp"><a href="https://wa.link/fg5kcb"></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fe fe-briefcase"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>Company Address</h6>
                                            <p id="cAddr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="customer-details">
                                    <div class="d-flex align-items-center">
                                    <span class="customer-widget-icon d-inline-flex">
                                    <i class="fa-solid fa-bullseye"></i>
                                    </span>
                                        <div class="customer-details-cont">
                                            <h6>Requested For</h6>
                                            <p id="cReqFor"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="reset" id="requestAccept" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-continue-btn">Accecpt</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="requestDelete" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Reject</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filters = {
                date: document.getElementById('date_field'),
                name: document.getElementById('name_field'),
                company_entity: document.getElementById('company_entity_field'),
                phone_number: document.getElementById('phone_number_field'),
            };
        
            function filterTable() {
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach(row => {
                    let showRow = true;
                    if (filters.date.value && !row.children[1].textContent.includes(new Date(filters.date.value).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }))) {
                        showRow = false;
                    }
                    if (filters.name.value && !row.children[2].textContent.toLowerCase().includes(filters.name.value.toLowerCase())) {
                        showRow = false;
                    }
                    if (filters.company_entity.value && !row.children[3].textContent.toLowerCase().includes(filters.company_entity.value.toLowerCase())) {
                        showRow = false;
                    }
                    if (filters.phone_number.value && !row.children[4].textContent.includes(filters.phone_number.value)) {
                        showRow = false;
                    }
                    row.style.display = showRow ? '' : 'none';
                });
            }
        
            Object.values(filters).forEach(input => input.addEventListener('input', filterTable));
            document.querySelector('form').addEventListener('reset', function () {
                setTimeout(filterTable, 0);
            });
        });
        </script>

@endsection
