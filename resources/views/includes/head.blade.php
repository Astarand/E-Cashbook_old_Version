

    <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>E-cashbook</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset('public/assets/img/favicon.png')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/plugins/fontawesome/css/all.min.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/plugins/feather/feather.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-datetimepicker.min.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/plugins/datatables/datatables.min.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
		<link rel="stylesheet" href="{{asset('public/assets/css/custom-css.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/plugins/icons/feather/feather.css')}}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


		<script src="{{asset('public/assets/js/jquery-3.7.0.min.js')}}"></script>
        <script src="<?php  echo asset('public/assets/js/jquery-ui.min.js'); ?>"></script>
        <script src="{{asset('public/assets/js/jquery-ui.min.js')}}"></script>

        <script src="{{asset('public/assets/js/jquery.maskedinput.min.js')}}"></script>

        <script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>

        <!--<script src="{{asset('public/assets/js/form-validation')}}"></script>-->

        <script src="{{asset('public/assets/js/moment.js')}}"></script>
        <script src="{{asset('public/assets/js/bootstrap-datetimepicker.min.js')}}"></script>

        <script src="{{asset('public/ckeditor/ckeditor.js')}}"></script>
        <script src="<?php  echo asset('public/assets/js/feather.min.js'); ?>"></script>
		<script src="<?php  echo asset('public/assets/js/jquery.validate.js'); ?>"></script>

        <!--<script src="{{asset('public/assets/js/ckeditor.js')}}"></script>-->

        <script src="{{asset('public/assets/js/feather.min.js')}}"></script>

		<script src="<?php  echo asset('public/assets/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
		<script src="<?php  echo asset('public/assets/plugins/apexchart/apexcharts.min.js'); ?>"></script>
		<script src="<?php  echo asset('public/assets/plugins/apexchart/chart-data.js'); ?>"></script>
		<script src="<?php  echo asset('public/assets/plugins/apexchart/mask.js'); ?>"></script>

		<script src="<?php  echo asset('public/assets/js/jquery.validate.js'); ?>"></script>

        <script src="{{asset('public/assets/js/script.js')}}"></script>
        <script src="<?php  echo asset('public/assets/js/custom_script.js'); ?>"></script>
        <script src="{{asset('public/assets/js/ca.js')}}"></script>
        <script src="{{asset('public/assets/js/message.js')}}"></script>
        <script src="{{asset('public/assets/js/charts_custom.js')}}"></script>
        <script src="{{asset('public/assets/js/admin_script.js')}}"></script>

        <script src="<?php  echo asset('public/assets/plugins/select2/js/select2.min.js'); ?>"></script>
        <script src="<?php  echo asset('public/assets/plugins/select2/js/custom-select.js'); ?>"></script>
        <script src="<?php  echo asset('public/assets/plugins/summernote/summernote-lite.min.js'); ?>"></script>


		<input type="hidden" id="base_url" value="{{URL::to('/')}}">
