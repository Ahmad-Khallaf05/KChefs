<div class="main-header">
    <div class="logo-header">
        <a href="{{ route('home') }}" class="logo">KChefs</a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
    </div>
    
    <nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">               
            @if(auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'chef'))
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('./assets/dashboard/img/default-profile.jpg') }}" 
                             alt="user-img" 
                             width="36" 
                             class="img-circle">
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <div class="user-box">
                                <div class="u-img">
                                    
                                    @if(auth()->user()->role == 'chef' && auth()->user()->chef)
                                        <!-- Display chef's profile picture if available -->
                                        <img src="{{ auth()->user()->chef->profile_picture ? asset('storage/' . auth()->user()->chef->profile_picture) : asset('./assets/dashboard/img/default-profile.jpg') }}" 
                                             alt="Img Profile">
                                    @else
                                        <!-- Display user's profile picture if available -->
                                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('./assets/dashboard/img/default-profile.jpg') }}" 
                                             alt="Img Profile">
                                    @endif
                                </div>
                                <div class="u-text">
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                    <a href="{{ route('profile') }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                </div>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('home') }}">Home Page</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

</div>
