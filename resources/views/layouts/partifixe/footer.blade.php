 <!-- Footer Start -->
 <!-- Newsletter Start -->
    {{-- <div class="container-fluid bg-primary newsletter p-0">
        <div class="container p-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-5 ps-lg-0 text-start wow fadeIn" data-wow-delay="0.2s">
                    @if ($carousel)
                        <img class="img-fluid" src="{{ asset('storage/' . $carousel->image) }}" alt="Image">
                    @else
                        <img class="img-fluid" src="{{ asset('assets/img/logo12.jpg') }}" alt="">
                    @endif
                </div>
                <div class="col-md-7 py-5 newsletter-text wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-5">
                        <h1 class="mb-5">{{ __('traduction.uaoidonga')}}</h1>
                        <div class="position-relative w-100 mb-2">
                            {{ __('traduction.uaoidonga2')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Newsletter End -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <a href="index.html" class="d-inline-block mb-3">
                        <h1 class="text-white">{{ __('traduction.uaoidonga')}}</h1>
                    </a>
                    <p class="mb-0">{{ __('traduction.uaoidonga2')}}</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <h5 class="text-white mb-4">{{ __('traduction.encontact')}}</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Donga</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+229 0196332360 / 97634621</p>
                    <p><i class="fa fa-envelope me-3"></i>uaoidonga@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://x.com/UaoiDonga"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.facebook.com/share/1Kcz18dipP/"><i
                                class="fab fa-facebook-f"></i></a>
                        {{-- <a class="btn btn-outline-primary btn-square border-2 me-2" href="#!"><i
                                class="fab fa-youtube"></i></a>--}}
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.instagram.com/invites/contact/?utm_source=ig_contact_invite&utm_medium=copy_link&utm_content=10od80xg"><i
                                class="fab fa-instagram"></i></a>
                        {{-- <a class="btn btn-outline-primary btn-square border-2 me-2" href="#!"><i
                                class="fab fa-linkedin-in"></i></a>--}}
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href="https://www.tiktok.com/@uaoi.donga?_r=1&_t=ZM-92xaDOw0uhE"><i
                                class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <p class="text-white mb-4">{{ __('traduction.lienpo')}}</p>
                        <a class="btn btn-link" href="{{ route('a_propos') }}">{{ __('traduction.propos')}}</a>
                        <a class="btn btn-link" href="{{ route('contacts') }}">{{ __('traduction.contacter')}} </a>
                        {{-- <a class="btn btn-link" href="#!">{{ __('traduction.Politique')}} </a>
                        <a class="btn btn-link" href="#!">{{ __('traduction.conditions')}}</a>
                        <a class="btn btn-link" href="#!">{{ __('traduction.carriere')}}</a> --}}
                </div>
                @if ($organisation)
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                        <p class="text-white mb-4">{{ __('traduction.no')}} {{ __('traduction.organisation')}}</p>
                        @foreach ($lienorganisations as $lienorganisation)
                            <a class="btn btn-link" href="{{ route('detail.domaine',$lienorganisation->public_id) }}">{{ $lienorganisation->titre }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>


        <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#!">{{ __('traduction.uaoidonga')}}</a>, {{ __('traduction.rights')}}
                    </div>
                    {{-- <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="#!">Home</a>
                            <a href="#!">Cookies</a>
                            <a href="#!">Help</a>
                            <a href="#!">FAQs</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
 <!-- Footer End -->
