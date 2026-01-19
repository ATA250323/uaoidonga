@extends('layouts.app')

@section('template_title')
    {{ $evennement->name ?? __('Show') . " " . __('Evennement') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Evennement</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('evennements.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $evennement->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Titrear:</strong>
                                    {{ $evennement->titrear }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Titrefr:</strong>
                                    {{ $evennement->titrefr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Image:</strong>
                                    {{ $evennement->image }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Annee:</strong>
                                    {{ $evennement->annee }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Organisation Id:</strong>
                                    {{ $evennement->organisation_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
