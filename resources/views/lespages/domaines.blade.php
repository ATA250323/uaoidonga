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
     <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-5 align-items-center">
                        @if ($organisation_id)
                            <h4 class="mb-2 text-center">{{ $organisation_id->titre }}</h4>
                            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid  w-100" src="{{ asset('storage/' . $organisation_id->image) }}" alt="Image" width="" height="">
                            </div>
                            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.1s">
                                @if ($organisation->titre === 'لجنة التربية والثقافــــــة')
                                    <h2 class="mb-2 text-center">أولا: في مجال التربية والتعليم:</h2>
                                @elseif ($organisation->titre === 'لجنة الدعوة والبحوث')
                                    <h2 class="mb-2 text-center">ثانيا: في مجال الدعوة إلى الله يهتم الاتحاد بالآتي:</h2>
                                @elseif ($organisation->titre === 'لجنة الشـــــــــؤون الاجتماعية')
                                    <h2 class="mb-2 text-center">ثالثا: في مجال الشؤون الاجتماعية :</h2>
                                @elseif ($organisation->titre === 'لجنـــة الاقتصاد والمشاريع')
                                    <h2 class="mb-2 text-center">رابعا: في مجال المشاريع وتنمية الموارد:</h2>
                                @endif
                                <ol class="modern-ol text-end" dir="rtl">
                                    @foreach($liste as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="mb-5">{{ __('traduction.organise')}}</h1>
                    {{-- @if ($information) --}}
                        <p>
                            {{ Str::limit(__('traduction.organise1'), 255) }}
                            <a href="{{ route('a_propos') }}">{{ __('traduction.ensoir')}}</a>
                        </p>
                    {{-- @endif --}}
                    <div class="d-flex align-items-center bg-light">
                        <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                            <i class="fa fa-phone fa-2x text-white"></i>
                        </div>
                        <div class="px-3">
                            <h4>+229 0196332360 / 97634621</h4>
                            <span>{{ __('traduction.appelernous')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-0">
                    @if ($organisation)
                        @foreach ($organisations as $organisation)
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="service-item h-100 d-flex flex-column justify-content-center bg-primary">
                                <a href="{{ route('detail.domaine',$organisation->public_id) }}" class="service-img position-relative mb-4">
                                    <img class="img-fluid  w-100" src="{{ asset('storage/' . $organisation->image) }}" alt="Image">
                                    <h3>{{ $organisation->titre }}</h3>
                                </a>
                                <p class="mb-0">
                                    {{ Str::limit($organisation->description, 100) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

@endsection
