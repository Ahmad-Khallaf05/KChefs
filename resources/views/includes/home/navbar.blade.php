<header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:contact@example.com">contact@example.com</a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <span>+1 5589 55488 55</span>
                </i>
            </div>
            <div class="languages d-none d-md-flex align-items-center">
                <ul>
                    <li>En</li>
                    <li><a href="#">De</a></li>
                </ul>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">KChefs</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="active">Home</a></li>
                    <li><a href="{{ route('chefs') }}" class="active">Chefs</a></li>
                    <li><a href="{{ route('dishes') }}" class="active">Dishes</a></li>
                    <li><a href="{{ route('home') }}#about">About</a></li>
                    <li><a href="{{ route('home') }}#menu">Menu</a></li>
                    <li><a href="{{ route('home') }}#specials">Specials</a></li>
                    <li><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- Add guest/login/register/logout buttons here -->
            <div class="auth-buttons d-flex align-items-center">
                @guest
                    @if (Route::has('login'))
                        <a class="btn-book-a-table d-none d-xl-block" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn-book-a-table d-none d-xl-block" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="dropdown">
                        <a id="navbarDropdown" class="btn-book-a-table d-none d-xl-block dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>
