<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $centre?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nomar" class="form-label">{{ __('Nomar') }}</label>
            <input type="text" name="nomar" class="form-control @error('nomar') is-invalid @enderror" value="{{ old('nomar', $centre?->nomar) }}" id="nomar" placeholder="Nomar">
            {!! $errors->first('nomar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nomfr" class="form-label">{{ __('Nomfr') }}</label>
            <input type="text" name="nomfr" class="form-control @error('nomfr') is-invalid @enderror" value="{{ old('nomfr', $centre?->nomfr) }}" id="nomfr" placeholder="Nomfr">
            {!! $errors->first('nomfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="prefixe" class="form-label">{{ __('Prefixe') }}</label>
            <input type="text" name="prefixe" class="form-control @error('prefixe') is-invalid @enderror" value="{{ old('prefixe', $centre?->prefixe) }}" id="prefixe" placeholder="Prefixe">
            {!! $errors->first('prefixe', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="adresse" class="form-label">{{ __('Adresse') }}</label>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse', $centre?->adresse) }}" id="adresse" placeholder="Adresse">
            {!! $errors->first('adresse', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $centre?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telephone" class="form-label">{{ __('Telephone') }}</label>
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $centre?->telephone) }}" id="telephone" placeholder="Telephone">
            {!! $errors->first('telephone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="anneescolaire_id" class="form-label">{{ __('Anneescolaire Id') }}</label>
            <input type="text" name="anneescolaire_id" class="form-control @error('anneescolaire_id') is-invalid @enderror" value="{{ old('anneescolaire_id', $centre?->anneescolaire_id) }}" id="anneescolaire_id" placeholder="Anneescolaire Id">
            {!! $errors->first('anneescolaire_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>