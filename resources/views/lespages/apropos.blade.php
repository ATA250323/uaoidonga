@extends('layouts.appsite')
<style>
    [dir="rtl"] .modern-ol li::before {
    right: auto;
    left: 12px;
    }
    .minimal-ol {
        list-style: decimal;
        padding-right: 20px;
    }

    .minimal-ol li {
        margin-bottom: 10px;
        padding-bottom: 6px;
    }

     [dir="rtl"] .modern-ul li::before {
    right: auto;
    left: 12px;
    }
    .minimal-ul {
        padding-right: 20px;
    }

    .minimal-ul li {
        margin-bottom: 10px;
        padding-bottom: 6px;
    }

</style>
@section('content')
    <!-- About Start -->
    <div class="container-fluid py-2">
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
                                    <h4 class="text-white lh-base mb-0">
                                      {{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}}
                                      <br>
                                           م 1975 - 1395 ه
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
                                    <h4 class="text-white lh-base mb-0">
                                        {{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}}
                                        <br>
                                           م 1975 - 1395 ه
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                {{-- @if($apropos) --}}
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.a_pro') }}</span></h1>
                    <h3 class="mb-2 text-center"><span class="text-uppercase text-primary bg-light px-2 ">{{ __('traduction.histoiretitle')}}</span></h3>
                    <p class="mb-2 text-center">{{ __('traduction.histoiretitle2')}}</p>
                    <p class="mb-2">
                        {{ __('traduction.histoire1')}}
                    </p>
                    <p class="mb-2">
                        {{ __('traduction.histoire2')}}
                    </p>
                    <br>
                    <div class="row">
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <p class="mb-2">
                                {{ __('traduction.titledirigent')}}
                            </p>
                            <ul  class="minimal-ol">
                                <li class="">{{ __('traduction.titledirigent1')}}</li>
                                <li class="">{{ __('traduction.titledirigent2')}}</li>
                                <li class="">{{ __('traduction.titledirigent3')}}</li>
                                <li class="">{{ __('traduction.titledirigent4')}}</li>
                            </ul>
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <p class="mb-2">
                                {{ __('traduction.comite')}}
                            </p>
                            <ul  class="minimal-ul">
                                <li class="">{{ __('traduction.comite1')}}</li>
                                <li class="">{{ __('traduction.comite2')}}</li>
                                <li class="">{{ __('traduction.comite3')}}</li>
                                <li class="">{{ __('traduction.comite4')}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-5">
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.facebook.com/share/1Kcz18dipP/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://x.com/UaoiDonga"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.instagram.com/invites/contact/?utm_source=ig_contact_invite&utm_medium=copy_link&utm_content=10od80xg"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
    <!-- About End -->
     <h4 class="text-center">{{ __('traduction.et') }}</h4>
        <p class="text-center">{{ __('traduction.et1')}}</p>
<!-- Feature Start -->
        <div class="container-fluid py-1">
            <div class="container py-5">
                <div class="row g-5 align-items-center ">
                    <div class="col-md-6 col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-bullseye fa-5x text-primary mb-4"></i>
                        <h4>{{ __('traduction.defis') }}</h4>
                        <ul  class="minimal-ol">
                            <li class="">{{ __('traduction.defis1')}}</li>
                            <li class="">{{ __('traduction.defis2')}}</li>
                            <li class="">{{ __('traduction.defis3')}}</li>
                            <li class="">{{ __('traduction.defis4')}}</li>
                            <li class="">{{ __('traduction.defis5')}}</li>
                            <li class="">{{ __('traduction.defis6')}}</li>
                            <li class="">{{ __('traduction.defis7')}}</li>
                            <li class="">{{ __('traduction.defis8')}}</li>
                        </ul>
                        <p class="mb-2">{{ __('traduction.histdefis1')}}</p>
                        <p class="mb-2">{{ __('traduction.histdefis2')}}</p>
                    </div>
                    {{-- <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-flag fa-5x text-primary mb-4"></i>
                        <h4>{{ __('traduction.objectif') }}</h4>
                        <p class="mb-0">{{ app()->getLocale() == 'ar' ? $apropos->objectifar : $apropos->objectiffr }}</p>
                    </div> --}}
                    <div class="col-md-6 col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-compass fa-5x text-primary mb-4"></i>
                        <h4>{{ __('traduction.besoin') }}</h4>

                       <p class="mb-2"><b> {{ __('traduction.besoin1')}}</b> {{ __('traduction.besoin2')}}</p>
                       <p class="mb-2"> </p>
                       <ul  class="minimal-ol">
                           {{-- <li class="">{{ __('traduction.besoin2')}}</li> --}}
                           <li class="">{{ __('traduction.besoin3')}}</li>
                           <li class="">{{ __('traduction.besoin4')}}</li>
                           <li class="">{{ __('traduction.besoin5')}}</li>
                           <li class="">{{ __('traduction.besoin6')}}</li>
                           <li class="">{{ __('traduction.besoin7')}}</li>
                        </ul>
                        {{-- <p class="mb-0">{{ app()->getLocale() == 'ar' ? $apropos->visionar : $apropos->visionfr }}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    <!-- Feature End -->

@endsection
