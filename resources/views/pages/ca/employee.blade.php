@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Assign Designated Employee</h5>
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
                            <li>
                                <a class="btn btn-primary" href="{{ url('/addemployee') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Employee</a>
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
                                    <th>Depertment Type</th>
                                    <th>Deignation</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $i = 1; ?>
								@foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        {{ $employee->name }}
                                    </td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->dept_name }}</td>
                                    <td>{{ $employee->desig_name }}</td>
                                    @if ($employee->status==0)  
										<td><span class="badge badge-pill bg-danger-light">Deactive</span></td>
									@else
										<td><span class="badge badge-pill bg-success-light">Active</span></td>
									@endif
                                    <td class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i>Generate Payslip</a>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/edit-employee/'.base64_encode($employee->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a data-id="{{$employee->id}}" class="dropdown-item empdelete" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/view-employee/'.base64_encode($employee->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                </li>
                                                @if ($employee->status==0)
                                                <li>
                                                    <a data-id="{{$employee->id}}" data-stat="1" class="dropdown-item emp_active" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                </li>
												@else
                                                <li>
                                                    <a data-id="{{$employee->id}}" data-stat="0" class="dropdown-item emp_active" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
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
								<?php echo $employees_pagination->links() ?>
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
                        <div class="card-header-new" id="headingTwo">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="true" aria-controls="collapsePhone">
                                    Phone Number
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapsePhone" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionMain1">
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
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseDepartment" aria-expanded="true" aria-controls="collapseDepartment">
                                    Department Type
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseDepartment" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="department_field" placeholder="Search here">
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseDesignation" aria-expanded="true" aria-controls="collapseDesignation">
                                    Designation
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseDesignation" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="designation_field" placeholder="Search here">
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
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseStatus" aria-expanded="true" aria-controls="collapseStatus">
                                    Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseStatus" class="collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="status" value="all" id="status_all">
                                            <span class="checkmark"></span> All
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="status" value="active" id="status_active">
                                            <span class="checkmark"></span> Active
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="status" value="deactive" id="status_deactive">
                                            <span class="checkmark"></span> Deactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-buttons">
                        <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
                            Apply
                        </button>
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
                    <h3>Delete Employee</h3>
                    <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                    <div class="row">
                        
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
                name: document.getElementById('name_field'),
                phone_number: document.getElementById('phone_number_field'),
                department: document.getElementById('department_field'),
                designation: document.getElementById('designation_field'),
                status_all: document.getElementById('status_all'),
                status_active: document.getElementById('status_active'),
                status_deactive: document.getElementById('status_deactive'),
            };
        
            function filterTable() {
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach(row => {
                    let showRow = true;
                    if (filters.name.value && !row.children[1].textContent.toLowerCase().includes(filters.name.value.toLowerCase())) {
                        showRow = false;
                    }
                    if (filters.phone_number.value && !row.children[2].textContent.includes(filters.phone_number.value)) {
                        showRow = false;
                    }
                    if (filters.department.value && !row.children[3].textContent.toLowerCase().includes(filters.department.value.toLowerCase())) {
                        showRow = false;
                    }
                    if (filters.designation.value && !row.children[4].textContent.toLowerCase().includes(filters.designation.value.toLowerCase())) {
                        showRow = false;
                    }
                    if (filters.status_all.checked && filters.status_active.checked && filters.status_deactive.checked) {
                        showRow = true;
                    } else {
                        const statusText = row.children[5].textContent.toLowerCase();
                        if (filters.status_active.checked && statusText !== 'active') {
                            showRow = false;
                        }
                        if (filters.status_deactive.checked && statusText !== 'deactive') {
                            showRow = false;
                        }
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
