<div class="row">
    <div class="grid grid-cols-12 gap-3 mb-3">
        {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $inscription?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-span-12 xl:col-span-12 md:col-span-12">
            <h3 for="anneescolaire_id" class="form-label">{{ __('traduction.ansclair') }}</h3>
                    @if ($inscription?->anneescolaire_id)
                    <input type="hidden" name="anneescolaire_id" class="form-control @error('anneescolaire_id') is-invalid @enderror" value="{{ old('anneescolaire_id', $etablissement->anneescolaire_id) }}" id="anneescolaire_id" placeholder="">
                        <p class="text-success" style="font-size: 18px">
                            {{ app()->getLocale() == 'ar' ? $etablissement->anneescolaire->anneear : $etablissement->anneescolaire->anneefr }}
                        </p>
                    @else
                    <input type="hidden" name="anneescolaire_id" class="form-control @error('anneescolaire_id') is-invalid @enderror" value="{{ old('anneescolaire_id', $anneexiste->id) }}" id="anneescolaire_id" placeholder="">
                       <p class="text-success" style="font-size: 18px">
                           {{ app()->getLocale() == 'ar' ? $anneexiste->anneear : $anneexiste->anneefr }}
                        </p>
                    @endif
            {!! $errors->first('anneescolaire_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-4 md:col-span-4">
           <h3 for="matricule" class="form-label">{{ __('traduction.matri') }}</h3>
            <input type="text" name="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule', $inscription?->matricule) }}" id="matricule" placeholder="Matricule">
            {!! $errors->first('matricule', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-8 md:col-span-8">
            <h3 for="nom" class="form-label">{{ __('traduction.nom') }} & {{ __('traduction.prenom') }}</h3>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $inscription?->nom) }}" id="nom" placeholder="Nom">
            {!! $errors->first('nom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
         <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <h3 for="sexe" class="form-label">{{ __('traduction.sexe') }}</h3>
            <select name="sexe" class="form-select @error('annee') is-invalid @enderror" autocomplete="">
                    @if ($inscription?->sexe)
                        <option value="{{ $inscription->sexe }}">
                            {{ $inscription->sexe }}
                        </option>
                    @else
                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                    @endif
                        <option value="m">{{ __('traduction.sexe1') }}</option>
                        <option value="f">{{ __('traduction.sexe2') }}</option>
            </select>
            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
         <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <h3 for="niveau" class="form-label">{{ __('traduction.nivo') }}</h3>
            <select name="niveau" class="form-select @error('annee') is-invalid @enderror" autocomplete="">
                    @if ($inscription?->niveau)
                        <option value="{{ $inscription->niveau }}">
                            {{ $inscription->niveau }}
                        </option>
                    @else
                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                    @endif
                        <option value="n1">{{ __('traduction.niveau1') }}</option>
                        <option value="n2">{{ __('traduction.niveau2') }}</option>
            </select>
            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="etablissement_id" class="form-label">{{ __('Etablissement Id') }}</label>
            <input type="text" name="etablissement_id" class="form-control @error('etablissement_id') is-invalid @enderror" value="{{ old('etablissement_id', $inscription?->etablissement_id) }}" id="etablissement_id" placeholder="Etablissement Id">
            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <h3 for="etablissement_id" class="form-label">{{ __('traduction.etabli') }}</h3>
            <select name="etablissement_id" class="form-select @error('annee') is-invalid @enderror" autocomplete="">
                    @if ($inscription?->etablissement_id)
                        <option value="{{ $inscription->etablissement_id }}">
                            {{ app()->getLocale() == 'ar' ? $inscription->etablissement->nomarabe : $inscription->etablissement->nomfrancais }}
                        </option>
                    @else
                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                    @endif
                    @foreach ($etablissements as $etablissement)
                        <option value="{{ $etablissement->id }}">
                            {{ app()->getLocale() == 'ar' ? $etablissement->nomarabe : $etablissement->nomfrancais }}
                        </option>
                    @endforeach
            </select>
            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="anneescolaire_id" class="form-label">{{ __('Anneescolaire Id') }}</label>
            <input type="text" name="anneescolaire_id" class="form-control @error('anneescolaire_id') is-invalid @enderror" value="{{ old('anneescolaire_id', $inscription?->anneescolaire_id) }}" id="anneescolaire_id" placeholder="Anneescolaire Id">
            {!! $errors->first('anneescolaire_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <h3 for="image" class="form-label">{{ __('traduction.photo') }}</h3>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $inscription?->image) }}" id="image" placeholder="Image">
            {!! $errors->first('image', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>
