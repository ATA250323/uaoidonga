@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Categories Examen
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.ajoutexamen') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('categories-examens.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('categories-examen.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
