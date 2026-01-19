@extends('layouts.appespace2')

@section('template_title')
    {{ $infoligne->name ?? __('Show') . " " . __('Infoligne') }}
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Infoligne</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('infolignes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                {{-- <div class="form-group mb-2 mb20">
                                    <strong>Public Id:</strong>
                                    {{ $infoligne->public_id }}
                                </div> --}}
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.nom') }}:</strong>
                                    {{ $infoligne->nom }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.email') }}:</strong>
                                    {{ $infoligne->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.subjet') }}:</strong>
                                    {{ $infoligne->subjet }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.messages') }}:</strong>
                                    {{ $infoligne->message }}
                                </div>
                                {{-- <div class="form-group mb-2 mb20">
                                    <strong>Lire:</strong>
                                    {{ $infoligne->lire }}
                                </div> --}}

                    </div>
                </div>
            </div>
        </div>
@endsection
