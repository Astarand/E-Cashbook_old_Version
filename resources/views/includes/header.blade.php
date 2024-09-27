<div class="header header-one">
    <a href="javascript:void(0);" id="toggle_btn">
        <span class="toggle-bars">
            <span class="bar-icons"></span>
            <span class="bar-icons"></span>
            <span class="bar-icons"></span>
            <span class="bar-icons"></span>
        </span>
    </a>

    <div class="top-nav-search">
        <form>
            <input type="text" class="form-control" placeholder="Search Transaction">
            <button class="btn" type="submit"><img src="{{asset('public/assets/img/icons/search.svg')}}" alt="img"></button>
        </form>
    </div>
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <ul class="nav nav-tabs user-menu">
        <li class="nav-item dropdown  flag-nav dropdown-heads">
			@if (Auth::user())
			<?php 
			$userId = Auth::user()->id;
			$notifications = Helper::getNotification($userId);
			$profileImage = Helper::getProfileImage();
			//echo "<pre>";print_r($notifications);exit;
			?>
            <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button"><i class="fe fe-bell"></i> <span class="badge rounded-pill notiCount"><?php echo count((array)$notifications); ?></span></a>
			
			@endif
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti" onClick="clearNoti(<?php echo $userId?>)"> Clear All</a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
						<?php if($notifications) { 
						foreach($notifications as $k=>$notiVal){
						?>
                        <li class="notification-message">
                            <a href="javascript:void(0);">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt src="{{asset($notiVal->avatar)}}">
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">{{ $notiVal->name }}</span> {{ $notiVal->msg }} <span class="noti-title">{{ $notiVal->noti_title }}</span></p>
                                        <p class="noti-time"><span class="notification-time">{{ $notiVal->created_at }}</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
						<?php } } ?>
                        <!--<li class="notification-message">
                            <a href="profile.html">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt src="{{asset('public/assets/img/profiles/avatar-03.jpg')}}">
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Marie Canales</span> has accepted your estimate <span class="noti-title">#GTR458789</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="profile.html">
                                <div class="media d-flex">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-title rounded-circle bg-primary-light"><i class="far fa-user"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">New user registered</span></p>
                                        <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="profile.html">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt src="{{asset('public/assets/img/profiles/avatar-04.jpg')}}">
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Barbara Moore</span> declined the invoice <span class="noti-title">#RDW026896</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="profile.html">
                                <div class="media d-flex">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-title rounded-circle bg-info-light"><i class="far fa-comment"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">You have received a new message</span></p>
                                        <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>-->
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{ url('/view-all-notification') }}">View all Notifications</a>
                </div>
            </div>
        </li>
        <li class="nav-item  has-arrow dropdown-heads ">
            <a href="javascript:void(0);" class="win-maximize">
                <i class="fe fe-maximize"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <!--<img src="{{asset('public/assets/img/profiles/avatar-07.jpg')}}" alt="img" class="profilesidebar">-->
					
					@if((Auth::user()->u_type==1 || Auth::user()->u_type==2) && $profileImage !="")
					<img id="image-preview" class="avatar" src="{{asset('/public/uploads/profile/'.$profileImage)}}" alt="img" class="profilesidebar">
					@else
					<img id="image-preview" class="avatar" src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt="img" class="profilesidebar">
					@endif
										
                    <span class="animate-circle"></span>
                </span>
                <span class="user-content">
					@if (Auth::user())
					<span class="user-details">
					@if(Auth::user()->u_type==1)
						Accountant
					@elseif(Auth::user()->u_type==2)
						User
					@else
						Admin
					@endif
					</span>
                    <span class="user-name">{{ Auth::user()->name }}</span>
					@endif
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilemenu">
					@if (Auth::user())
                    <div class="subscription-menu">
                        <ul>
                            <li>
								@if(Auth::user()->u_type==1)
								<a class="dropdown-item" href="{{ url('/caprofile') }}">Profile</a>
								@elseif(Auth::user()->u_type==2)
								<a class="dropdown-item" href="{{ url('/companyprofile') }}">Profile</a>
								@elseif(Auth::user()->u_type==3)
								<a class="dropdown-item" href="javascript:void(0);">Profile</a>
								@endif
							</li>
                            <li><a class="dropdown-item" href="{{ url('/reset-password') }}">Change Password</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Settings</a></li>
                        </ul>
                    </div>
					@endif
                    <div class="subscription-logout">
                        <ul>
							@if (!Auth::user())
                            <li class="pb-0">
                                <a class="dropdown-item" href="{{ url('/userlogin') }}">Login</a>
                            </li>
							@endif
							@if (Auth::user())
							<li class="pb-0">
                                <a class="dropdown-item" href="{{ url('/logout') }}">Log Out</a>
                            </li>
							@endif
                        </ul>
                    </div>
                </div>
            </div>
        </li>

    </ul>
</div>