@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Inscription
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="card-title">{{ __('traduction.formulairinscrire') }}</h2>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('inscriptions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('inscription.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
