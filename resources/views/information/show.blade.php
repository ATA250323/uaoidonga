@extends('layouts.app')

@section('template_title')
    {{ $information->name ?? __('Show') . " " . __('Information') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Information</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('information.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $information->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Histoirar:</strong>
                                    {{ $information->histoirar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Histoirfr:</strong>
                                    {{ $information->histoirfr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Raisonar:</strong>
                                    {{ $information->raisonar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Raisonfr:</strong>
                                    {{ $information->raisonfr }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Inforganisaar:</strong>
                                    {{ $information->inforganisaar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Inforganisafr:</strong>
                                    {{ $information->inforganisafr }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
