<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-pc-theme="light">
<head>
    <meta charset="utf-8">
    <title>UAOIDJOUGOU</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

      <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('assetsapp/images/logos.png" type="image/x-icon') }}" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Space+Grotesk&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</head>

<body>
    <!-- Spinner Start -->
    {{-- <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
    <!-- Spinner End -->

<div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom border-2 border-white justify-content-between">
                 <h1 class="animated ">{{ __('traduction.uaoidonga2')}}</h1>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                       <h1>{{ __('traduction.uaoidonga')}}</h1>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    @include('layouts.partifixe.alert')

    <main class="main">

        @yield('content')

    </main>

    {{-- footer --}}
   <div class="container-fluid bg-dark text-white-50 footer pt-5">
        <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#!">{{ __('traduction.uaoidonga')}}</a>, {{ __('traduction.rights')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Back to Top -->
    <a href="#!" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
