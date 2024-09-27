@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>GSTIN/ UIN of the Taxpayer</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#">
                                <div class=" mb-3 row">
                                    <div class="col-lg-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Enter GSTIN / UIN Number" aria-label="Username" aria-describedby="basic-addon1">
                                            <button class="btn btn-primary" type="button">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-bordered">
                                <li class="nav-item">
                                    <a href="#gstin_profile" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <strong>GSTIN Profile</strong>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#gstin_return_status" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                        <strong>GST Return Status</strong>
                                    </a>
                                </li>
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="gstin_profile">
                                    <div class="table-responsive">
                                        <table class="table table-striped  mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>GSTIN of the Tax Payer</td>
                                                    <td>123456789552</td>
                                                </tr>
                                                <tr>
                                                    <td>Legal Name of the Business</td>
                                                    <td>Prosanta Sadhukhan</td>
                                                </tr>
                                                <tr>
                                                    <td>Principal Place Of BUsiness</td>
                                                    <td>Dooley</td>
                                                </tr>
                                                <tr>
                                                    <td>Additional Place of Business</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>State Jurisdiction</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Center Jurisdiction</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Registation</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Consitution of Business</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Taxpayer Type</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>GSTIN Status</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Cancellation</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="gstin_return_status">
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                                <h5>Choose Financial Year: </h5>
                                                <div class="dropdown main">
                                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">2023-2024</button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item">2022-2023</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item">2021-2022</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item">2020-2019</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead style="background-color: #ddd;">
                                                    <tr>
                                                        <th>Valid</th>
                                                        <th>Mode of Filling</th>
                                                        <th>Date of Filing</th>
                                                        <th>Return Period</th>
                                                        <th>Return Type</th>
                                                        <th>ARN</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Y</td>
                                                        <td>Online</td>
                                                        <td>15-03-2024</td>
                                                        <td>GSTR3B</td>
                                                        <td>022024</td>
                                                        <td>AA1902244806912</td>
                                                        <td>Failed</td>
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
            </div>
        </div>
    </div>
@endsection