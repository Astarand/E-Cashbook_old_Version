@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Payment</h5>
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#day" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="false" role="tab" tabindex="-1">
                                        Daywise Payment
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#month" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">
                                        Monthwise Payment
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="day" role="tabpanel">
                                    <div class="col-sm-12 pb-4 d-flex justify-content-end">
                                        <a class="btn btn-primary" href="addpayment"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add new Payment</a>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card-table">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-center table-hover datatable">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Pay voucher no</th>
                                                            <th>Purpose Of Payment</th>
                                                            <th>Mode of Payment</th>
                                                            <th>Payment Type</th>
                                                            <th>Payment Amount</th>                                                            
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @php($inc =  1)
                                                            @foreach($payment as $row)
                                                                <tr>
                                                                    <td>{{$inc}}</td>
                                                                    <td>
                                                                        {{$row->payment_date}}
                                                                    </td>
																	<td>
                                                                        {{$row->pay_voucher_no}}
                                                                    </td>
                                                                    <td>
                                                                        {{$row->purpose_of_payment}}
                                                                    </td>
                                                                    <td>
                                                                        {{$row->mode_of_payment}}
                                                                    </td>
                                                                    <td>
                                                                        {{$row->payment_type}}
                                                                    </td>
                                                                    <td>
                                                                        {{$row->amount}}
                                                                    </td>
                                                                    
                                                                    <!--<td>
                                                                        <a class="btn btn-success text-white" href="{{ url('/edit-vendor/'.base64_encode($row->id)) }}">Edit vendor</a>
                                                                        <a class="btn btn-danger text-white delete_vendor" href="javascript:void(0);" data-id="{{$row->id}}">Delete vendor</a>
                                                                    </td>-->
                                                                    <td class="d-flex align-items-center">
                                                                    <a href="{{ url('/view-payment/'.base64_encode($row->id)) }}" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> View</a>
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul>
                                                                            <li>
                                                                                <a class="dropdown-item" href="{{ url('/edit-payment/'.base64_encode($row->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                                            </li>
                                                                            
                                                                            <li>
                                                                                <a data-id="{{$row->id}}" class="dropdown-item paymentdelete" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="dropdown-item" href="{{ url('/view-payment/'.base64_encode($row->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                                            </li>
                                                                            
                                                                           
                                                                            
                                                                        </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                </tr>
                                                                @php($inc++)
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="month" role="tabpanel">
                                    <div class="col-sm-12">
                                        <div class="card-table">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-center table-hover datatable">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Month</th>
                                                            <th>Total Payment Amount</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j = 1; ?>
														@foreach ($monthWisePayment as $monthWise)
                                                        <tr>
                                                            <td><?php echo $j++; ?></td>                                                            
                                                            <td>{{ date('M-Y', strtotime($monthWise->month)) }}</td>
                                                            <td><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; {{ $monthWise->amount }}</td>
                                                            <td class="d-flex align-items-center">
                                                                <a href="{{ url('/viewmonthpayment/'.base64_encode($monthWise->month).'/'.base64_encode($monthWise->custId)) }}" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i> View</a>
                                                            </td>
                                                        </tr>
														@endforeach
                                                        </tbody>
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
                                    Customer Name
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Email Address
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Phone Number
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1" placeholder="Search here">
                                                <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <button type="reset" id="del_payment" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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

@endsection
