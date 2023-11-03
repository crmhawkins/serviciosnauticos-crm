<!-- contenedor-sidebar -->
<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    @mobile
    <div class="topbar-left" style="margin-bottom: -145px !important;">
        <button class="logo button-menu-mobile open-left waves-effect w-100" style="background-color: #5083b5 !important; text-align: center;">
            @if (session()->has('clubSeleccionado'))
                @switch(session('clubSeleccionado'))
                    @case(1)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club1.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club1.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(2)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club2.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club2.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(3)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club3.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club3.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(4)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club4.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club4.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(5)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club5.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club5.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @default
                @endswitch
            @else
                <span class="logo-light">
                    <img class="img-fluid p-4" src="{{ asset('assets/images/logo-empresa.png') }}"
                        alt="Logo La Fabrica">
                    {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                </span>
                <span class="logo-sm">
                    <img class="img-fluid p-1" src="{{ asset('assets/images/logo-empresa.png') }}"
                        alt="Logo La Fabrica">
                </span>
            @endif
        </button>
    </div>
    @elsemobile
    <div class="topbar-left" style="margin-bottom: -145px !important;">
        <button class="logo button-menu-mobile open-left waves-effect w-100 h-100" style="background-color: #5083b5 !important; text-align: center;">
            @if (session()->has('clubSeleccionado'))
                @switch(session('clubSeleccionado'))
                    @case(1)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club1.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club1.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(2)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club2.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club2.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(3)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club3.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club3.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(4)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club4.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club4.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @case(5)
                        <span class="logo-light">
                            <img class="img-fluid p-4" src="{{ asset('assets/images/logo_club5.png') }}" alt="Logo La Fabrica">
                            {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                        </span>
                        <span class="logo-sm">
                            <img class="img-fluid p-1" src="{{ asset('assets/images/logo_club5.png') }}" alt="Logo La Fabrica">
                        </span>
                    @break

                    @default
                @endswitch
            @else
                <span class="logo-light">
                    <img class="img-fluid p-4" src="{{ asset('assets/images/logo-empresa.png') }}"
                        alt="Logo La Fabrica">
                    {{-- <i class="mdi mdi-camera-control"></i> La Fabrica --}}
                </span>
                <span class="logo-sm">
                    <img class="img-fluid p-1" src="{{ asset('assets/images/logo-empresa.png') }}"
                        alt="Logo La Fabrica">
                </span>
            @endif
        </button>
    </div>
@endmobile
    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
            <!-- language-->
            {{-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                            <a class="dropdown-item" href="#"><img src="https://crm.fabricandoeventosjerez.com/assets/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                        </div>
                    </li> --}}

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                </a>
            </li>

            <!-- notification -->
            <li class="dropdown notification-list list-inline-item">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pill badge-danger noti-icon-badge">{{ count($alertas) }}</span>
                </a>
                @if (count($alertas) > 0)
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                        <!-- item-->
                        <h6 class="dropdown-item-text">
                            Notifications
                        </h6>

                        <div class="slimscroll notification-item-list">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text
                                        of the printing and typesetting industry.</span></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                <p class="notify-details"><b>New Message received</b><span class="text-muted">You have
                                        87 unread messages</span></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a
                                        long established fact that a reader will</span></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                <p class="notify-details"><b>New Message received</b><span class="text-muted">You have
                                        87 unread messages</span></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy
                                        text
                                        of the printing and typesetting industry.</span></p>
                            </a>

                        </div>
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                            Ver Todas <i class="fi-arrow-right"></i>
                        </a>


                    </div>
                @else
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                        <!-- item-->
                        <h6 class="dropdown-item-text">
                            No tienes notificaciones
                        </h6>
                    </div>
                @endif
            </li>

            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="https://crm.fabricandoeventosjerez.com/assets/images/users/user-4.jpg"
                            alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> Wallet</a>
                        <a class="dropdown-item d-block" href="#"><span
                                class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i>
                            Settings</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock
                            screen</a>
                        <div class="dropdown-divider"></div>
                        {{-- Formulario invisible para que Laravel detecte el cierre de sesión como POST. --}}
                        @auth
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        {{-- El mismo enlace, con un evento onclick para que haga submit del formulario y cierre sesión.  --}}
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-power text-danger"></i>Cerrar sesión</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
            {{-- <li class="d-none d-md-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li> --}}
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
