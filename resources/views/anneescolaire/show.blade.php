@extends('layouts.app')

@section('template_title')
    {{ $anneescolaire->name ?? __('Show') . " " . __('Anneescolaire') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Anneescolaire</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('anneescolaires.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $anneescolaire->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Anneefr:</strong>
                                    {{ $anneescolaire->anneefr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Anneear:</strong>
                                    {{ $anneescolaire->anneear }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
