<div class="row">
    <div class="grid grid-cols-12 gap-3 mb-3">
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="nom_prenom" class="form-label">{{ __('traduction.nom') }}</label>
            <input type="text" name="nom_prenom" class="form-control @error('nom_prenom') is-invalid @enderror" value="{{ old('nom_prenom', $temoin?->nom_prenom) }}" id="nom_prenom" placeholder="">
            {!! $errors->first('nom_prenom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="messagear" class="form-label">{{ __('traduction.messagear') }}</label>
            <input type="text" name="messagear" class="form-control @error('messagear') is-invalid @enderror" value="{{ old('messagear', $temoin?->messagear) }}" id="messagear" placeholder="">
            {!! $errors->first('messagear', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="messagefr" class="form-label">{{ __('traduction.messagefr') }}</label>
            <input type="text" name="messagefr" class="form-control @error('messagefr') is-invalid @enderror" value="{{ old('messagefr', $temoin?->messagefr) }}" id="messagefr" placeholder="">
            {!! $errors->first('messagefr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <label for="nom_organe" class="form-label">{{ __('traduction.organisation') }}</label>
            <select name="nom_organe" class="form-select @error('nom_organe') is-invalid @enderror" autocomplete="organisation">
                    <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option>
                @foreach ($organisations as $organisation)
                    <option value="{{ $organisation->titre }}">{{ ucfirst($organisation->titre) }}</option>
                @endforeach
            </select>
            {{-- <input type="text" name="nom_organe" class="form-control @error('nom_organe') is-invalid @enderror" value="{{ old('nom_organe', $temoin?->nom_organe) }}" id="nom_organe" placeholder=""> --}}
            {!! $errors->first('nom_organe', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-span-12 xl:col-span-12 md:col-span-12">
            <label for="image" class="form-label">{{ __('traduction.photo') }}</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $temoin?->image) }}" id="image" placeholder="">
            {!! $errors->first('image', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
    </div>
</div>