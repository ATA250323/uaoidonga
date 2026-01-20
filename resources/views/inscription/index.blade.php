@extends('layouts.appespace2')

@section('content')
    <div class="pc-container">
      <div class="pc-content">

                        <br>
                <!-- Boutons -->
                <div>
                <button onclick="exportExcel()" class="no-print btn btn-sm" style="float: left; margin: 5px; color:rgb(244, 246, 244) ; background-color:rgb(94, 177, 94)"><i class="fa fa-fw fa-file-excel"></i>
                {{ __('traduction.exporexcel') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </button>
                <button id="downloadBtn" class="no-print btn btn-sm" style="float: left; margin: 5px; color:rgb(244, 246, 244) ; background-color:rgb(223, 120, 94)"><i class="fa fa-fw fa-file-pdf"></i>{{ __('traduction.exporpdf') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </button>
                <button id="resetBtn" class="no-print btn btn-sm" style="float: left; margin: 5px; color:rgb(244, 246, 244) ; background-color:rgb(35, 89, 177)"><i class="fa fa-fw fa-refresh"></i>{{ __('traduction.reiniti') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                </button>
                </div>
                <br>
                <br>
                <br>
                {{-- <h4>
                    {{ __('traduction.programs') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </h4> --}}
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">

                                {{ __('traduction.listeconfondu') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}

                            </span>

                             <div class="float-right">
                                <a href="{{ route('inscriptions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-plus"></i>
                                </a>
                              </div>
                        </div>
                    <br>
            <div id="fiche-pdf" style="background-color: white; direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};  font-size: 18px">
                <u> <h4 id="titreFiltres"></h4></u>
                <table id="monTableau" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>
                                {{ __('traduction.matri') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>
                            <th>
                                {{ __('traduction.nom') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>
                            <th>
                                {{ __('traduction.sexe') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>
                            <th>
                                {{ __('traduction.nivo') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>
                            <th data-filter="exact">
                            {{ __('traduction.etabli') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>
                            <th>
                                {{ __('traduction.annee') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>
                            <th class="no-print">
                                {{ __('traduction.action') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                            </th>

                        </tr>
                        <tr class="no-print" >
                            <th><input type="text" placeholder="{{ __('traduction.ecrire') }}"></th>
                            <th><input type="text" placeholder="{{ __('traduction.ecrire') }}"></th>
                            <th><input type="text" placeholder="{{ __('traduction.ecrire') }}"></th>
                            <th><input type="text" placeholder="{{ __('traduction.ecrire') }}"></th>
                            <th><input type="text" placeholder="{{ __('traduction.ecrire') }}"></th>
                            <th><input type="text" placeholder="{{ __('traduction.ecrire') }}"></th>
                            <th class="action"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscriptions as $inscription)
                            <tr>
                                <td>
                                    {{ $inscription->matricule ?? '' }}
                                </td>
                                <td>{{ $inscription->nom ?? '' }}</td>
                                {{-- <td>{{ $inscription->classe->niveau ?? '' }}</td> --}}
                                <td>
                                    @if ($inscription->sexe === 'm')
                                        {{ __('traduction.sexe1') }}
                                    @else
                                        {{ __('traduction.sexe2') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($inscription->niveau === 'n1')
                                        {{ __('traduction.niveau1') }}
                                    @else
                                        {{ __('traduction.niveau2') }}
                                    @endif
                                </td>
                                <td>{{ app()->getLocale() == 'ar' ? $inscription->etablissement->nomarabe : $inscription->etablissement->nomfrancais }}</td>
                                <td >{{ app()->getLocale() === 'ar' ? $inscription->anneescolaire->anneear : $inscription->anneescolaire->anneefr}}</td>
                                <td  class="no-print">
                                {{-- ✅ Boutons actions --}}
                                    <a href="{{ route('inscriptions.edit', $inscription->public_id) }}" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>

                                    <form action="{{ route('inscriptions.destroy', $inscription->public_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('{{ __('traduction.confirm_delete') }}')"><i class="fa fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <br>

<script>
let debounceTimer;

document.querySelectorAll('#monTableau thead tr:nth-child(2) input').forEach(input => {
    input.addEventListener('keyup', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(filtrerTableau, 500);
    });
    input.addEventListener('blur', () => {
        filtrerTableau();
    });
});

function filtrerTableau() {
    const rows = document.querySelectorAll('#monTableau tbody tr');
    const inputs = Array.from(document.querySelectorAll('#monTableau thead tr:nth-child(2) input'));
    const filtres = inputs.map(inp => inp.value.toLowerCase().trim());

    const ths = document.querySelectorAll('#monTableau thead tr:first-child th');
    const modesFiltres = Array.from(ths).map(th => th.dataset.filter || 'partial');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let visible = true;

        filtres.forEach((filtre, i) => {
            if (filtre) {
                const cellText = cells[i].textContent.toLowerCase().trim();
                if (modesFiltres[i] === 'exact') {
                    if (cellText !== filtre) visible = false;
                } else {
                    if (!cellText.includes(filtre)) visible = false;
                }
            }
        });

        row.style.display = visible ? '' : 'none';
    });

    const filtresActifs = filtres
        // .map((val, i) => val ? `${val} ` : "")
        .map((val, i) => val ? `${ths[i].textContent} : ${val} -` : "")
        .filter(Boolean);

    document.getElementById("titreFiltres").textContent = filtresActifs.length
        ? "{{ __('traduction.list') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }} " + filtresActifs.join(" ")
        : "{{ __('traduction.list') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }} ";

       // Masquer les colonnes filtrées (th + td), sauf si input a le focus
        ths.forEach((th, i) => {
            const filtreActif = filtres[i];
            const input = document.querySelector(`#monTableau thead tr:nth-child(2) th:nth-child(${i + 1}) input`);
            const tds = document.querySelectorAll(`#monTableau tr td:nth-child(${i + 1}), #monTableau thead tr th:nth-child(${i + 1})`);

            if (filtreActif && filtreActif !== '' && document.activeElement !== input) {
                // Cache la colonne uniquement si l'input n'a pas le focus
                tds.forEach(td => td.style.display = 'none');
            } else {
                // Sinon on affiche la colonne
                tds.forEach(td => td.style.display = '');
            }
        });

}

function cacherElementsAvantExport() {
    document.querySelectorAll('.no-print').forEach(el => el.style.display = 'none');
}
function afficherElementsApresExport() {
    document.querySelectorAll('.no-print').forEach(el => el.style.display = '');
}


function exportExcel() {
    cacherElementsAvantExport();

    try {
        // Titre pour fichier
        let titre = document.getElementById('titreFiltres')?.textContent.trim() || '{{ __("traduction.list") }}';
        const fileNameSafe = titre.replace(/[\\\/:*?"<>|]/g, '_').slice(0, 200) ;

        // Nom de feuille max 31 caractères
        const sheetNameSafe = titre.replace(/[\\\/:*?"<>|]/g, '_').slice(0, 31) || "{{ __("traduction.list") }}";

        // Lire le tableau
        let table = document.getElementById('monTableau');

        // Récupérer filtres
        let filtres = Array.from(table.querySelectorAll('thead tr:nth-child(2) input'));
        let colonnesAFermer = [];
        filtres.forEach((input, index) => {
            if (input.value.trim() !== "") {
                colonnesAFermer.push(index);
            }
        });

        // En-têtes
        const ths = Array.from(table.querySelectorAll('thead tr:first-child th'))
            .map((th, i) => colonnesAFermer.includes(i) ? null : th.textContent.trim())
            .filter(Boolean);

        // Lignes

        // Lignes visibles uniquement
        const rows = Array.from(table.querySelectorAll('tbody tr'))
            .filter(tr => tr.style.display !== 'none') // <-- garder seulement celles visibles
            .map(tr =>
                Array.from(tr.querySelectorAll('td'))
                    .map((td, i) => colonnesAFermer.includes(i) ? null : td.textContent.trim())
                    .filter(cell => cell !== null)
            );


        // Détection arabe
        let isArabic = document.documentElement.lang === "ar";

        let headers = [...ths];
        let bodyRows = rows.map(r => [...r]);

        if (isArabic) {
            headers.reverse();
            bodyRows = bodyRows.map(r => r.reverse());
        }

        // Construire la feuille : titre + ligne vide + en-têtes + données
        const aoa = [];
        aoa.push([titre]);
        aoa.push([]);
        aoa.push(headers);
        bodyRows.forEach(r => aoa.push(r));

        const ws = XLSX.utils.aoa_to_sheet(aoa);

        // Fusion du titre sur toute la largeur
        ws['!merges'] = ws['!merges'] || [];
        if (headers.length > 0) {
            ws['!merges'].push({ s: { r: 0, c: 0 }, e: { r: 0, c: headers.length - 1 } });
        }

        // Créer et exporter le fichier
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, sheetNameSafe);
        XLSX.writeFile(wb, fileNameSafe + ".xlsx");
    } finally {
        afficherElementsApresExport();
    }
}



document.getElementById('downloadBtn').addEventListener('click', async () => {
    cacherElementsAvantExport();

    // Récupérer le titre
    let titre = document.getElementById('titreFiltres').textContent.trim();
    if (!titre) titre = '{{ __('traduction.list') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}'; // nom par défaut si vide

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'mm', 'a4');
    const element = document.getElementById('monTableau');

    await html2canvas(element, { scale: 2, useCORS: true }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pageWidth = doc.internal.pageSize.getWidth();
        const margin = 10;
        const pdfWidth = pageWidth - margin * 2;
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

        doc.addImage(imgData, 'PNG', margin, margin, pdfWidth, pdfHeight);
        doc.save(titre + ".pdf");

        afficherElementsApresExport();
    });
});

document.getElementById('resetBtn').addEventListener('click', () => {
    // Vider tous les inputs de filtre
    document.querySelectorAll('#monTableau thead tr:nth-child(2) input').forEach(input => {
        input.value = '';
    });

    // Réafficher toutes les lignes
    document.querySelectorAll('#monTableau tbody tr').forEach(row => {
        row.style.display = '';
    });

    // Réafficher toutes les colonnes (th + td)
    const ths = document.querySelectorAll('#monTableau thead tr:first-child th');
    ths.forEach((th, i) => {
        const tds = document.querySelectorAll(`#monTableau tr td:nth-child(${i + 1}), #monTableau thead tr th:nth-child(${i + 1})`);
        tds.forEach(td => td.style.display = '');
    });

    // Vider le titre des filtres actifs
    document.getElementById('titreFiltres').textContent = '';
});
</script>
</div>
</div>

@endsection
