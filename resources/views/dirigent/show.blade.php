@extends('layouts.app')

@section('template_title')
    {{ $dirigent->name ?? __('Show') . " " . __('Dirigent') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Dirigent</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('dirigents.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $dirigent->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nom:</strong>
                                    {{ $dirigent->nom }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Profession:</strong>
                                    {{ $dirigent->profession }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Facebook:</strong>
                                    {{ $dirigent->facebook }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Whatsapp:</strong>
                                    {{ $dirigent->whatsapp }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tiweter:</strong>
                                    {{ $dirigent->tiweter }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $dirigent->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Image:</strong>
                                    {{ $dirigent->image }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
