@php
$user = Auth::user();
@endphp
<a href="" class="brand-link sidebar-dark-primary">
<span class="brand-text font-weight-light text-xs">SUPREME HEALTH CARE & MEDICAL SOLUTION</span>
</a>
<!-- Sidebar -->
<div class="sidebar ">
<!-- Sidebar user (optional) -->
<div class="user-panel pb-3 mb-3 mt-2 d-flex justify-content-center">
    <div class="text-center ">
        <img class="profile-user-img  img-circle" style="height:80px; width:80px"
            src="{{ !empty($user->image) ? url('./upload/user_images/' .$user->image) : url('./upload/user_images/no-user.png') }}"
            name="image" alt="User profile picture">
            <h5 class="text-white mt-1">{{Auth::user()->name}}</h5>
            <p class="text-light">{{Auth::user()->email}}</p>
            <a href="{{route('profiles.view')}}" class="btn btn-sm bg-sec text-white px-5">View Profile</a>
    </div>
    <div class="info">
        
    </div>
</div>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Privacy Policy
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Terms & Conditions
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Developers Manual
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    About Us
                </p>
            </a>
        </li>
     
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->