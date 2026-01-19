<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $etablissement?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nomarabe" class="form-label">{{ __('Nomarabe') }}</label>
            <input type="text" name="nomarabe" class="form-control @error('nomarabe') is-invalid @enderror" value="{{ old('nomarabe', $etablissement?->nomarabe) }}" id="nomarabe" placeholder="Nomarabe">
            {!! $errors->first('nomarabe', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nomfrancais" class="form-label">{{ __('Nomfrancais') }}</label>
            <input type="text" name="nomfrancais" class="form-control @error('nomfrancais') is-invalid @enderror" value="{{ old('nomfrancais', $etablissement?->nomfrancais) }}" id="nomfrancais" placeholder="Nomfrancais">
            {!! $errors->first('nomfrancais', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="prefixe" class="form-label">{{ __('Prefixe') }}</label>
            <input type="text" name="prefixe" class="form-control @error('prefixe') is-invalid @enderror" value="{{ old('prefixe', $etablissement?->prefixe) }}" id="prefixe" placeholder="Prefixe">
            {!! $errors->first('prefixe', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="adresse" class="form-label">{{ __('Adresse') }}</label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse', $etablissement?->adresse) }}" id="adresse" placeholder="Adresse">
            {!! $errors->first('adresse', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $etablissement?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telephone" class="form-label">{{ __('Telephone') }}</label>
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $etablissement?->telephone) }}" id="telephone" placeholder="Telephone">
            {!! $errors->first('telephone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="annee" class="form-label">{{ __('Annee') }}</label>
            <input type="text" name="annee" class="form-control @error('annee') is-invalid @enderror" value="{{ old('annee', $etablissement?->annee) }}" id="annee" placeholder="Annee">
            {!! $errors->first('annee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="centre_id" class="form-label">{{ __('Centre Id') }}</label>
            <input type="text" name="centre_id" class="form-control @error('centre_id') is-invalid @enderror" value="{{ old('centre_id', $etablissement?->centre_id) }}" id="centre_id" placeholder="Centre Id">
            {!! $errors->first('centre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>