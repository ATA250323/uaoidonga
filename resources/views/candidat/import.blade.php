@extends('layouts.appespace2')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
<h1>{{ __('traduction.importcandidat') }}</h1>
<br>
            <form id="importForm" action="{{ route('importcandidat') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="annee" class="form-label">{{ __('traduction.annee') }}</label>
                            <select name="anneescolaire_id" class="form-select @error('annee') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($anneescolaires as $anneescolaire)
                                        <option value="{{ $anneescolaire->id }}" {{ old('anneescolaire_id') == $anneescolaire->id ? 'selected' : ''  }}>
                                            {{ $anneescolaire->anneear.' '.$anneescolaire->anneefr }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('annee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="etablissements" class="form-label">{{ __('traduction.etablis') }}</label>
                            <select name="etablissement_id" class="form-select @error('etablissement_id') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($etablissements as $etablissement)
                                        <option value="{{ $etablissement->id }}"
                                            {{ old('etablissement_id')== $etablissement->id ? 'selected' : '' }}>
                                            {{ $etablissement->nomarabe }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="categorie_examen" class="form-label">{{ __('traduction.exam') }}</label>
                            <select name="categorie_examen_id" class="form-select @error('categorie_examen') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($categorie_examens as $categorie_examen)
                                        <option value="{{ $categorie_examen->id }}"
                                            {{ old('categorie_examen_id')== $categorie_examen->id ? 'selected' : '' }}>
                                            {{ $categorie_examen->libelle }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('categorie_examen', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
                        <a href="{{ route('candidats.index') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-fw fa-arrow-left"></i> {{ __('traduction.retr') }}
                        </a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-arrow-up"></i>{{ __('traduction.importercandidat') }}</button>
                    </div>
            </form>

        </div>
    </div>

@endsection
