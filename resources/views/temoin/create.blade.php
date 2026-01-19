@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Temoin
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.temoi') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('temoins.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('temoin.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
