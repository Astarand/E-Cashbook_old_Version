@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-3">
                                    <a href="#"><i class="fa-solid fa-file-alt"></i></a>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Task</div>
                                    <div class="dash-counts">
                                        <p> <strong>Total Pending:</strong> &nbsp;<span class="text-danger"> {{ isset($tasks[0]->pending)?$tasks[0]->pending:0 }}</span></p>
                                        <p> <strong>Total Ongoing:</strong> &nbsp;<span class="text-warning"> {{ isset($tasks[0]->ongoing)?$tasks[0]->ongoing:0 }}</span></p>
                                        <p> <strong>Total Completed :</strong> &nbsp;<span class="text-success"> {{ isset($tasks[0]->completed)?$tasks[0]->completed:0 }}</span></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                



            </div>
        </div>
    </div>

@stop





