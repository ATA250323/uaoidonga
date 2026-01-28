@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Candidat
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <h1 class="mb-2 fw-bold text-success">
                            {{ __('traduction.inscriptioncandida') }} <i class="bi bi-person-add fs-3 me-2"></i>
                        </h1>
                        <p class="text-muted mb-4">
                            {{ __('traduction.renseignecandida') }}
                        </p>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('candidats.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('candidat.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
