@extends('layouts.app')

@section('template_title')
    {{ $apropo->name ?? __('Show') . " " . __('Apropo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Apropo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('apropos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $apropo->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Aproposar:</strong>
                                    {{ $apropo->aproposar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Aproposfr:</strong>
                                    {{ $apropo->aproposfr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Missionar:</strong>
                                    {{ $apropo->missionar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Missionfr:</strong>
                                    {{ $apropo->missionfr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Objectifar:</strong>
                                    {{ $apropo->objectifar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Objectiffr:</strong>
                                    {{ $apropo->objectiffr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Visionar:</strong>
                                    {{ $apropo->visionar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Visionfr:</strong>
                                    {{ $apropo->visionfr }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
