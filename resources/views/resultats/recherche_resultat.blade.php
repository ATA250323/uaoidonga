<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Consultation des Résultats</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <!-- Titre -->
    <div class="text-center mb-4">
        <h3 class="fw-bold">{{ __('traduction.Consultation') }}</h3>
        <p class="text-muted">{{ __('traduction.Veuillez_entrer') }}</p>
    </div>

    <!-- Recherche -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('recherche.resultats') }}">
                        <div class="input-group">
                            <input type="text"
                                   name="matricule"
                                   class="form-control"
                                   placeholder="Numéro matricule"
                                   value="{{ request('matricule') }}"
                                   required>
                            <button class="btn btn-primary">
                                🔍 {{ __('traduction.recher') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Résultat -->
   @if(request()->filled('matricule'))
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">

            @if($candidat && $information)
                <div class="card shadow mx-auto">
                    <div class="card-body ">

                        <!-- Photo -->
                            <div class="position-relative d-inline-block mb-3">
                                <img src="{{ $information->photo
                                        ? asset('storage/'.$information->photo)
                                        : asset('assetsapp/images/application/avatar-6.jpg') }}"
                                    class="rounded-circle img-thumbnail"
                                    style="width:160px;height:160px;object-fit:cover;"
                                    alt="Photo candidat">
                                <!-- Matricule sur la photo -->
                                <span class="position-absolute bottom-0 start-50 translate-middle-x
                                            bg-dark bg-opacity-75 text-white px-3 py-1 rounded-pill small">
                                    {{ $candidat->matricule }}
                                </span>
                            </div>
                        <!-- Infos -->
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <th style="width: 170px;">{{ __('traduction.nom') }}</th>
                                        <td>{{ $candidat->nom }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('traduction.prenom') }}</th>
                                        <td>{{ $candidat->prenom }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('traduction.sexe') }}</th>
                                        <td>{{ $candidat->sexe }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Date de naissance</th>
                                        <td>{{ $candidat->date_naissance }}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                            <hr style="height: 6px; background-color: #406030; border: none; opacity: 1;">

                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <th style="width: 170px;">{{ __('traduction.centre_id') }}</th>
                                        <td>{{ $candidat->centres }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('traduction.etabli') }}</th>
                                        <td>{{ $candidat->etablissements }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Décision -->
                        {{-- <span class="badge fs-6 px-4 py-2
                            {{ strtolower($candidat->decision) === 'admis'
                                ? 'bg-success'
                                : 'bg-danger' }}">
                            {{ strtoupper($candidat->decision ?? 'DÉCISION') }}
                        </span> --}}

                    </div>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    ❌ {{ __('traduction.aucun_resultat') }}
                </div>
            @endif

        </div>
    </div>
@endif


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
