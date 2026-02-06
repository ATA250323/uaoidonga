<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-pc-theme="light">
    <head>
    <meta charset="UTF-8">
    <title>{{ __('traduction.titleresultat') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</head>

<body class="bg-light">

<div class="container py-5">
     @include('layouts.partifixe.alert')
<a href="{{ route('consultation.resultats') }}" class="btn btn-primary  ">{{ __('traduction.retr') }}</a>
    <!-- Titre -->
    <div class="text-center mb-4">
        <h3 class="fw-bold">{{ __('traduction.Consultation') }}</h3>
        <p class="text-muted">{{ __('traduction.Veuillez_entrer') }} (00FS000) </p>
    </div>
    <!-- Recherche -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('recherche.sanawi') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="matricule" class="form-control" placeholder="" required>

                            <button class="btn btn-primary">
                                🔍 {{ __('traduction.recher') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>
            @error('matricule')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>


@php
    $headers = [
        'anneescolaire_id' => __('traduction.annee'),
    ];
@endphp
    <!-- Résultat -->
   {{-- @if(request()->filled('matricule')) --}}
@if(isset($resultatcandidat))
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            @if($resultatcandidat && $information)
                <div class="card shadow mx-auto">
                    <div class="card-body ">
                        <!-- Photo -->
                        <div class="position-relative d-inline-block mb-3">
                                @if ($information->sexe === __('traduction.sexe1'))
                                    <img src="{{ $information->photo
                                            ? asset('storage/'.$information->photo)
                                            : asset('assetsapp/images/application/avatar-7.jpg') }}"
                                        class="rounded-circle img-thumbnail"
                                        style="width:160px;height:160px;object-fit:cover;"
                                        alt="Photo candidat">
                                @else
                                    <img src="{{ $information->photo
                                            ? asset('storage/'.$information->photo)
                                            : asset('assetsapp/images/application/avatar-6.jpg') }}"
                                        class="rounded-circle img-thumbnail"
                                        style="width:160px;height:160px;object-fit:cover;"
                                        alt="Photo candidat">
                                @endif
                                <!-- Matricule sur la photo -->
                                <span class="position-absolute bottom-0 start-50 translate-middle-x
                                            bg-dark bg-opacity-75 text-white px-3 py-1 rounded-pill small">
                                    {{ $resultatcandidat->matricule }}
                                </span>
                        </div>
                        <!-- Infos -->
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <th style="width: 170px;">{{ __('traduction.nom') }}</th>
                                        <td>{{ $resultatcandidat->nom }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('traduction.prenom') }}</th>
                                        <td>{{ $resultatcandidat->prenom }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('traduction.sexe') }}</th>
                                        <td>{{ $resultatcandidat->sexe }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Date de naissance</th>
                                        <td>{{ $resultatcandidat->date_naissance }}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                            {{-- <hr style="height: 6px; background-color: #406030; border: none; opacity: 1;"> --}}
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <th style="width: 170px;">{{ __('traduction.centre_id') }}</th>
                                        <td>
                                            {{ $information->centre->nomar ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('traduction.etabli') }}</th>
                                        <td>
                                            {{ $information->etablissement->nomarabe ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <hr style="height: 6px; background-color: #406030; border: none; opacity: 1;"> --}}
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <th>{{ __('traduction.exam') }}</th>
                                        <td>
                                            {{ $information->categoriesExamen->libelle ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 170px;">{{ __('traduction.annee') }}</th>
                                        <td>
                                            {{ $information->anneescolaire->anneear ?? '' }} {{ $information->anneescolaire->anneefr ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                             <!-- Décision -->
                        <span>
                            {{ __('traduction.jurys') }}
                        </span>
                        @php
                            $sexe = $resultatcandidat->sexe;
                            $decision = $resultatcandidat->decision;
                        @endphp

                        @if($sexe === __('traduction.sexe1')) {{-- Masculin --}}
                            <span class="badge fs-6 px-4 py-2
                                {{ $decision === __('traduction.admis') ? 'bg-success' : 'bg-danger' }}">
                                {{ $decision === __('traduction.admis')
                                    ? __('traduction.admis')
                                    : __('traduction.refuse') }}
                            </span>
                        @else {{-- Féminin --}}
                            <span class="badge fs-6 px-4 py-2
                                {{ $decision === __('traduction.admise') ? 'bg-success' : 'bg-danger' }}">
                                {{ $decision === __('traduction.admise')
                                    ? __('traduction.admise')
                                    : __('traduction.refusee') }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
@endif


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
