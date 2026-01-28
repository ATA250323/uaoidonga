<div class="row">
        {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $centreEtablissementExamen?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>--}}
        {{-- <div class="col-12 col-md-3 col-xl-3">
            <label for="centre_id" class="form-label">{{ __('Centre Id') }}</label>
            <input type="text" name="centre_id" class="form-control @error('centre_id') is-invalid @enderror" value="{{ old('centre_id', $centreEtablissementExamen?->centre_id) }}" id="centre_id" placeholder="Centre Id">
            {!! $errors->first('centre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-12 col-md-3 col-xl-3">
            <label for="centre_id" class="form-label">{{ __('traduction.centre') }}</label>
            <select name="centre_id" class="form-select @error('centre_id') is-invalid @enderror" autocomplete="organisation">
                     @foreach ($centres as $centre)
                        <option value="{{ $centre->id }}"
                            {{ old('centre_id', $centreEtablissementExamen?->centre_id) == $centre->id ? 'selected' : '' }}>
                            {{ $centre->nomar.' '.$centre->nomfr }}
                        </option>
                    @endforeach
            </select>
            {!! $errors->first('centre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-12 col-md-3 col-xl-3">
            <label for="etablissement_id" class="form-label">{{ __('traduction.etabli') }}</label>
            <select name="etablissement_id" class="form-select @error('etablissement_id') is-invalid @enderror" autocomplete="organisation">
                    @foreach ($etablissements as $etablissement)
                        <option value="{{ $etablissement->id }}"
                            {{ old('etablissement_id', $centreEtablissementExamen?->etablissement_id) == $etablissement->id ? 'selected' : '' }}>
                            {{ $etablissement->nomarabe.' '.$etablissement->nomfrancais }}
                        </option>
                    @endforeach
            </select>
            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-12 col-md-3 col-xl-3">
            <label for="anneescolaire_id" class="form-label">{{ __('traduction.etabli') }}</label>
            <select name="anneescolaire_id" class="form-select @error('anneescolaire_id') is-invalid @enderror" autocomplete="organisation">
                    @foreach ($anneescolaires as $anneescolaire)
                        <option value="{{ $anneescolaire->id }}"
                            {{ old('anneescolaire_id', $centreEtablissementExamen?->anneescolaire_id) == $anneescolaire->id ? 'selected' : '' }}>
                            {{ $anneescolaire->anneear.' '.$anneescolaire->anneefr }}
                        </option>
                    @endforeach
            </select>
            {!! $errors->first('anneescolaire_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-12 col-md-3 col-xl-3">
                        <label class="form-label mb-2 block">{{ __('traduction.exam') }}</label>

                            <div class="d-flex align-items-center gap-2">

                                @foreach ($examens as $examen)
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error('categorie_examen_id') is-invalid @enderror"
                                            type="radio"
                                            name="categorie_examen_id"
                                            id="examen_{{ $examen->id }}"
                                            value="{{ $examen->id }}"
                                            {{ old('categorie_examen_id', $centreEtablissementExamen?->categorie_examen_id) == $examen->id ? 'checked' : '' }}
                                        >

                                        <label class="form-check-label" for="examen_{{ $examen->id }}">
                                             {{ $examen->libelle }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
            {!! $errors->first('categorie_examen_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
   <div class="d-flex align-items-center gap-2 mt-4">
        <a href="{{ route('centre-etablissement-examens.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-fw fa-arrow-left"></i> {{ __('traduction.retr') }}
        </a>
        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i>{{ __('traduction.enregistre') }}</button>
    </div>
</div>
