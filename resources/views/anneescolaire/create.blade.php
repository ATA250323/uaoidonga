@php
    use Alkoumi\LaravelHijriDate\Hijri; // Si tu utilises un package Hijri


                $dataAnnee = [];

                $startYear = 2025;
                $endYear   = date('Y') -1; // année en cours

                for ($i = $startYear; $i <= $endYear; $i++) {
                    $dataAnnee[$i] = $i . ' - ' . ($i + 1);
                }


                if (!function_exists('convertToArabicDigits')) {
                    function convertToArabicDigits($number) {
                        $western = ['0','1','2','3','4','5','6','7','8','9'];
                        $arabic  = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
                        return str_replace($western, $arabic, $number);
                    }
                }

            $dataAnneeAr = [];
            for ($i = $startYear; $i <= $endYear; $i++) {
                // Conversion de 1er janvier de chaque année en Hijri
                $hijriStart = Hijri::Date('Y', $i . '-01-01');       // Année Hijri début
                $hijriEnd = Hijri::Date('Y', ($i + 1) . '-01-01');   // Année Hijri fin

                // Convertir en chiffres arabes (facultatif)
                $arabicStart = convertToArabicDigits($hijriStart);
                $arabicEnd = convertToArabicDigits($hijriEnd);

                $dataAnneeAr[$i] = $arabicStart . ' - ' . $arabicEnd . ' هـ';
            }
@endphp
@extends('layouts.appespace2')

@section('template_title')
    {{ __('Create') }} Anneescolaire
@endsection

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('traduction.ansclair') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('anneescolaires.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            {{-- @include('anneescolaire.form') --}}
                            <div class="row">
                                    <div class="grid grid-cols-12 gap-3 mb-3">
                                        <div class="col-span-12 xl:col-span-4 md:col-span-6">
                                                    {{-- Étape 1 : Année --}}
                                            <div>
                                                <label for="anneefr" class="form-label">
                                                    {{ __('traduction.anneefr') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                </label>
                                                <select name="anneefr" class="form-select @error('anneefr') is-invalid @enderror" id="anneefr">
                                                    <option >{{  __('traduction.selecte') }}</option>
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
                                                        <option >{{ __('traduction.selecte') }}</option>
                                                        {{-- <option value="2025-2026 / ١٤٤٦-١٤٤٧">2025-2026 / ١٤٤٦-١٤٤٧</option> --}}
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
                                    <button type="submit" class="btn btn-primary">{{ __('traduction.enregistre') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
