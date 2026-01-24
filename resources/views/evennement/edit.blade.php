@extends('layouts.appespace2')

@section('template_title')
    {{ __('Update') }} Evennement
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.modif') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('evennements.update', $evennement->public_id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('evennement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
