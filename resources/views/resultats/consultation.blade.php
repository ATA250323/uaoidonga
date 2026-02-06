@extends('layouts.app_consultation')
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

</style>
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid pb-1 hero-header bg-light mb-1">
        <div class="container py-2">
            <div class="row g-5 align-items-center mb-1">
                <div class="col-lg-6">
                    <h5 class="d-inline-block border border-2 border-white py-3 px-5 mb-0 animated slideInRight">
                        {{ __('traduction.uaoidonga')}} {{ __('traduction.depuis')}}
                        <br>
                       م 1975 - 1395 ه
                    </h5>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ asset('assets/img/logo12.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center wow fadeIn" data-wow-delay="0.1s">
            <h1 class="mb-5">{{ __('traduction.Veuillez_consulter')}}</h1>
        </div>
    </div>
</div>
    <!-- Service Start -->

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row  align-items-center">
                <div class="col-lg-4">
                    <div class="service-item h-100 d-flex flex-column bg-primary ">
                        <a href="{{ route('resultats.moutawasith') }}" class="service-img position-relative mb-4 ">
                            {{-- <img class="img-fluid  w-100" src="{{ asset('assets/img/logo12.png') }}" alt="Image"> --}}
                            <h3>{{ __('traduction.titleresultat')}} {{ __('traduction.examen1')}} 2025-2026</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item h-100 d-flex flex-column justify-content-center bg-primary">
                        <a href="{{ route('resultats.sanawi') }}" class="service-img position-relative mb-4">
                            {{-- <img class="img-fluid  w-100" src="{{ asset('assets/img/logo12.png') }}" alt="Image"> --}}
                            <h3>{{ __('traduction.titleresultat')}} {{ __('traduction.examen2')}} 2025-2026</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
