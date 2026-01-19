@php
    use Alkoumi\LaravelHijriDate\Hijri; // Si tu utilises un package Hijri

                $dataAnnee = [];
                for ($i = date('Y'); $i > date('Y') - 1; $i--) {
                    $dataAnnee[$i] = $i . ' - ' . ($i +1) ;
                }

                if (!function_exists('convertToArabicDigits')) {
                    function convertToArabicDigits($number) {
                        $western = ['0','1','2','3','4','5','6','7','8','9'];
                        $arabic  = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
                        return str_replace($western, $arabic, $number);
                    }
                }

        $dataAnneeAr = [];
            for ($i = date('Y')+2; $i > date('Y') - 1; $i--) {
                // Conversion de 1er janvier de chaque année en Hijri
                $hijriStart = Hijri::Date('Y', $i . '-01-01');       // Année Hijri début
                $hijriEnd = Hijri::Date('Y', ($i + 1) . '-01-01');   // Année Hijri fin

                // Convertir en chiffres arabes (facultatif)
                $arabicStart = convertToArabicDigits($hijriStart);
                $arabicEnd = convertToArabicDigits($hijriEnd);

                $dataAnneeAr[$i] = $arabicStart . ' - ' . $arabicEnd . ' هـ';
            }
@endphp

        {{-- <div class="form-group mb-2 mb20">
            <label for="public_id" class="form-label">{{ __('Public Id') }}</label>
            <input type="text" name="public_id" class="form-control @error('public_id') is-invalid @enderror" value="{{ old('public_id', $anneescolaire?->public_id) }}" id="public_id" placeholder="Public Id">
            {!! $errors->first('public_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="form-group mb-2 mb20">
            <label for="anneefr" class="form-label">{{ __('Anneefr') }}</label>
            <input type="text" name="anneefr" class="form-control @error('anneefr') is-invalid @enderror" value="{{ old('anneefr', $anneescolaire?->anneefr) }}" id="anneefr" placeholder="Anneefr">
            {!! $errors->first('anneefr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="anneear" class="form-label">{{ __('Anneear') }}</label>
            <input type="text" name="anneear" class="form-control @error('anneear') is-invalid @enderror" value="{{ old('anneear', $anneescolaire?->anneear) }}" id="anneear" placeholder="Anneear">
            {!! $errors->first('anneear', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
                <div class="row">
                            @include('layouts.partifixe.alert')
                        <div class="grid grid-cols-12 gap-3 mb-3">
                            <div class="col-span-12 xl:col-span-4 md:col-span-6">
                                        {{-- Étape 1 : Année --}}
                                <div>
                                    <label for="anneefr" class="form-label">
                                        {{ __('traduction.anneefr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                    </label>
                                    <select name="anneefr" class="form-select @error('anneefr') is-invalid @enderror" id="anneefr">
                                        <option value="{{ old('anneefr', $anneescolaire?->anneefr) }}">{{ $anneescolaire?->anneefr }}</option>
                                        @foreach ($dataAnnee as $value)
                                            <option value="{{ $value }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                        {!! $errors->first('anneefr', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4 md:col-span-6">
                                    {{-- Étape 1 : Année --}}
                                    <div>
                                    <label for="anneear" class="form-label">
                                                    {{ __('traduction.anneear') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                    </label>
                                    <select name="anneear" class="form-select @error('anneear') is-invalid @enderror" id="anneear">
                                            <option value="{{ old('anneefr', $anneescolaire?->anneefr) }}">{{ $anneescolaire?->anneefr }}</option>
                                            @foreach ($dataAnneeAr as $value)
                                                <option value="{{ $value }}">
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                    </select>
                                    {!! $errors->first('anneear', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                    </div>
                            </div>
                        </div>
                </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
