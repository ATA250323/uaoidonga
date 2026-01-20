@extends('layouts.appespace2')

@section('template_title')
    {{ __('Update') }} Etablissement
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.modif') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('etablissements.update', $etablissement->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('etablissement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
