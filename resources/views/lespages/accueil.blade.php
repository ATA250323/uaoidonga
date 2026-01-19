@extends('layouts.appsite')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid pb-5 hero-header bg-light mb-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6">
                    <h1 class="animated ">{{ __('traduction.uaoidonga2')}}</h1>
                    <h5 class="d-inline-block border border-2 border-white py-3 px-5 mb-0 animated slideInRight">
                        {{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}} 1990</h5>
                </div>
                <div class="col-lg-6">
                    <div class="owl-carousel header-carousel animated fadeIn">
                        @if($hasCarousel)
                            @foreach ($carousels as $carousel)
                                    <img class="img-fluid" src="{{ asset('storage/' . $carousel->image) }}" alt="Image">
                            @endforeach
                        @else
                            <img class="img-fluid" src="{{ asset('assets/img/logo12.png') }}" alt="">
                            <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                            <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    @if ($information)
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            @if ($carousel)
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $carousel->image) }}" alt="Image">
                            @else
                                <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                            @endif
                            <div class="h-25 d-flex align-items-center text-center bg-primary px-4">
                                <h4 class="text-white lh-base mb-0">{{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}} 1990</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.h1')}}</span> {{ __('traduction.h2')}}</h1>
                    <p class="mb-4">{{ app()->getLocale() == 'ar' ? $information->histoirar : $information->histoirfr }}</p>
                    <div class="d-flex align-items-center mt-5">
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.facebook.com/share/1Kcz18dipP/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://x.com/UaoiDonga"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.instagram.com/invites/contact/?utm_source=ig_contact_invite&utm_medium=copy_link&utm_content=10od80xg"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @endif
    <!-- About End -->


    <!-- Feature Start -->
@if ($information)
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">{{ __('traduction.rejoinne')}}<span class="text-uppercase text-primary bg-light px-2"> {{ __('traduction.uaoidonga')}}</span>
                </h1>
            </div>
            <div class="row g-5 align-items-center text-center">
                {{ app()->getLocale() == 'ar' ? $information->raisonar : $information->raisonfr }}
            </div>
        </div>
    </div>
@endif
    <!-- Feature End -->


    <!-- Project Start -->
    @if ($evennement)
    <div class="container-fluid mt-5">
        <div class="container mt-5">
            <div class="row g-0">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column justify-content-center bg-primary h-100 p-5">
                        <h1 class="text-white mb-5">{{ __('traduction.dernier')}}<span
                                class="text-uppercase text-primary bg-light px-2">{{ __('traduction.organisation')}}</span></h1>
                        <h4 class="text-white mb-0"><span class="display-1">6</span> {{ __('traduction.nobredernier')}} {{ __('traduction.organisation')}} </h4>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-0">
                        @foreach ($evennements as $evennement)
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.2s">
                                <div class="project-item position-relative overflow-hidden">
                                    <img class="img-fluid  w-100" src="{{ asset('storage/' . $evennement->image) }}" alt="Image">
                                    <a class="project-overlay text-decoration-none" href="#!">
                                        <small class="text-white">{{ $evennement->titrear }}</small>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
     @endif
    <!-- Project End -->


    <!-- Service Start -->
    @if ($organisation)
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="mb-5">{{ __('traduction.no')}} {{ __('traduction.organisation')}}</h1>
                    <p>{{ app()->getLocale() == 'ar' ? $information->inforganisaar : $information->inforganisafr }}</p>
                    <div class="d-flex align-items-center bg-light">
                        <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                            <i class="fa fa-phone fa-2x text-white"></i>
                        </div>
                        <div class="px-3">
                            <h3>+229 0196332360 / 97634621</h3>
                            <span>{{ __('traduction.appelernous')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-0">
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-primary">
                                <a href="#!" class="service-img position-relative mb-4">
                                    <img class="img-fluid  w-100" src="{{ asset('storage/' . $organisation->image) }}" alt="Image">
                                    <h3>{{ $organisation->titre }}</h3>
                                </a>
                                <p class="mb-0">{{ $organisation->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @endif
    <!-- Service End -->

    <!-- Team Start -->
    @if ($dirigent)
        <div class="container-fluid bg-light py-5">
            <div class="container py-5">
                <h1 class="mb-5">{{ __('traduction.no_dirigents')}}<span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.professionnel')}}</span>
                </h1>
                <div class="row g-4">
                    @foreach ($dirigents as $dirigent)
                        <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                            <div class="team-item position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $carousel->image) }}" alt="Image">
                                {{-- <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt=""> --}}
                                <div class="team-overlay">
                                    <small class="mb-2">{{ $dirigent->profession }}</small>
                                    <h4 class="lh-base text-light">{{ $dirigent->nom }}</h4>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="{{ $dirigent->facebook }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="{{ $dirigent->tiweter }}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="{{ $dirigent->whatsapp }}">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        {{-- <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="{{ $dirigent->email }}">
                                            <i class="fa fa-envelope"></i>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Team End -->

    <!-- Testimonial Start -->
    @if ($temoin)
    <div class="container-xxl py-5">
        <div class="container py-5">
            <h3 class="text-center">{{ __('traduction.temoi')}}</h3>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9">
                    <div class="owl-carousel testimonial-carousel " data-wow-delay="0.2s">
                        @foreach ($temoins as $temoin)
                            <div class="testimonial-item">
                                <div class="row g-5 align-items-center">
                                    <div class="col-md-6">
                                        <div class="testimonial-img">
                                            @if ($temoin->image)
                                                <img class="img-fluid w-65" src="{{ asset('storage/' . $temoin->image) }}" alt="Image"  width="60" height="60">
                                            @else
                                                <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="testimonial-text pb-5 pb-md-0">
                                            <h3>{{ $temoin->nom_organe }}</h3>
                                            <p>
                                                {{ app()->getLocale() == 'ar' ? $temoin->messagear : $temoin->messagefr }}
                                            </p>
                                            <h5 class="mb-0">{{ $temoin->nom_prenom }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Testimonial End -->

@endsection
