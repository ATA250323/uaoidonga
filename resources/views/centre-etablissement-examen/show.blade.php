@extends('layouts.app')

@section('template_title')
    {{ $centreEtablissementExamen->name ?? __('Show') . " " . __('Centre Etablissement Examen') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Centre Etablissement Examen</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('centre-etablissement-examens.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $centreEtablissementExamen->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Centre Id:</strong>
                                    {{ $centreEtablissementExamen->centre_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Etablissement Id:</strong>
                                    {{ $centreEtablissementExamen->etablissement_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Categorie Examen Id:</strong>
                                    {{ $centreEtablissementExamen->categorie_examen_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
