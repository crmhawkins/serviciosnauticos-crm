<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MARINERÍA CRM - @yield('title') </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.css"
        integrity="sha512-CaTMQoJ49k4vw9XO0VpTBpmMz8XpCWP5JhGmBvuBqCOaOHWENWO1CrVl09u4yp8yBVSID6smD4+gpzDJVQOPwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <x-livewire-alert::scripts />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- jQuery debe cargarse antes que cualquier script que lo use -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
      <!--Morris Chart CSS -->
      <link rel="stylesheet" href="../../plugins/morris/morris.css">

      <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
      <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
      <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="../css/metismenu.min.css"> --}}
    @yield('head')


</head>

<body>
    @php
        $user = Auth::user();
    @endphp
    <div id="app">
        <style>
            /* .sidebar {
                width: 15%;
            } */

            .contain {
                width: 85%;
                margin-left: 20%;
                /* min-width: 600px; */
            }

            @media (max-width: 992px) {
                .contain {
                margin-left: 200px;
                /* min-width: 600px; */
            }

            }
            
        </style>
        <div class="page-wrapper chiller-theme toggled sticky-sidebar" id="wrapper">
            {{-- @include('layouts.sideba/*  */r') --}}
            <div class="content-page">
                {{-- Navbar superior solo en desktop/tablet --}}
                @notmobile
                    @include('layouts.top-main-nav')
                @endnotmobile
                <div class="content">
                    {{-- @livewire('container-component') --}}
                    @yield('content-principal')

                    @yield('content-factura')
                    {{-- @yield('content') --}}

                </div>

            </div>
            {{-- <div class="row w-100 m-0">
                <div class="col-md-2 p-0 contenedor-sidebar">

                </div>
                <div class="col-md-10 p-0 contenedor-main">
                    <div class="">

                    </div>
                </div>
            </div> --}}


            @include('layouts.bottom-nav')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/metismenu.min.js"></script>
    <script src="../../assets/js/jquery.slimscroll.js"></script>
    <script src="../../assets/js/waves.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!--Morris Chart-->
    {{-- <script src="../plugins/morris/morris.min.js"></script> --}}
    <script src="../../plugins/raphael/raphael.min.js"></script>

    {{-- <script src="../assets/pages/dashboard.init.js"></script> --}}

    <!-- App js -->
    @livewireScripts
    <script src="../../assets/js/app.js"></script>
    @yield('scripts')

    <!-- Error Modals JavaScript -->
    <script>
        // Manejo de modales de error
        window.addEventListener('show-error-modal', event => {
            const { title, message, type } = event.detail;
            
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#dc3545',
                showCloseButton: true,
                allowOutsideClick: true,
                customClass: {
                    popup: 'swal2-popup-error'
                }
            });
        });

        // Manejo de modales de éxito
        window.addEventListener('show-success-modal', event => {
            const { title, message } = event.detail;
            
            Swal.fire({
                title: title,
                text: message,
                icon: 'success',
                confirmButtonText: 'Perfecto',
                confirmButtonColor: '#28a745',
                showCloseButton: true,
                allowOutsideClick: true,
                timer: 3000,
                timerProgressBar: true
            });
        });
    </script>

</body>

@php
    $clubId = session('clubSeleccionado');
    $club = $clubId ? \App\Models\Club::find($clubId) : null;
    $logo = null;
    if ($club && !empty($club->club_logo)) {
        $candidates = [
            'assets/images/' . ltrim($club->club_logo, '/'), // public/assets/images
            'images/' . ltrim($club->club_logo, '/'),        // public/images
            ltrim($club->club_logo, '/'),                    // ruta absoluta relativa al public
        ];
        foreach ($candidates as $c) {
            if (file_exists(public_path($c))) { $logo = asset($c); break; }
        }
        // Si no encuentra archivo local, intenta tratar club_logo como URL absoluta
        if (!$logo && filter_var($club->club_logo, FILTER_VALIDATE_URL)) { $logo = $club->club_logo; }
    }
    $logo = $logo ?: asset('la_fabrica_logo.png');
@endphp

@if($clubId)
    <style>
        .floating-club-badge{position:fixed;left:16px;top:88px;z-index:1100;width:56px;height:56px;border-radius:50%;background:#fff;border:2px solid #e5e7eb;box-shadow:0 6px 18px rgba(0,0,0,.18);display:flex;align-items:center;justify-content:center;overflow:hidden}
        .floating-club-badge img{width:100%;height:100%;object-fit:cover}
        .floating-club-badge::after{content:'';position:absolute;inset:-6px;border-radius:50%;border:2px solid rgba(37,99,235,.25);animation:pulse 2s infinite}
        @keyframes pulse{0%{transform:scale(.9);opacity:.8}70%{transform:scale(1.15);opacity:0}100%{opacity:0}}
        @media (max-width:768px){.floating-club-badge{top:88px;left:12px}}
    </style>
    <a href="{{ route('home') }}" class="floating-club-badge" title="Cambiar de club">
        <img src="{{ $logo }}" alt="Club">
    </a>
@endif

</html>
