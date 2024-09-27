@extends('layouts.default')

@section('content')
   <div class="page-wrapper">
      <div class="content container-fluid">

            <div class="page-header">
               <div class="content-page-header">
                  <h5>Expenses</h5>
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
                              <a class="btn btn-primary" href="{{ url('/addexpenses') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Expenses</a>
                           </li>
                     </ul>
                  </div>
               </div>
            </div>

            <div id="filter_inputs" class="card filter-card">
                <div class="card-body pb-0">
                   <div class="row">
                      <div class="col-sm-6 col-md-3">
                         <div class="input-block mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control">
                         </div>
                      </div>
                      <div class="col-sm-6 col-md-3">
                         <div class="input-block mb-3">
                            <label>Email</label>
                            <input type="text" class="form-control">
                         </div>
                      </div>
                      <div class="col-sm-6 col-md-3">
                         <div class="input-block mb-3">
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
                                       <th>Invoice / Ref No.</th>
                                       <th>Date</th>
                                       <th>Expense Category </th>
                                       <th>Amount</th>
                                       <th>Approve By</th>
                                       <th class="no-sort">Actions</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php $i = 1; ?>
									@foreach ($expenses as $val)
									<tr>
										<td><?php echo $i++; ?></td>
										<td>{{ $val->exp_invno }}</td>
										<td>{{ date("d-m-Y",strtotime($val->expense_date)) }}</td>                                                          
										<td>{{ $val->expense_cat }}</td>                                                          
										<td><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; {{ $val->expense_amt }}</td>
										<td>{{ $val->approved_by }}</td>
										<td class="d-flex align-items-center">
											<a href="{{ url('/view-expenses/'.base64_encode($val->id)) }}" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i> Show details</a>
											<div class="dropdown dropdown-action">
												<a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-end">
													<ul>
														@if ( (Auth::user()->u_type == 2 || Auth::user()->u_type == 3))
														<li>
															<a class="dropdown-item" href="{{ url('/edit-expenses/'.base64_encode($val->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
														</li>
														<li>
															<a class="dropdown-item expensedelete" data-id="{{$val->id}}" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
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

   <div class="toggle-sidebar ledge">
      <div class="sidebar-layout-filter">
         <div class="sidebar-header ledge">
            <h5>PayIn</h5>
            <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
         </div>
         <div class="sidebar-header submenu">
            <h6>Test Company</h6>
            <p class="text-success-light">Balance: $400</p>
         </div>
         <div class="sidebar-body">
            <form action="#" autocomplete="off">
               <div class="accordion accordion-last" id="accordionMain1">
                  <div class="card-header-new" id="headingOne">
                     <h6 class="filter-title">
                        <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Customers
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
                                    <input type="text" class="form-control" id="member_search1" placeholder="Search Customer">
                                    <span><img src="assets/img/icons/search.svg" alt="img"></span>
                                 </div>
                                 <div class="selectBox-cont">
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="username">
                                    <span class="checkmark"></span> John Smith
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="username">
                                    <span class="checkmark"></span> Johnny Charles
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="username">
                                    <span class="checkmark"></span> Robert George
                                    </label>
                                    <label class="custom_check w-100">
                                    <input type="checkbox" name="username">
                                    <span class="checkmark"></span> Sharonda Letha
                                    </label>
                                    <div class="view-content">
                                       <div class="viewall-One">
                                          <label class="custom_check w-100">
                                          <input type="checkbox" name="username">
                                          <span class="checkmark"></span> Pricilla Maureen
                                          </label>
                                          <label class="custom_check w-100">
                                          <input type="checkbox" name="username">
                                          <span class="checkmark"></span> Randall Hollis
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
                  <div class="col-lg-12 col-sm-12">
                     <div class="input-block mb-3">
                        <label>Enter Amount</label>
                        <input type="text" class="form-control" placeholder="Enter Amount">
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="input-block mb-3">
                        <label>Payment Date</label>
                        <div class="cal-icon cal-icon-info">
                           <input type="text" class="datetimepicker form-control" placeholder="Select Date">
                        </div>
                     </div>
                  </div>
                  <div class="input-block mb-3 notes-form-group-info">
                     <label>Notes</label>
                     <textarea class="form-control" placeholder="Enter your notes"></textarea>
                  </div>
                  <div class="modal-footer">
                     <a href="#" data-bs-dismiss="modal" class="btn btn-back cancel-btn me-2">Cancel</a>
                     <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Add Payment</a>
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

@endsection
