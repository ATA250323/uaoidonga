@extends('layouts.appespace')

@section('template_title')
    {{ __('Update') }} Profil
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Profil</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('profils.update', $profil->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('profil.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
