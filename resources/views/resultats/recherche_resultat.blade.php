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
        <h3 class="fw-bold">Consultation des Résultats</h3>
        <p class="text-muted">Veuillez entrer votre numéro matricule</p>
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
                                🔍 Rechercher
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

            @if($candidat)
                <div class="card shadow mx-auto">
                    <div class="card-body ">

                        <!-- Photo -->
                        <img src="{{ $infos->photo
                                ? asset('storage/'.$infos->photo)
                                : asset('assetsapp/images/application/avatar-6.jpg') }}"
                             class="rounded-circle img-thumbnail mb-3"
                             style="width:160px;height:160px;object-fit:cover;"
                             alt="Photo candidat">

                        <!-- Infos -->
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <th style="width: 170px;">Nom</th>
                                        <td>{{ $candidat->nom }}</td>
                                    </tr>
                                    <tr>
                                        <th>Prénoms</th>
                                        <td>{{ $candidat->prenom }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sexe</th>
                                        <td>{{ $candidat->sexe }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Date de naissance</th>
                                        <td>{{ $candidat->date_naissance }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Matricule</th>
                                        <td class="fw-bold">{{ $candidat->matricule }}</td>
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
                    ❌ Aucun résultat trouvé pour ce matricule.
                </div>
            @endif

        </div>
    </div>
@endif


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
