<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- <div class="form-group mb-2 mb20">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $organisation?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="form-group mb-2 mb20">
            <label for="titre" class="form-label">{{ __('Titre') }}</label>
            <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre', $organisation?->titre) }}" id="titre" placeholder="Titre">
            {!! $errors->first('titre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Description') }}</label>
             <textarea name="description"
                id="description" cols="30"  rows="10" class="form-control @error('description') is-invalid @enderror"
                placeholder="Description">{{ old('description') }}
            </textarea>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
        <div class="form-group mb-2 mb20">
            <label for="image" class="form-label">{{ __('Image') }}</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $organisation?->image) }}" id="image" placeholder="Image">
            {!! $errors->first('image', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
