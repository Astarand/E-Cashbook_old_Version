
<!doctype html>
<html lang="en">

<head>
    @include('includes.head')
</head>
<body>
		
		<!--<div class="main-wrapper">-->
		@if (Request::path() != 'userlogin' &&  Request::path() != 'signup' &&  Request::path() != 'forgotpassword')
        @include('includes.header')
		@include('includes.sidebar')
		@endif
			<!--<div id="main" class="content">-->

					@yield('content')

			<!--</div>-->
		<!--</div>-->
    <div class="footer">
        @include('includes.footer')
    </div>


</body>
</html>