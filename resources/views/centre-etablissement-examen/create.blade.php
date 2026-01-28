@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Centre Etablissement Examen
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.ajout') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('centre-etablissement-examens.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('centre-etablissement-examen.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
