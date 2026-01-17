@extends('layouts.appsite')

@section('content')
 <!-- Carousel Start -->

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <div class="carousel-inner">

            <div class="carousel-item active bg-success">
                <div class="carousel-caption d-none d-md-block" style="position: static !important; padding: 0;">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-lg-5 order-lg-2">
                                <img src="{{ asset('assets/img/hero-carousel/logos.jpg') }}" class="img-fluid w-100" alt="logo">
                            </div>
                            <div class="col-lg-7 text-center order-lg-1" dir="rtl" style="font-family: 'Amiri', serif;">
                                <h1 class="display-5 text-white mb-3">مرحباً بكم في <span>الوفاء</span></h1>
                                <p class="mb-5 fs-5">مؤسسة تعليمية ودعوية متميزة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item bg-success">
                <div class="carousel-caption d-none d-md-block" style="position: static !important; padding: 0;">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-lg-5 order-lg-2">
                                <img src="{{ asset('assets/img/hero-carousel/hero-carousel-1.jpg') }}" class="img-fluid w-100" alt="mosquee">
                            </div>
                            <div class="col-lg-7 text-center order-lg-1" dir="rtl" style="font-family: 'Amiri', serif;">
                                <h1 class="display-5 text-white mb-4">المسجد</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item bg-success">
                <div class="carousel-caption d-none d-md-block" style="position: static !important; padding: 0;">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-lg-5 order-lg-2">
                                <img src="{{ asset('assets/img/hero-carousel/hero-carousel-2.jpg') }}" class="img-fluid w-100" alt="universites">
                            </div>
                            <div class="col-lg-7 text-center order-lg-1" dir="rtl" style="font-family: 'Amiri', serif;">
                                <h1 class="display-5 text-white mb-4">الجامعات</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item bg-success">
                <div class="carousel-caption d-none d-md-block" style="position: static !important; padding: 0;">
                    <div class="container py-5">
                        <div class="row align-items-center">
                            <div class="col-lg-5 order-lg-2">
                                <img src="{{ asset('assets/img/hero-carousel/hero-carousel-3.jpg') }}" class="img-fluid w-100" alt="zakat">
                            </div>
                            <div class="col-lg-7 text-center order-lg-1" dir="rtl" style="font-family: 'Amiri', serif;">
                                <h1 class="display-5 text-white mb-4">الزكاة</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<!-- Carousel End -->
@if (isset($carousels) && $carousels->count() > 0)
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        @foreach ($carousels as $key => $carousel)
            <button type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}"
                    aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $key + 1 }}">
            </button>
        @endforeach
    </div>

    <div class="carousel-inner">

        {{-- Début de la boucle sur la collection $slides --}}
        @foreach ($carousels as $key => $carousel)

            <div class="carousel-item bg-success {{ $key == 0 ? 'active' : '' }}">
                <div class="carousel-caption d-none d-md-block" style="position: static !important; padding: 0;">
                    <div class="container py-5">
                        <div class="row align-items-center">

                            {{-- L'image (col-lg-5) est en order-lg-2 pour le RTL (visuellement à gauche) --}}
                            <div class="col-lg-5 order-lg-2">
                                {{-- Chemin de l'image dynamique : --}}
                                <img src="{{ asset('storage/' . $carousel->image) }}"
                                     class="img-fluid w-100"
                                     alt="{{ $carousel->title?? 'Image du carrousel' }}">
                            </div>

                            {{-- Le contenu textuel (col-lg-7) est en order-lg-1 pour le RTL (visuellement à droite) --}}
                            <div class="col-lg-7 text-center order-lg-1" dir="rtl" style="font-family: 'Amiri', serif;">
                                <h1 class="display-5 text-white mb-3">{{ $carousel->title }}</h1>
                                <p class="mb-5 fs-5">{{ $carousel->description ?? '' }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- Fin de la boucle --}}

    </div>

    </div>
@else
    <div class="container py-5">
        <div class="alert alert-info text-center" role="alert">
            {{-- Un message pour le cas où la base est vide --}}
            <h4 class="alert-heading">Bienvenue !</h4>
            <p>Le carrousel n'est pas encore configuré. Ajoutez des diapositives dans la base de données.</p>
            <hr>
            {{-- Ou afficher une image par défaut statique --}}
            <img src="{{ asset('assets/img/hero-carousel/logos.jpg') }}" alt="Default Hero Image" class="img-fluid">
        </div>
    </div>
@endif
    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Les projets de chaques année</h4>
                {{-- <h1 class="display-4 mb-4">We Provide Best Services</h1>
                <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur adipisci facilis
                    cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint
                    dolorem autem obcaecati, ipsam mollitia hic.
                </p> --}}
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2015/IMG-20151227-WA0132.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2015
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2016/IMG_20160610_190753.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2016
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2017/IMG_20161105_144107.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2017
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2018/IMG_20160608_112535.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2018
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2018/IMG_20160608_112535.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2019
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2020/مريم المسلماني .jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2020
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2021/خليل عبد المؤمن.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2021
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2022/1universite222.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2022
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2023/IMG-20230122-WA0099.jpg') }}"
                                class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                2023
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/2024/موزة.jpg') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="service-icon p-3">
                                2024
                            </div>
                        </div>
                        <div class="service-content p-2">
                            <div class="service-content-inner">
                                <center>
                                    <a class="btn btn-success rounded-pill py-2 px-4" href="#">Voir plus</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">

                    <div id="calendar"> </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        //title: 'Événement 1',
                        // start: '2024-08-01'
                    },
                    {
                        // title: 'Événement 2',
                        // start: '2024-08-07',
                        //  end: '2024-08-10'
                    }
                ]
            });

            calendar.render();
        });


    </script> --}}

    <!-- CSS de FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<!-- JS de FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<!-- Ton script d’initialisation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ar', // ou 'fr' selon la langue
        direction: document.documentElement.dir === 'rtl' ? 'rtl' : 'ltr'
    });
    calendar.render();
});
</script>

@endsection
