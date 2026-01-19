<div class="row">
    <div class="grid grid-cols-12 gap-3 mb-3">
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="histoirar" class="form-label">{{ __('traduction.histoirar') }}</label>
            <textarea name="histoirar"
                id="histoirar" cols="30"  rows="5" class="form-control @error('histoirar') is-invalid @enderror"
                placeholder="histoirar">{{ old('histoirar', $information?->histoirar) }}
            </textarea>
            {!! $errors->first('histoirar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="histoirfr" class="form-label">{{ __('traduction.histoirfr') }}</label>
            <textarea name="histoirfr"
                id="histoirfr" cols="30"  rows="5" class="form-control @error('histoirfr') is-invalid @enderror"
                placeholder="histoirfr">{{ old('histoirfr', $information?->histoirfr) }}
            </textarea>
            {!! $errors->first('histoirfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="raisonar" class="form-label">{{ __('traduction.raisonar') }}</label>
            <textarea name="raisonar"
                id="raisonar" cols="30"  rows="5" class="form-control @error('raisonar') is-invalid @enderror"
                placeholder="raisonar">{{ old('raisonar', $information?->raisonar) }}
            </textarea>
            {!! $errors->first('raisonar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="raisonfr" class="form-label">{{ __('traduction.raisonfr') }}</label>
            <textarea name="raisonfr"
                id="raisonfr" cols="30"  rows="5" class="form-control @error('raisonfr') is-invalid @enderror"
                placeholder="raisonfr">{{ old('raisonfr', $information?->raisonfr) }}
            </textarea>
            {!! $errors->first('raisonfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="inforganisaar" class="form-label">{{ __('traduction.inforganisaar') }}</label>
            <textarea name="inforganisaar"
                id="inforganisaar" cols="30"  rows="5" class="form-control @error('inforganisaar') is-invalid @enderror"
                placeholder="inforganisaar">{{ old('inforganisaar', $information?->inforganisaar) }}
            </textarea>
            {!! $errors->first('inforganisaar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="inforganisafr" class="form-label">{{ __('traduction.inforganisafr') }}</label>
            <textarea name="inforganisafr"
                id="inforganisafr" cols="30"  rows="5" class="form-control @error('inforganisafr') is-invalid @enderror"
                placeholder="inforganisafr">{{ old('inforganisafr', $information?->inforganisafr) }}
            </textarea>
            {!! $errors->first('inforganisafr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>
