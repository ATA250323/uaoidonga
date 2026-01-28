{{-- <div class="card-body p-4"> --}}
                <div class="row">
                        {{-- Année --}}
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="anneescolaire_id" class="form-label">{{ __('traduction.ansclair') }}</label>
                            {{-- <input type="text" name="annee" class="form-control @error('annee') is-invalid @enderror" value="{{ old('annee', $evennement?->annee) }}" id="annee" placeholder="{{ __('traduction.annee') }}"> --}}
                            <select name="anneescolaire_id" class="form-select @error('anneescolaire_id') is-invalid @enderror" autocomplete="organisation">
                                    @if ($candidat?->anneescolaire_id)
                                        <option value="{{ $candidat->anneescolaire_id }}">
                                            {{ $candidat->anneescolaire->anneear.' - '.$candidat->anneescolaire->anneefr }} {{-- Affiche le nom de l'enseignant --}}
                                        </option>
                                    {{-- @else
                                            <option value="">{{ __('traduction.selecte') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</option> --}}
                                    @endif
                                    @foreach ($anneescolaires as $anneescolaire)
                                        <option value="{{ $anneescolaire->id }}">{{$anneescolaire->anneear.' / '.$anneescolaire->anneefr }}</option>
                                    @endforeach
                            </select>
                            {!! $errors->first('anneescolaire_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                </div>
                <br><br>
                <div class="row">
                        <div class="col-12 col-md-3 col-xl-3">
                            <label for="etablissement_id" class="form-label">{{ __('traduction.etabli') }}</label>
                            <select name="etablissement_id" class="form-select @error('etablissement_id') is-invalid @enderror" autocomplete="organisation">
                                    @foreach ($etablissements as $etablissement)
                                        <option value="{{ $etablissement->id }}"
                                            {{ old('etablissement_id', $candidat?->etablissement_id) == $etablissement->id ? 'selected' : '' }}>
                                            {{ $etablissement->nomarabe.' '.$etablissement->nomfrancais }}
                                        </option>
                                    @endforeach
                            </select>
                            {!! $errors->first('etablissement_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-4 col-xl-4">
                            <label class="form-label mb-2 block">{{ __('traduction.exam') }}</label>

                            <div class="flex flex-wrap gap-4">
                                @foreach ($examens as $examen)
                                    <div class="flex items-center space-x-2">
                                        <input
                                            class="form-check-input @error('categorie_examen_id') border-red-500 @enderror"
                                            type="radio"
                                            name="categorie_examen_id"
                                            id="examen_{{ $examen->id }}"
                                            value="{{ $examen->id }}"
                                            {{ old('categorie_examen_id', $candidat?->categorie_examen_id) == $examen->id ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="examen_{{ $examen->id }}">
                                            {{ $examen->libelle }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            {!! $errors->first('categorie_examen_id', '<div class="text-red-500 text-sm mt-1"><strong>:message</strong></div>') !!}
                        </div>
                </div>
            <br><br>
                <div class="row">
                        <div class="col-12 col-md-4 col-xl-4">
                            <label for="numero_table" class="form-label">{{ __('traduction.matri') }}</label>
                            <input type="text" name="numero_table" class="form-control @error('numero_table') is-invalid @enderror" value="{{ old('numero_table', $candidat?->numero_table) }}" id="numero_table" placeholder="Numero Table">
                            {!! $errors->first('numero_table', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                </div>
            <br>
                <div class="row">
                        <div class="col-12 col-md-4 col-xl-4">
                            <label for="nom" class="form-label">{{ __('traduction.nom') }}</label>
                            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $candidat?->nom) }}" id="nom" placeholder="Nom">
                            {!! $errors->first('nom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-4 col-xl-4">
                            <label for="prenom" class="form-label">{{ __('traduction.prenom') }}</label>
                            <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $candidat?->prenom) }}" id="prenom" placeholder="Prenom">
                            {!! $errors->first('prenom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-12 col-md-4 col-xl-4">
                            <label class="form-label mb-2 block">{{ __('traduction.sexe') }}</label>

                             <div class="d-flex align-items-center gap-2">

                                @foreach ($sexes as $sexe)
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error('sexe') is-invalid @enderror"
                                            type="radio"
                                            name="sexe"
                                            id="sexe_{{ $sexe['sexe'] }}"
                                            value="{{ $sexe['sexe'] }}"
                                            {{ old('sexe', $candidat?->sexe) == $sexe['sexe'] ? 'checked' : '' }}
                                        >

                                        <label class="form-check-label" for="sexe_{{ $sexe['sexe'] }}">
                                           {{ $sexe['sexe'] }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>

                            {!! $errors->first('sexe', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
                        </div>

                        {{-- <div class="col-12 col-md-4 col-xl-4">
                            <label for="date_naissance" class="form-label">{{ __('traduction.datnais') }}</label>
                            <input type="text" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance', $candidat?->date_naissance) }}" id="date_naissance" placeholder="Date Naissance">
                            {!! $errors->first('date_naissance', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div> --}}
                </div>
            <br><br>
                <!-- Boutons -->
                        <div class="d-flex align-items-center gap-2 mt-4">
                            <a href="{{ route('candidats.index') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-fw fa-arrow-left"></i> {{ __('traduction.retr') }}
                            </a>
                            <button type="submit" class="btn btn-success px-4"><i class="fa fa-fw fa-save"></i>{{ __('traduction.enregistre') }}</button>
                        </div>

        {{-- </div>--}}

