@extends('layouts.appespace')

@section('template_title')
    Profils
@endsection

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="grid grid-cols-12 gap-3 mb-3">
                    <div class="col-span-12 xl:col-span-6 md:col-span-6">
                        @if($profilsuersconets)
                            <h2 style="color: green">{{ __('traduction.profile') }}</h2>
                            <form action="{{ route('profils.destroy', $profilsuersconets->public_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;">
                                        <img src="{{ asset('storage/' . $profilsuersconets->image) }}" class=" rounded-full" width="75" height="75"><i class="fa fa-fw fa-trash"></i>
                                    </button>
                            </form>
                            <form method="POST" action="{{ route('profils.update', $profilsuersconets->public_id) }}" role="form" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    @include('profil.form')
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('traduction.enregistre') }}
                                    </button>
                            </form>
                        @else
                            <header>
                                <h2 style="color: green">
                                    {{ __('traduction.profile') }}
                                </h2>
                            </header>
                                <img src="{{ asset('assets/images/application/avatar-2.jpg') }}" class="w-10 rounded-full"  width="55" height="55">
                                    <form method="POST" action="{{ route('profils.store') }}"  role="form" enctype="multipart/form-data">
                                        @csrf
                                        @include('profil.form')
                                            <div class="row">
                                                <div class="grid grid-cols-12 gap-3 mb-3">
                                                    <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                                        <div class="col-md-12 mt20 mt-2">
                                                            <button type="submit" class="btn btn-primary"> {{ __('traduction.enregistre') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                        @endif
                    </div>
                    {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
                        <form action="{{ route('update.prpfil', $comptesuers->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="grid grid-cols-12 gap-3 mb-3">
                                    <div class="col-span-12 xl:col-span-6 md:col-span-6">
                                        <label class="form-label">{{ __('traduction.nom') }}</label>
                                            <input type="text" class="form-control" name="name" value="{{ $comptesuers->name ?? '' }}" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">{{ __('traduction.enregistre') }}</button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
