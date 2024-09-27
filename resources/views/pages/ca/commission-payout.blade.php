@extends('layouts.default')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header ">
                <h5>Transactions</h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg') }}" alt="filter"></span>Filter </a>
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
                                    <th>Date</th>
                                    <th>Schedule </th>
                                    <th>Transaction ID </th>
                                    <th>Payment Amount</th>
                                    <th>Mode of Payment</th>
                                    <th>Account Holder Name</th>
                                    <th>Account Number</th>
                                    <th>Bank Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>19 Dec 2023, 06:12 PM</td>
                                    <td>First Fortnight</td>
                                    <td>Bank2564282</td>
                                    <td class="text-success-light"><i class="fa-solid fa-indian-rupee-sign"></i> 650</td>
                                    <td>IMPS</td>
                                    <td>Ram Mondal</td>
                                    <td>123456882548</td>
                                    <td>ABC Bank</td>
                                    <td><span class="badge  bg-success-light">Completed</span></td>
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
@endsection
