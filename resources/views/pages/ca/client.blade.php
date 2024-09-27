@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Company List</h5>
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
							@if (Auth::user()->u_type == 1)
                            <li>
                                <a class="btn btn-primary" href="{{ url('/addclient') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Company</a>
                            </li>
							@endif
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
                                        <th>Company ID</th>
                                        <th>Company Name</th>
                                        <th>Phone</th>
                                        <th>Created on</th>
                                        <th>Assigned By</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>{{ $customer->compId }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('/client-view/'.base64_encode($customer->id)) }}">{{ ($customer->comp_name!="")?$customer->comp_name:$customer->name }} <span><span class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">{{$customer->email}}</span></span></a>
                                            </h2>
                                        </td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ date("d M Y",strtotime($customer->created_at)) }}</td>
                                        <td>
                                            @if ($customer->ca_add_by==0)
                                            <span class="badge badge-pill bg-warning-light text-warning">Requested Assign</span>
                                            @else
                                            <span class="badge badge-pill bg-primary-light">Own Assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($customer->ca_current_status==0)
                                            <span class="badge badge-pill bg-primary-light">Requested</span>
                                            @elseif ($customer->ca_current_status==1)
                                            <span class="badge badge-pill bg-success-light">Active</span>
                                            @elseif ($customer->ca_current_status==2)
                                            <span class="badge badge-pill bg-danger-light">Deactive</span>
                                            @elseif ($customer->ca_current_status==3)
                                            <span class="badge badge-pill bg-danger-light">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/client-view/'.base64_encode($customer->id)) }}"><i class="far fa-eye me-2"></i>View</a>
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Company ID
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="company_id_search" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Company Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="company_name_search" placeholder="Search here">
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Phone Number
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="number" class="form-control" id="phone_number_search" placeholder="Search here">
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Created On
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="date" class="form-control" id="created_on_search">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingFive">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    Assigned By
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <select class="form-control" id="assigned_by_search">
                                                    <option value="">Select</option>
                                                    <option value="own_assigned">Own Assigned</option>
                                                    <option value="requested_assign">Requested Assign</option>
                                                </select>
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingSix">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <select class="form-control" id="status_search">
                                                    <option value="">Select</option>
                                                    <option value="requested">Requested</option>
                                                    <option value="active">Active</option>
                                                </select>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filters = {
                company_id: document.getElementById('company_id_search'),
                company_name: document.getElementById('company_name_search'),
                phone_number: document.getElementById('phone_number_search'),
                created_on: document.getElementById('created_on_search'),
                assigned_by: document.getElementById('assigned_by_search'),
                status: document.getElementById('status_search'),
            };
        
            function filterTable() {
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach(row => {
                    let showRow = true;
                    if (filters.company_id.value && !row.children[1].textContent.includes(filters.company_id.value)) {
                        showRow = false;
                    }
                    if (filters.company_name.value && !row.children[2].textContent.toLowerCase().includes(filters.company_name.value.toLowerCase())) {
                        showRow = false;
                    }
                    if (filters.phone_number.value && !row.children[3].textContent.includes(filters.phone_number.value)) {
                        showRow = false;
                    }
                    if (filters.created_on.value && row.children[4].textContent !== new Date(filters.created_on.value).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })) {
                        showRow = false;
                    }
                    if (filters.assigned_by.value && !row.children[5].textContent.includes(filters.assigned_by.value === 'own_assigned' ? 'Own Assigned' : 'Requested Assign')) {
                        showRow = false;
                    }
                    if (filters.status.value && !row.children[6].textContent.includes(filters.status.value.charAt(0).toUpperCase() + filters.status.value.slice(1))) {
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
