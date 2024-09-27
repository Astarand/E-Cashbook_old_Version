@extends('layouts.default')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header ">
                <h5>Items</h5>
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
						@if (Auth::user()->u_type == 2)
                        <li>
                            <a class="btn btn-primary" href="{{ url('/additem') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Product/Service</a>
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
                <div class=" card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable" >
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Item Id</th>
                                        {{-- <th>Company Name</th> --}}
                                        <th>Product/Service</th>
                                        <th>Date</th>
                                        
                                        <th>HSN/SAC</th>
                                        <th>Type</th>
                                        {{-- <th>Units</th> --}}
                                        {{-- <th>Quantity</th> --}}
                                        <th>Selling Price</th>
                                        <th>Purchase Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $i = 1; ?>
									@foreach ($items as $item)
                                    <tr>
                                        <td><?php echo $i++; ?></td>
										<td>{{ $item->item_id }}</td>
										{{-- <td>{{ $item->comp_name }}</td> --}}
										
                                        <td>
											<?php $arrayOfFiles = explode(',',$item->prod_image); ?>
											<a href class="product-list-item-img">
												{{-- <img src="{{ asset('/public/uploads/items-image/'.$arrayOfFiles[0]) }}" alt> --}}
                                                <span>{{ $item->item_name }}</span>
											</a>
										</td>
                                        <td>{{ date("d M Y",strtotime($item->item_date)) }}</td>
                                        <td>
											@if($item->item_type =='service') 
												{{ $item->sac_code }}
											@else
												{{ $item->hsn_code }}
											@endif
										</td>
                                        <td>{{ $item->item_type }}</td>
                                        {{-- <td>{{ $item->base_unit }}</td> --}}
                                        {{-- <td>{{ $item->min_wholesale_quantity }}</td> --}}
                                        <td>₹{{ $item->selling_price }}</td>
                                        <td>₹{{ $item->purchase_price }}</td>
                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
														@if (Auth::user()->u_type == 2 || Auth::user()->u_type == 3)
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/view-item/'.base64_encode($item->id)) }}"><i class="far fa-edit me-2"></i>View</a>
                                                        </li>
														<li>
                                                            <a class="dropdown-item" href="{{ url('/edit-item/'.base64_encode($item->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item itemdelete" data-id="{{$item->id}}" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
														@else
														<li>
                                                            <a class="dropdown-item" href="{{ url('/view-item/'.base64_encode($item->id)) }}"><i class="far fa-edit me-2"></i>View</a>
                                                        </li>
														@endif
														<li>
                                                            <a class="dropdown-item" href="{{ url('/item-history/'.base64_encode($item->id)) }}"><i class="far fa-edit me-2"></i>Item logs</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
							<div class="d-flex justify-content-center">
								<?php echo $items_pagination->links() ?>
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
                            Product Name
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
                                            <input type="text" class="form-control" id="member_search1" placeholder="Search Product">
                                            <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                        </div>
                                        <div class="selectBox-cont">
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Lorem ipsum dolor sit
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Lorem ipsum dolor sit
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Lorem ipsum dolor sit
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Lorem ipsum dolor sit
                                            </label>
                                            <div class="view-content">
                                                <div class="viewall-One">
                                                    <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Lorem ipsum dolor sit
                                                    </label>
                                                    <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Lorem ipsum dolor sit
                                                    </label>
                                                    <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Lorem ipsum dolor sit
                                                    </label>
                                                </div>
                                                <div class="view-all">
                                                    <a href="javascript:void(0);" class="viewall-button-One"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordionMain2">
                    <div class="card-header-new" id="headingTwo">
                        <h6 class="filter-title">
                            <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Product Code
                            <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                        <div class="card-body-chat">
                            <div id="checkBoxes3">
                                <div class="selectBox-cont">
                                    <div class="form-custom">
                                        <input type="text" class="form-control" id="member_search2" placeholder="Search Invoice">
                                        <span><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></span>
                                    </div>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> P125389
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> P125390
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> P125391
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> P125392
                                    </label>
                                    <div class="view-content">
                                        <div class="viewall-Two">
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> P125393
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> P125394
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> P125395
                                            </label>
                                        </div>
                                        <div class="view-all">
                                            <a href="javascript:void(0);" class="viewall-button-Two"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordionMain3">
                    <div class="card-header-new" id="headingThree">
                        <h6 class="filter-title">
                            <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Units
                            <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                        <div class="card-body-chat">
                            <div id="checkBoxes2">
                                <div class="selectBox-cont">
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Inches
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Pieces
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Hours
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Box
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Kilograms
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="bystatus">
                                    <span class="checkmark"></span> Meter
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion accordion-last" id="accordionMain4">
                    <div class="card-header-new" id="headingFour">
                        <h6 class="filter-title">
                            <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            Category
                            <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                        </h6>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample4">
                        <div class="card-body-chat">
                            <div id="checkBoxes4">
                                <div class="selectBox-cont">
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> Advertising
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> Food
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> Marketing
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="category">
                                    <span class="checkmark"></span> Software
                                    </label>
                                    <div class="view-content">
                                        <div class="viewall-Two">
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Repairs
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Stationary
                                            </label>
                                            <label class="custom_check w-100">
                                            <input type="checkbox" name="username">
                                            <span class="checkmark"></span> Designing
                                            </label>
                                        </div>
                                        <div class="view-all">
                                            <a href="javascript:void(0);" class="viewall-button-Two"><span class="me-2">View All</span><span><i class="fa fa-circle-chevron-down"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
                    Apply
                    </button>
                    <button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
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
                    <h3>Delete Products / Services</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <button type="reset" data-bs-dismiss="modal" id="del_item" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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