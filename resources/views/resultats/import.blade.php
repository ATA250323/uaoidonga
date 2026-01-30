@extends('layouts.appespace2')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <form id="importForm" action="{{ route('resultats.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="annee" class="form-label">{{ __('traduction.annee') }}</label>
                            <select name="annee" class="form-select @error('annee') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($anneescolaires as $anneescolaire)
                                        <option value="{{ $anneescolaire->anneefr }}" {{ old('annee') == $anneescolaire->anneefr ? 'selected' : ''  }}>
                                            {{ $anneescolaire->anneear.' '.$anneescolaire->anneefr }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('annee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="centres" class="form-label">{{ __('traduction.centre') }}</label>
                            <select name="centres" class="form-select @error('centre_id') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($centres as $centre)
                                        <option value="{{ $centre->nomar }}"
                                            {{ old('centres')== $centre->nomar ? 'selected' : '' }}>
                                            {{ $centre->nomar.' '.$centre->nomfr }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('centre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="examens" class="form-label">{{ __('traduction.exam') }}</label>
                            <select name="examens" class="form-select @error('examens') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($examens as $examen)
                                        <option value="{{ $examen->libelle }}"
                                            {{ old('examens')== $examen->libelle ? 'selected' : '' }}>
                                            {{ $examen->libelle }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('examens', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        {{-- <div class="col-12 col-md-3 col-xl-3">
                            <label class="form-label mb-2 block">{{ __('traduction.exam') }}</label>
                                <div class="d-flex align-items-center gap-2">

                                    @foreach ($examens as $examen)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input @error('examens') is-invalid @enderror"
                                                type="radio"
                                                name="examens"
                                                id="examen_{{ $examen->libelle }}"
                                                value="{{ $examen->libelle }}"
                                                {{ old('examens') == $examen->libelle ? 'checked' : ''}}
                                            >

                                            <label class="form-check-label" for="examen_{{ $examen->libelle }}">
                                                {{ $examen->libelle }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                                {!! $errors->first('examens', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div> --}}
                        <div class="col-12 col-md-3 col-xl-3">
                            <label class="form-label mb-2 block">{{ __('traduction.sexe') }}</label>

                            <div class="d-flex align-items-center gap-2">

                                @foreach ($sexes as $sexe)
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error('sexe') is-invalid @enderror"
                                            type="radio"
                                            name="sexe"
                                            id="sexe_{{ $sexe['sexe'] }}"
                                            value="{{ $sexe['sexe'] }}"
                                            {{ old('sexe')== $sexe['sexe'] ? 'checked' : ''}}
                                        >

                                        <label class="form-check-label" for="sexe_{{ $sexe['sexe'] }}">
                                           {{ $sexe['sexe'] }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>

                            {!! $errors->first('sexe', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                    <div class="row">
                        <!-- Fichier -->
                        <div class="col-12 col-md-3 col-xl-3">
                            <label class="form-label">{{ __('traduction.fichier_excel') }}</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-4">
                        <a href="{{ route('resultats.index') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-fw fa-arrow-left"></i> {{ __('traduction.retr') }}
                        </a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-arrow-up"></i>{{ __('traduction.importer') }}</button>
                    </div>
            </form>

        </div>
    </div>

@endsection
