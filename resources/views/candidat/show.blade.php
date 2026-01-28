@extends('layouts.app')

@section('template_title')
    {{ $candidat->name ?? __('Show') . " " . __('Candidat') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Candidat</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('candidats.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $candidat->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nom:</strong>
                                    {{ $candidat->nom }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Prenom:</strong>
                                    {{ $candidat->prenom }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Sexe:</strong>
                                    {{ $candidat->sexe }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Date Naissance:</strong>
                                    {{ $candidat->date_naissance }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Table:</strong>
                                    {{ $candidat->numero_table }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Centre Id:</strong>
                                    {{ $candidat->centre_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Etablissement Id:</strong>
                                    {{ $candidat->etablissement_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Anneescolaire Id:</strong>
                                    {{ $candidat->anneescolaire_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Categorie Examen Id:</strong>
                                    {{ $candidat->categorie_examen_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
