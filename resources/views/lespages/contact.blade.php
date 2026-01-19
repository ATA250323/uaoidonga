@extends('layouts.appsite')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.encontact') }}</span></h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <p class="text-center mb-4">
                        {{ app()->getLocale() == 'ar' ? $apropos->aproposar : $apropos->aproposfr }}
                    </p>
                    <p><i class="fa fa-phone-alt me-3"></i>+229 0196332360 / 97634621  <i class="fa fa-envelope me-3"></i>uaoidonga@gmail.com</p>
                    <div class="wow fadeIn" data-wow-delay="0.3s">
                        <form method="POST" action="{{ route('infolignes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" name="nom" class="form-control border-0 bg-light" id="name" placeholder="Your Name">
                                                <label for="name">{{ __('traduction.nom') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="email" name="email" class="form-control border-0 bg-light" id="mail" placeholder="Your Email">
                                                <label for="mail">{{ __('traduction.email') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-floating">
                                                <input type="text" name="subjet" class="form-control border-0 bg-light" id="subject" placeholder="Subject">
                                                <label for="subject">{{ __('traduction.sujet') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0 bg-light" name="message" placeholder="Leave a message here" id="message"
                                                    style="height: 130px"></textarea>
                                                <label for="message">{{ __('traduction.mess') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary w-100 py-3" type="submit">{{ __('traduction.envoi') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</button>
                                        </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
