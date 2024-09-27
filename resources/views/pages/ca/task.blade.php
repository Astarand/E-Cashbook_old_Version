@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Task Management</h5>
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
                                <a class="btn btn-primary" href="{{ url('/addtask') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add New Task</a>
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
                                        <th>Task ID</th>
                                        <th>Date & Time</th>
                                        <th>Company Name</th>
                                        <th>Task Category</th>
                                        <th>Assign Employee</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
										@foreach ($tasks as $val)
                                        <tr>
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->task_id}}</td>
                                        <td>{{$val->task_date}},{{$val->task_time}}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a></a>
                                                <a href="{{ url('/client-view') }}">{{$val->name}} <span><span class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">[{{$val->email}}] </span></span></a>
                                            </h2>
                                        </td>
                                        <td>{{$val->task_category}}</td>
                                        <td>{{$val->empname}}</td>
                                        <td>{{$val->due_date}}</td>
                                        @if ($val->project_status==1)  
                                        <td><span class="badge badge-pill bg-danger-light">Pending</span></td>
                                        @elseif($val->project_status==2)
										<td><span class="badge badge-pill bg-warning-light text-warning">Ongoing</span></td>
                                        @else
                                        <td><span class="badge badge-pill bg-success-light">Completed</span></td>
									    @endif
                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/view-task/'.base64_encode($val->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/edit-task/'.base64_encode($val->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
														@if (Auth::user()->u_type == 1)
                                                        <li>
                                                           <a data-id="{{$val->id}}" class="dropdown-item taskdelete" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
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
                <form action="#" autocomplete="off" id="filterForm">
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingTaskId">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseTaskId" aria-expanded="true" aria-controls="collapseTaskId">
                                    Task ID
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseTaskId" class="collapse show" aria-labelledby="headingTaskId" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="task_id_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingDateTime">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseDateTime" aria-expanded="true" aria-controls="collapseDateTime">
                                    Date & Time
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseDateTime" class="collapse" aria-labelledby="headingDateTime" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="datetime-local" class="form-control" id="date_time_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingCompanyName">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseCompanyName" aria-expanded="true" aria-controls="collapseCompanyName">
                                    Company Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseCompanyName" class="collapse" aria-labelledby="headingCompanyName" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="company_name_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingTaskCategory">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseTaskCategory" aria-expanded="true" aria-controls="collapseTaskCategory">
                                    Task Category
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseTaskCategory" class="collapse" aria-labelledby="headingTaskCategory" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="task_category_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingAssignEmployee">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseAssignEmployee" aria-expanded="true" aria-controls="collapseAssignEmployee">
                                    Assign Employee
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseAssignEmployee" class="collapse" aria-labelledby="headingAssignEmployee" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="assign_employee_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingDueDate">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseDueDate" aria-expanded="true" aria-controls="collapseDueDate">
                                    Due Date
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseDueDate" class="collapse" aria-labelledby="headingDueDate" data-bs-parent="#accordionMain1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="date" class="form-control" id="due_date_field" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingStatus">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseStatus" aria-expanded="true" aria-controls="collapseStatus">
                                    Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        {{-- <div id="collapseStatus" class="collapse show" aria-labelledby="headingStatus" data-bs-parent="#accordionMain1">
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
                        </div> --}}
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
                            <button type="reset" id="del_task" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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
        document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById("filterForm");
    const taskIdField = document.getElementById("task_id_field");
    const dateTimeField = document.getElementById("date_time_field");
    const companyNameField = document.getElementById("company_name_field");
    const taskCategoryField = document.getElementById("task_category_field");
    const assignEmployeeField = document.getElementById("assign_employee_field");
    const dueDateField = document.getElementById("due_date_field");
    const statusCheckboxes = document.querySelectorAll('input[name="status"]');
    const tableRows = document.querySelectorAll(".datatable tbody tr");

    filterForm.addEventListener("input", filterTable);
    filterForm.addEventListener("change", filterTable);

    function filterTable() {
        const taskIdValue = taskIdField.value.toLowerCase();
        const dateTimeValue = dateTimeField.value;
        const companyNameValue = companyNameField.value.toLowerCase();
        const taskCategoryValue = taskCategoryField.value.toLowerCase();
        const assignEmployeeValue = assignEmployeeField.value.toLowerCase();
        const dueDateValue = dueDateField.value;

        let selectedStatus = [];
        statusCheckboxes.forEach((checkbox) => {
            if (checkbox.checked && checkbox.value !== "all") {
                selectedStatus.push(checkbox.value);
            }
        });

        tableRows.forEach((row) => {
            const taskIdText = row.cells[1].innerText.toLowerCase();
            const dateTimeText = `${row.cells[2].innerText}`; // Combine Date & Time cell
            const companyNameText = row.cells[3].innerText.toLowerCase();
            const taskCategoryText = row.cells[4].innerText.toLowerCase();
            const assignEmployeeText = row.cells[5].innerText.toLowerCase();
            const dueDateText = row.cells[6].innerText; // Adjust according to your date format
            const statusText = row.cells[7].innerText.toLowerCase();

            const matchesTaskId = taskIdText.includes(taskIdValue);
            const matchesDateTime = dateTimeValue ? dateTimeText.includes(dateTimeValue) : true;
            const matchesCompanyName = companyNameText.includes(companyNameValue);
            const matchesTaskCategory = taskCategoryText.includes(taskCategoryValue);
            const matchesAssignEmployee = assignEmployeeText.includes(assignEmployeeValue);
            const matchesDueDate = dueDateValue ? dueDateText.includes(dueDateValue) : true;
            const matchesStatus = selectedStatus.length === 0 || selectedStatus.includes(statusText);

            if (
                matchesTaskId &&
                matchesDateTime &&
                matchesCompanyName &&
                matchesTaskCategory &&
                matchesAssignEmployee &&
                matchesDueDate &&
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


