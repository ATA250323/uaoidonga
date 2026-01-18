<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">
                                {{ __('traduction.matier') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                   </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name ?? '' }}" id="name" placeholder="name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-md-12 mt20 mt-2">
                <button type="submit" class="btn btn-primary">
                                        {{ __('traduction.enregistre') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                        </button>
            </div>
</div>
</div>        
