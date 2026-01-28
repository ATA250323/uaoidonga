<div class="row">
    {{-- <div class="grid grid-cols-12 gap-3 mb-3"> --}}
        {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $categoriesExamen?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-12 col-md-4 col-xl-4">
            <label for="code" class="form-label">{{ __('traduction.prefixeet') }}</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $categoriesExamen?->code) }}" id="code" placeholder="Code">
            {!! $errors->first('code', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
         <div class="col-12 col-md-4 col-xl-4">
                        <label class="form-label mb-2 block">{{ __('traduction.nivo') }}</label>

                             <div class="d-flex align-items-center gap-2">

                                @foreach ($examens as $examen)
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error('examen') is-invalid @enderror"
                                            type="radio"
                                            name="libelle"
                                            id="examen_{{ $examen['examen'] }}"
                                            value="{{ $examen['examen'] }}"
                                            {{ old('examen', $categoriesExamen?->libelle) == $examen['examen'] ? 'checked' : '' }}
                                        >

                                        <label class="form-check-label" for="examen_{{ $examen['examen'] }}">
                                           {{ $examen['examen'] }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
            {!! $errors->first('libelle', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="libelle" class="form-label">{{ __('traduction.libelle') }}</label>
            <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror" value="{{ old('libelle', $categoriesExamen?->libelle) }}" id="libelle" placeholder="Libelle">
            {!! $errors->first('libelle', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}

    {{-- </div> --}}
   <div class="d-flex align-items-center gap-2 mt-4">
        <a href="{{ route('categories-examens.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-fw fa-arrow-left"></i> {{ __('traduction.retr') }}
        </a>
        <button type="submit" class="btn btn-success px-4"><i class="fa fa-fw fa-save me-1"></i>{{ __('traduction.enregistre') }}</button>
    </div>
</div>
