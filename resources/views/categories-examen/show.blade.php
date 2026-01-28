@extends('layouts.app')

@section('template_title')
    {{ $categoriesExamen->name ?? __('Show') . " " . __('Categories Examen') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Categories Examen</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('categories-examens.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $categoriesExamen->public_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Code:</strong>
                                    {{ $categoriesExamen->code }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Libelle:</strong>
                                    {{ $categoriesExamen->libelle }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
