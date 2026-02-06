@extends('layouts.appespace')
@php
    $lien = route('consultation.resultats');
    $textePartage = urlencode(__('traduction.resultat_dispo') ."Découvrez cet établissement : $lien");
@endphp
@section('content')
 <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                      <div class="col-span-12 xl:col-span-6 md:col-span-6">
                        <h1 class="mb-2 fw-bold text-success">{{ __('traduction.lienresult') }}</h1>
                        <p>{{ __('traduction.partage') }}</p>
                                    <div class="">

                                        <div class="card-header !pb-0 !border-b-0">
                                            <h3>
                                                <a href="{{ route('consultation.resultats') }}" class="badge bg-theme-bg-1 text-white text-[12px]"><i class="fab fa-link"></i>{{ __('traduction.lien') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}</a>
                                                <a href="https://wa.me/?text={{ $textePartage }}" target="_blank"
                                                class="badge bg-green-500 hover:bg-green-600 rounded text-white text-[12px]">
                                                    <i class="fab fa-whatsapp"></i> {{ __('traduction.what') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                </a>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($lien) }}" target="_blank"
                                                    class="badge bg-blue-500 hover:bg-blue-700 rounded mt-1 text-white text-[12px]">
                                                        <i class="fab fa-facebook-f"></i> {{ __('traduction.face') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?text={{ $textePartage }}" target="_blank"
                                                    class="badge bg-sky-500 hover:bg-sky-500 rounded mt-1 text-white text-[12px]">
                                                        <i class="fab fa-twitter"></i> {{ __('traduction.twi') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                </a>
                                                <a href="https://t.me/share/url?url={{ urlencode($lien) }}&text={{ $textePartage }}" target="_blank"
                                                    class="badge bg-blue-500 hover:bg-blue-500 rounded mt-1 text-white text-[12px]">
                                                        <i class="fab fa-telegram-plane"></i> {{ __('traduction.tele') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                </a>
                                                <button type="button"
                                                    onclick="copyLien('{{ $lien }}')"
                                                    class="badge bg-theme-bg-1 text-white text-[12px]">
                                                    📋<i class="fab fa-copy"></i> {{ __('traduction.copier') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                                                </button>
                                            </h3>
                                        </div>
                                    </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        function copyLien(texte) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(texte).then(() => alert('Lien copié !'))
                .catch(() => fallbackCopy(texte));
            } else {
                fallbackCopy(texte);
            }
        }

        function fallbackCopy(texte) {
            let input = document.createElement("input");
            input.value = texte;
            document.body.appendChild(input);
            input.select();
            document.execCommand("copy");
            document.body.removeChild(input);
            alert("Lien copié !");
        }
    </script>

    <script>
            function toggleMenu() {
                document.getElementById('shareMenu').classList.toggle('hidden');
            }

            // Fonction pour copier le lien
            function copyLien(texte) {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(texte).then(() => alert('Lien copié !'))
                    .catch(() => fallbackCopy(texte));
                } else {
                    fallbackCopy(texte);
                }
            }

            function fallbackCopy(texte) {
                let input = document.createElement("input");
                input.value = texte;
                document.body.appendChild(input);
                input.select();
                document.execCommand("copy");
                document.body.removeChild(input);
                alert("{{ __('traduction.liencopier') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}");
            }
    </script>
@endsection
