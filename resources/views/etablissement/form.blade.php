<div class="row">
    <div class="grid grid-cols-12 gap-3 mb-3">
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="nomarabe" class="form-label">{{ __('traduction.nomarabe') }}</label>
            <input type="text" name="nomarabe" class="form-control @error('nomarabe') is-invalid @enderror" value="{{ old('nomarabe', $etablissement?->nomarabe) }}" id="nomarabe" placeholder="">
            {!! $errors->first('nomarabe', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="nomfrancais" class="form-label">{{ __('traduction.nomfrancais') }}</label>
            <input type="text" name="nomfrancais" class="form-control @error('nomfrancais') is-invalid @enderror" value="{{ old('nomfrancais', $etablissement?->nomfrancais) }}" id="nomfrancais" placeholder="">
            {!! $errors->first('nomfrancais', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="adresse" class="form-label">{{ __('traduction.adresse') }}</label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse', $etablissement?->adresse) }}" id="adresse" placeholder="adresse">
            {!! $errors->first('adresse', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="email" class="form-label">{{ __('traduction.email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $etablissement?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="telephone" class="form-label">{{ __('traduction.tel') }}</label>
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $etablissement?->telephone) }}" id="telephone" placeholder="Telephone">
            {!! $errors->first('telephone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="centre_id" class="form-label">{{ __('traduction.centre') }}</label>
            <select name="centre_id" class="form-select @error('centre_id') is-invalid @enderror" autocomplete="organisation">
                    @if ($etablissement?->centre_id)
                        <option value="{{ $etablissement->centre_id }}">
                            {{ $etablissement->centre->nomar.'-'.$etablissement->centre->nomfr }} {{-- Affiche le nom de l'enseignant --}}
                        </option>
                    @else
                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                    @endif
                    @foreach ($centres as $centre)
                        <option value="{{ $centre->id }}">{{$centre->nomar.' '.$centre->nomfr }}</option>
                    @endforeach
            </select>
            {!! $errors->first('annee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="anneescolaire_id" class="form-label">{{ __('traduction.annee') }}</label>
            <select name="anneescolaire_id" class="form-select @error('annee') is-invalid @enderror" autocomplete="">
                    @if ($etablissement?->anneescolaire_id)
                        <option value="{{ $etablissement->anneescolaire_id }}">
                            {{ $etablissement->anneescolaire->anneear.'-'.$etablissement->anneescolaire->anneefr }} {{-- Affiche le nom de l'enseignant --}}
                        </option>
                    @else
                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                    @endif
                    @foreach ($anneescolaires as $anneescolaire)
                        <option value="{{ $anneescolaire->id }}">{{$anneescolaire->anneear.' / '.$anneescolaire->anneefr }}</option>
                    @endforeach
            </select>
            {!! $errors->first('annee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>