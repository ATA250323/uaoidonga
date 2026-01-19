@extends('layouts.app')

@section('template_title')
    {{ $etablissement->name ?? __('Show') . " " . __('Etablissement') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Etablissement</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('etablissements.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $etablissement->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nomarabe:</strong>
                                    {{ $etablissement->nomarabe }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nomfrancais:</strong>
                                    {{ $etablissement->nomfrancais }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Prefixe:</strong>
                                    {{ $etablissement->prefixe }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Adresse:</strong>
                                    {{ $etablissement->adresse }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $etablissement->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telephone:</strong>
                                    {{ $etablissement->telephone }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Annee:</strong>
                                    {{ $etablissement->annee }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Centre Id:</strong>
                                    {{ $etablissement->centre_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
