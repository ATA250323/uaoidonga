@extends('layouts.appespace2')

@section('template_title')
    {{ __('Update') }} Centre Etablissement Examen
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.modif') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('centre-etablissement-examens.update', $centreEtablissementExamen->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('centre-etablissement-examen.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
