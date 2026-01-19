@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Dirigent
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.formulair') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('dirigents.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('dirigent.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
