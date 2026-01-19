@extends('layouts.appespace2')

@section('template_title')
    {{ $temoin->name ?? __('Show') . " " . __('Temoin') }}
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('traduction.temoi') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('temoins.index') }}"> {{ __('traduction.retr') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <th ></th>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.photo') }}:</strong>
                                   <img class="img-fluid w-100" src="{{ asset('storage/' . $temoin->image) }}" class="rounded-full" width="60" height="60">
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.messages') }}:</strong>
                                    {{ app()->getLocale() == 'ar' ? $temoin->messagear : $temoin->messagefr }}
                                </div>
                                {{-- <div class="form-group mb-2 mb20">
                                    <strong>Messagefr:</strong>
                                    {{ $temoin->messagefr }}
                                </div> --}}
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.nom') }}:</strong>
                                    {{ $temoin->nom_prenom }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('traduction.organisation') }}:</strong>
                                    {{ $temoin->nom_organe }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
