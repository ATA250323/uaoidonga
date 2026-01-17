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
                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid" src="img/about-1.jpg" alt="">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            <img class="img-fluid h-75" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                            <div class="h-25 d-flex align-items-center text-center bg-primary px-4">
                                <h4 class="text-white lh-base mb-0">{{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}} 1990</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.h1')}}</span> {{ __('traduction.h2')}}</h1>
                    <p class="mb-4">{{ __('traduction.h1')}}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5">{{ __('traduction.rejoinne')}}<span class="text-uppercase text-primary bg-light px-2"> {{ __('traduction.uaoidonga')}}</span>
                </h1>
            </div>
            <div class="row g-5 align-items-center text-center">
                Raison de choix
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Project Start -->
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
                        <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.2s">
                            <div class="project-item position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                                <a class="project-overlay text-decoration-none" href="#!">
                                    <h4 class="text-white">Kitchen</h4>
                                    <small class="text-white">72 Projects</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="mb-5">{{ __('traduction.no')}} {{ __('traduction.organisation')}}</h1>
                    <p>Info sur organisation</p>
                    <div class="d-flex align-items-center bg-light">
                        <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                            <i class="fa fa-phone fa-2x text-white"></i>
                        </div>
                        <div class="px-3">
                            <h3>+0123456789</h3>
                            <span>{{ __('traduction.appelernous')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-0">
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-primary">
                                <a href="#!" class="service-img position-relative mb-4">
                                    <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                                    <h3>Interior Design</h3>
                                </a>
                                <p class="mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam
                                    stet diam sed stet lorem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Team Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <h1 class="mb-5">{{ __('traduction.no_dirigents')}}<span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.professionnel')}}</span>
            </h1>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="team-item position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                        <div class="team-overlay">
                            <small class="mb-2">Architect</small>
                            <h4 class="lh-base text-light">Boris Johnson</h4>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="team-item position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                        <div class="team-overlay">
                            <small class="mb-2">Architect</small>
                            <h4 class="lh-base text-light">Donald Pakura</h4>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="team-item position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                        <div class="team-overlay">
                            <small class="mb-2">Architect</small>
                            <h4 class="lh-base text-light">Bradley Gordon</h4>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="team-item position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                        <div class="team-overlay">
                            <small class="mb-2">Architect</small>
                            <h4 class="lh-base text-light">Alexander Bell</h4>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="btn btn-outline-primary btn-sm-square border-2 me-2" href="#!">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <h3 class="text-center">{{ __('traduction.temoignage')}}</h3>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9">
                    <div class="owl-carousel testimonial-carousel " data-wow-delay="0.2s">
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Sustainable Material</h3>
                                        <p>Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed
                                            stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna
                                            dolore erat
                                            amet</p>
                                        <h5 class="mb-0">Boris Johnson</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Customer Satisfaction</h3>
                                        <p>Clita erat ipsum et lorem et sit, sed
                                            stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna
                                            dolore erat
                                            amet</p>
                                        <h5 class="mb-0">Alexander Bell</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <h3>Budget Friendly</h3>
                                        <p>Diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed
                                            stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna
                                            dolore erat
                                            amet</p>
                                        <h5 class="mb-0">Bradley Gordon</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Newsletter Start -->
    <div class="container-fluid bg-primary newsletter p-0">
        <div class="container p-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-5 ps-lg-0 text-start wow fadeIn" data-wow-delay="0.2s">
                    <img class="img-fluid w-100" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                </div>
                <div class="col-md-7 py-5 newsletter-text wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-5">
                        <h1 class="mb-5">{{ __('traduction.rejoinne')}}<span
                                class="text-uppercase text-primary bg-white px-2">{{ __('traduction.boite')}}</span></h1>
                        <div class="position-relative w-100 mb-2">
                            <input class="form-control border-0 w-100 ps-4 pe-5" type="text"
                                placeholder="Enter Your Email" style="height: 60px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-2 me-2"><i
                                    class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                        <p class="mb-0">Diam sed sed dolor stet amet eirmod</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->
@endsection
