@extends('layouts.default')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header ">
                <h5>Items Unit Logs</h5>
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
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class=" card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>                                        
                                        <th>Date</th>
                                        <th>Item base unit</th>
                                        <th>Item secondary unit</th>
                                        <th>Item other unit</th>                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
									<?php $i = 1; ?>
									@foreach ($items as $item)
                                    <tr>
                                        <td><?php echo $i++; ?></td>						
										<td>{{ date("d M Y",strtotime($item->created_at)) }}</td>       
                                        <td>{{ $item->item_base_unit }}</td>
                                        <td>{{ $item->item_sec_unit }}</td>                     
                                        <td>{{ $item->item_unit_other }}</td>
                                        
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