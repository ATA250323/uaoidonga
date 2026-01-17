@extends('layouts.appsite')

@section('content')
  <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center wow fadeIn" data-wow-delay="0.1s">
                <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">{{ __('traduction.login')}}</span></h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="wow fadeIn" data-wow-delay="0.3s">
                        <form method="POST" action="{{ route('login') }}">
                             @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="name" placeholder="{{ __('traduction.email')}}">
                                        <label for="name">{{ __('traduction.email')}}</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('traduction.mdp')}}">
                                        <label for="password">{{ __('traduction.mdp')}}</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8 offset-md-4">
                                        <a href="{{ route('password.request') }}" class="text-danger-500">
                                            {{ __('traduction.modpassoublie') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">{{ __('traduction.seconect')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
