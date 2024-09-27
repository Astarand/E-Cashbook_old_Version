@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Quote Set</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-primary" href="{{ url('/addquote') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add New Quote</a>
                            </li>
                        </ul>
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
                                        <th>Task Category</th>
                                        {{-- <th>Task Sub-category</th> --}}
                                        <th>Goverment Fees</th>
                                        <th>Services Charges</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
										@foreach ($quotes as $val)
                                    <tr>
                                        {{-- <td>{{$val->id}}</td> --}}
                                        <td><?php echo $i++; ?></td>
                                        <td>{{$val->task_cat}}</td>
                                        {{-- <td>{{$val->task_sub_cat}}</td> --}}
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; {{$val->govfee}}</td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp; {{$val->service_charge}}</td>

                                        <td class="d-flex align-items-center">
                                            <div class="dropdown dropdown-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{ url('/edit-quote/'.base64_encode($val->id)) }}" class=" btn-action-icon "><i class="far fa-edit"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a  data-id="{{$val->id}}" href="javascript:void(0);" class=" btn-action-icon quotedelete" data-bs-toggle="modal" data-bs-target="#delete_modal" aria-expanded="false"><i class="far fa-trash-alt"></i></a>
                                                    </div>
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

    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Quote Set</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="reset" data-bs-dismiss="modal" id="del_quote" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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
