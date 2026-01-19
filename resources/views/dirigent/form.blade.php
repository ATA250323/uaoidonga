<div class="row">
    <div class="grid grid-cols-12 gap-3 mb-3">
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="nom" class="form-label">{{ __('traduction.nom') }}</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $dirigent?->nom) }}" id="nom" placeholder="Nom">
            {!! $errors->first('nom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="profession" class="form-label">{{ __('traduction.profession') }}</label>
            <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" value="{{ old('profession', $dirigent?->profession) }}" id="profession" placeholder="Profession">
            {!! $errors->first('profession', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="facebook" class="form-label">{{ __('traduction.lifac') }}</label>
            <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $dirigent?->facebook) }}" id="facebook" placeholder="Facebook">
            {!! $errors->first('facebook', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="whatsapp" class="form-label">{{ __('traduction.whtup') }}</label>
            <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $dirigent?->whatsapp) }}" id="whatsapp" placeholder="Whatsapp">
            {!! $errors->first('whatsapp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="tiweter" class="form-label">{{ __('traduction.litwi') }}</label>
            <input type="text" name="tiweter" class="form-control @error('tiweter') is-invalid @enderror" value="{{ old('tiweter', $dirigent?->tiweter) }}" id="tiweter" placeholder="Tiweter">
            {!! $errors->first('tiweter', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="email" class="form-label">{{ __('traduction.email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $dirigent?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-12 md:col-span-12">
            <label for="image" class="form-label">{{ __('traduction.photo') }}</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $dirigent?->image) }}" id="image" placeholder="Image">
            {!! $errors->first('image', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
    </div>
</div>
