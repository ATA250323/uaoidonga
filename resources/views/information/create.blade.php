@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Information
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Information</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('information.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('information.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
