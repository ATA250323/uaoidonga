<div class="row">
    <div class="grid grid-cols-12 gap-3 mb-3">
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="aproposar" class="form-label">{{ __('traduction.aproposar') }}</label>
            <textarea name="aproposar"
                id="aproposar" cols="30"  rows="5" class="form-control @error('aproposar') is-invalid @enderror"
                placeholder="aproposar">{{ old('aproposar', $apropo?->aproposar) }}
            </textarea>
            {{-- <input type="text" name="aproposar" class="form-control @error('aproposar') is-invalid @enderror" value="{{ old('aproposar', $apropo?->aproposar) }}" id="aproposar" placeholder="Aproposar"> --}}
            {!! $errors->first('aproposar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="aproposfr" class="form-label">{{ __('traduction.aproposfr') }}</label>
            <textarea name="aproposfr"
                id="aproposfr" cols="30"  rows="5" class="form-control @error('aproposfr') is-invalid @enderror"
                placeholder="aproposfr">{{ old('aproposfr', $apropo?->aproposfr) }}
            </textarea>
            {{-- <input type="text" name="aproposfr" class="form-control @error('aproposfr') is-invalid @enderror" value="{{ old('aproposfr', $apropo?->aproposfr) }}" id="aproposfr" placeholder="Aproposfr"> --}}
            {!! $errors->first('aproposfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="missionar" class="form-label">{{ __('traduction.missionar') }}</label>
            <textarea name="missionar"
                id="missionar" cols="30"  rows="5" class="form-control @error('missionar') is-invalid @enderror"
                placeholder="missionar">{{ old('missionar', $apropo?->missionar) }}
            </textarea>
            {{-- <input type="text" name="missionar" class="form-control @error('missionar') is-invalid @enderror" value="{{ old('missionar', $apropo?->missionar) }}" id="missionar" placeholder="Missionar"> --}}
            {!! $errors->first('missionar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="missionfr" class="form-label">{{ __('traduction.missionfr') }}</label>
            <textarea name="missionfr"
                id="missionfr" cols="30"  rows="5" class="form-control @error('missionfr') is-invalid @enderror"
                placeholder="missionfr">{{ old('missionfr', $apropo?->missionfr) }}
            </textarea>
            {{-- <input type="text" name="missionfr" class="form-control @error('missionfr') is-invalid @enderror" value="{{ old('missionfr', $apropo?->missionfr) }}" id="missionfr" placeholder="Missionfr"> --}}
            {!! $errors->first('missionfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="objectifar" class="form-label">{{ __('traduction.objectifar') }}</label>
            <textarea name="objectifar"
                id="objectifar" cols="30"  rows="5" class="form-control @error('objectifar') is-invalid @enderror"
                placeholder="objectifar">{{ old('objectifar', $apropo?->objectifar) }}
            </textarea>
            {{-- <input type="text" name="objectifar" class="form-control @error('objectifar') is-invalid @enderror" value="{{ old('objectifar', $apropo?->objectifar) }}" id="objectifar" placeholder="Objectifar"> --}}
            {!! $errors->first('objectifar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="objectiffr" class="form-label">{{ __('traduction.objectiffr') }}</label>
            <textarea name="objectiffr"
                id="objectiffr" cols="30"  rows="5" class="form-control @error('objectiffr') is-invalid @enderror"
                placeholder="objectiffr">{{ old('objectiffr', $apropo?->objectiffr) }}
            </textarea>
            {{-- <input type="text" name="objectiffr" class="form-control @error('objectiffr') is-invalid @enderror" value="{{ old('objectiffr', $apropo?->objectiffr) }}" id="objectiffr" placeholder="Objectiffr"> --}}
            {!! $errors->first('objectiffr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="visionar" class="form-label">{{ __('traduction.visionar') }}</label>
            <textarea name="visionar"
                id="visionar" cols="30"  rows="5" class="form-control @error('visionar') is-invalid @enderror"
                placeholder="visionar">{{ old('visionar', $apropo?->visionar) }}
            </textarea>
            {{-- <input type="text" name="visionar" class="form-control @error('visionar') is-invalid @enderror" value="{{ old('visionar', $apropo?->visionar) }}" id="visionar" placeholder="Visionar"> --}}
            {!! $errors->first('visionar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="visionfr" class="form-label">{{ __('traduction.visionfr') }}</label>
            <textarea name="visionfr"
                id="visionfr" cols="30"  rows="5" class="form-control @error('visionfr') is-invalid @enderror"
                placeholder="visionfr">{{ old('visionfr', $apropo?->visionfr) }}
            </textarea>
            {{-- <input type="text" name="visionfr" class="form-control @error('visionfr') is-invalid @enderror" value="{{ old('visionfr', $apropo?->visionfr) }}" id="visionfr" placeholder="Visionfr"> --}}
            {!! $errors->first('visionfr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>
