<div class="row">
       <div class="col-12 col-md-3 col-xl-3">
            <label for="nomar" class="form-label">{{ __('traduction.nomctar') }}</label>
            <input type="text" name="nomar" class="form-control @error('nomar') is-invalid @enderror" value="{{ old('nomar', $centre?->nomar) }}" id="nomar" placeholder="">
            {!! $errors->first('nomar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{--<div class="col-12 col-md-3 col-xl-3">
            <label for="nomfr" class="form-label">{{ __('traduction.nomctfr') }}</label>
            <input type="text" name="nomfr" class="form-control @error('nomfr') is-invalid @enderror" value="{{ old('nomfr', $centre?->nomfr) }}" id="nomfr" placeholder="nomfr">
            {!! $errors->first('nomfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
       <div class="col-12 col-md-3 col-xl-3">
            <label for="adresse" class="form-label">{{ __('traduction.ville') }}</label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse', $centre?->adresse) }}" id="adresse" placeholder="">
            {!! $errors->first('adresse', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{--<div class="col-12 col-md-3 col-xl-3">
            <label for="email" class="form-label">{{ __('traduction.email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $centre?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
       <div class="col-12 col-md-3 col-xl-3">
            <label for="telephone" class="form-label">{{ __('traduction.tel') }}</label>
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $centre?->telephone) }}" id="telephone" placeholder="Telephone">
            {!! $errors->first('telephone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
       <div class="col-12 col-md-3 col-xl-3">
            <label for="anneescolaire_id" class="form-label">{{ __('traduction.annee') }}</label>
            <select name="anneescolaire_id" class="form-select @error('anneescolaire_id') is-invalid @enderror" autocomplete="organisation">
                    @if ($centre?->anneescolaire_id)
                        <option value="{{ $centre->anneescolaire_id }}">
                            {{ $centre->anneescolaire->anneear.'-'.$centre->anneescolaire->anneefr }} {{-- Affiche le nom de l'enseignant --}}
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
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>
