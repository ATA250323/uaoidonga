@extends('layouts.app')

@section('template_title')
    {{ $centre->name ?? __('Show') . " " . __('Centre') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Centre</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('centres.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $centre->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nomar:</strong>
                                    {{ $centre->nomar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nomfr:</strong>
                                    {{ $centre->nomfr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Prefixe:</strong>
                                    {{ $centre->prefixe }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Adresse:</strong>
                                    {{ $centre->adresse }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $centre->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telephone:</strong>
                                    {{ $centre->telephone }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Anneescolaire Id:</strong>
                                    {{ $centre->anneescolaire_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
