<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- <div class="form-group mb-2 mb20">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $evennement?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="form-group mb-2 mb20">
            <label for="titrear" class="form-label">{{ __('traduction.titre') }}</label>
            <input type="text" name="titrear" class="form-control @error('titrear') is-invalid @enderror" value="{{ old('titrear', $evennement?->titrear) }}" id="titrear" placeholder="{{ __('traduction.titre') }}">
            {!! $errors->first('titrear', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="organisation_id" class="form-label">{{ __('traduction.organisation') }}</label>
           <select name="organisation_id" class="form-select @error('organisation_id') is-invalid @enderror" autocomplete="organisation">
                    <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                @foreach ($organisations as $organisation)
                    <option value="{{ $organisation->id }}">{{ ucfirst($organisation->titre) }}</option>
                @endforeach
            </select>
            {{-- <input type="text" name="organisation_id" class="form-control @error('organisation_id') is-invalid @enderror" value="{{ old('organisation_id', $evennement?->organisation_id) }}" id="organisation_id" placeholder="Organisation Id"> --}}
            {!! $errors->first('organisation_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="annee" class="form-label">{{ __('traduction.annee') }}</label>
            {{-- <input type="text" name="annee" class="form-control @error('annee') is-invalid @enderror" value="{{ old('annee', $evennement?->annee) }}" id="annee" placeholder="{{ __('traduction.annee') }}"> --}}
            <select name="anneescolaire_id" class="form-select @error('anneescolaire_id') is-invalid @enderror" autocomplete="organisation">
                <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                @foreach ($anneescolaires as $anneescolaire)
                    <option value="{{ $anneescolaire->id }}">{{$anneescolaire->anneear.' / '.$anneescolaire->anneefr }}</option>
                @endforeach
            </select>
            {!! $errors->first('annee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="form-group mb-2 mb20">
            <label for="titrefr" class="form-label">{{ __('Titrefr') }}</label>
            <input type="text" name="titrefr" class="form-control @error('titrefr') is-invalid @enderror" value="{{ old('titrefr', $evennement?->titrefr) }}" id="titrefr" placeholder="Titrefr">
            {!! $errors->first('titrefr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="form-group mb-2 mb20">
            <label for="image" class="form-label">{{ __('traduction.photo') }}</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $evennement?->image) }}" id="image" placeholder="">
            {!! $errors->first('image', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>
