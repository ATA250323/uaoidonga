@extends('layouts.appsite')

@section('content')
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6">
                    @if ($carousel)
                        <div class="row">
                            <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                               @if ($carousels)
                                    <img class="img-fluid" src="{{ asset('storage/' . $carousels->image) }}" alt="Image">
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/img/logo12.png') }}" alt="">
                                @endif
                            </div>
                            <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                                <img class="img-fluid w-75" src="{{ asset('storage/' . $carousel->image) }}" alt="Image">
                                <div class="h-25 d-flex align-items-center text-center bg-primary px-4">
                                    <h4 class="text-white lh-base mb-0">{{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}}
                                    @if($apropos)
                                        {{ $apropos->annee }}
                                    @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid" src="{{ asset('assets/img/logo12.png') }}" alt="">
                            </div>
                            <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                                <img class="img-fluid w-75" src="{{ asset('assets/img/logo12.png') }}" alt="">
                                <div class="h-25 d-flex align-items-center text-center bg-primary px-4">
                                    <h4 class="text-white lh-base mb-0">{{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}}
                                    @if($apropos)
                                        {{ $apropos->annee }}
                                    @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                @if($apropos)
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.a_pro') }}</span></h1>
                    <p class="mb-4">{{ app()->getLocale() == 'ar' ? $apropos->aproposar : $apropos->aproposfr }}</p>
                    <div class="d-flex align-items-center mt-5">
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.facebook.com/share/1Kcz18dipP/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://x.com/UaoiDonga"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.instagram.com/invites/contact/?utm_source=ig_contact_invite&utm_medium=copy_link&utm_content=10od80xg"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- About End -->
<!-- Feature Start -->
    @if($apropos)
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center text-center">
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-bullseye fa-5x text-primary mb-4"></i>
                        <h4>{{ __('traduction.mission') }}</h4>
                        <p class="mb-0">{{ app()->getLocale() == 'ar' ? $apropos->missionar : $apropos->missionfr }}</p>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-flag fa-5x text-primary mb-4"></i>
                        <h4>{{ __('traduction.objectif') }}</h4>
                        <p class="mb-0">{{ app()->getLocale() == 'ar' ? $apropos->objectifar : $apropos->objectiffr }}</p>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-compass fa-5x text-primary mb-4"></i>
                        <h4>{{ __('traduction.vision') }}</h4>
                        <p class="mb-0">{{ app()->getLocale() == 'ar' ? $apropos->visionar : $apropos->visionfr }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Feature End -->

@endsection
