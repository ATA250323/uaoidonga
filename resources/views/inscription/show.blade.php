@extends('layouts.app')

@section('template_title')
    {{ $inscription->name ?? __('Show') . " " . __('Inscription') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Inscription</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('inscriptions.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $inscription->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Matricule:</strong>
                                    {{ $inscription->matricule }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nom:</strong>
                                    {{ $inscription->nom }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Sexe:</strong>
                                    {{ $inscription->sexe }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Niveau:</strong>
                                    {{ $inscription->niveau }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Etablissement Id:</strong>
                                    {{ $inscription->etablissement_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Anneescolaire Id:</strong>
                                    {{ $inscription->anneescolaire_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
