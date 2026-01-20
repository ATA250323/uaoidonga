@extends('layouts.appespace2')

@section('template_title')
    {{ __('Update') }} Inscription
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Inscription</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('inscriptions.update', $inscription->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('inscription.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
