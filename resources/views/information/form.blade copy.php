<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $information?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="histoirar" class="form-label">{{ __('Histoirar') }}</label>
            <input type="text" name="histoirar" class="form-control @error('histoirar') is-invalid @enderror" value="{{ old('histoirar', $information?->histoirar) }}" id="histoirar" placeholder="Histoirar">
            {!! $errors->first('histoirar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="histoirfr" class="form-label">{{ __('Histoirfr') }}</label>
            <input type="text" name="histoirfr" class="form-control @error('histoirfr') is-invalid @enderror" value="{{ old('histoirfr', $information?->histoirfr) }}" id="histoirfr" placeholder="Histoirfr">
            {!! $errors->first('histoirfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="raisonar" class="form-label">{{ __('Raisonar') }}</label>
            <input type="text" name="raisonar" class="form-control @error('raisonar') is-invalid @enderror" value="{{ old('raisonar', $information?->raisonar) }}" id="raisonar" placeholder="Raisonar">
            {!! $errors->first('raisonar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="raisonfr" class="form-label">{{ __('Raisonfr') }}</label>
            <input type="text" name="raisonfr" class="form-control @error('raisonfr') is-invalid @enderror" value="{{ old('raisonfr', $information?->raisonfr) }}" id="raisonfr" placeholder="Raisonfr">
            {!! $errors->first('raisonfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="inforganisaar" class="form-label">{{ __('Inforganisaar') }}</label>
            <input type="text" name="inforganisaar" class="form-control @error('inforganisaar') is-invalid @enderror" value="{{ old('inforganisaar', $information?->inforganisaar) }}" id="inforganisaar" placeholder="Inforganisaar">
            {!! $errors->first('inforganisaar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="inforganisafr" class="form-label">{{ __('Inforganisafr') }}</label>
            <input type="text" name="inforganisafr" class="form-control @error('inforganisafr') is-invalid @enderror" value="{{ old('inforganisafr', $information?->inforganisafr) }}" id="inforganisafr" placeholder="Inforganisafr">
            {!! $errors->first('inforganisafr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>