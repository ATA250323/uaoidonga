@extends('layouts.appespace2')

@section('template_title')
    Candidats
@endsection

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card">
                <div>
                    <button onclick="exportExcel()" class="no-print btn btn-sm" style="float: left; margin: 5px; color:rgb(244, 246, 244) ; background-color:rgb(94, 177, 94)"><i class="fa fa-fw fa-file-excel"></i>
                    {{ __('traduction.exporexcel') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </button>
                    <button id="downloadBtn" class="no-print btn btn-sm" style="float: left; margin: 5px; color:rgb(244, 246, 244) ; background-color:rgb(223, 120, 94)"><i class="fa fa-fw fa-file-pdf"></i>{{ __('traduction.exporpdf') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </button>
                    <button id="resetBtn" class="no-print btn btn-sm" style="float: left; margin: 5px; color:rgb(244, 246, 244) ; background-color:rgb(35, 89, 177)"><i class="fa fa-fw fa-refresh"></i>{{ __('traduction.reiniti') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}
                    </button>
                </div>
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('traduction.candidats') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('candidats.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fa fa-fw fa-plus"></i>
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div id="fiche-pdf" style="background-color: white; direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};">
                                    <u> <h4 id="titreFiltres"></h4></u>
                                    <table id="monTableau" class="table table-bordered table-sm">
                                        <thead class="thead">
                                            <tr>
                                                <th>#</th> <!-- Numérotation -->
                                                {{-- <th >Public Id</th> --}}
                                                <th >{{ __('traduction.matri') }}</th>
                                                <th >{{ __('traduction.nom') }}</th>
                                                <th >{{ __('traduction.prenom') }}</th>
                                                <th >{{ __('traduction.sexe') }}</th>
                                                {{-- <th >{{ __('traduction.datnais') }}</th> --}}
                                                <th >{{ __('traduction.centre') }}</th>
                                                <th >{{ __('traduction.etabli') }} </th>
                                                <th >{{ __('traduction.exam') }}</th>
                                                <th >{{ __('traduction.ansclair') }} </th>
                                                <th class="no-print">{{ __('traduction.action') }}</th>

                                            </tr>
                                            <tr class="no-print" >
                                                <th></th> <!-- Numérotation vide pour le filtre -->
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th><input type="text" class="form-control w-65" placeholder="{{ __('traduction.ecrire') }}"></th>
                                                <th class="action"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($candidats as $candidat)
                                                <tr>
                                                    {{-- Colonne numéro --}}
                                                    <td>{{ $loop->iteration }}</td>

                                                {{-- <td >{{ $candidat->public_id }}</td> --}}
                                                    <td >{{ $candidat->numero_table }}</td>
                                                    <td >{{ $candidat->nom }}</td>
                                                    <td >{{ $candidat->prenom }}</td>
                                                    <td >{{ $candidat->sexe }}</td>
                                                {{-- <td >{{ $candidat->date_naissance }}</td> --}}
                                                    <td >{{ $candidat->centre->nomar }}</td>
                                                    <td >{{ $candidat->etablissement->nomarabe }}</td>
                                                    <td >{{ $candidat->categoriesExamen->libelle }}</td>
                                                    <td >{{ app()->getLocale() === 'ar' ? $candidat->anneescolaire->anneear : $candidat->anneescolaire->anneefr}}</td>
                                                    <td class="no-print">
                                                        <form action="{{ route('candidats.destroy', $candidat->public_id) }}" method="POST">
                                                        {{-- <a class="btn btn-sm btn-primary " href="{{ route('candidats.show', $candidat->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                            <a class="btn btn-sm btn-success" href="{{ route('candidats.edit', $candidat->public_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                        <div id="totalCandidats" class="mb-2">
                                            {{ __('traduction.total') }}:  <span id="totalAvant">{{ $candidats->count() }}</span> <span id="totalApres"></span>
                                        </div>
                        </div>
                    </div>
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

                let countVisible = 0;
                    rows.forEach((row) => {
                            const cells = row.querySelectorAll('td');
                            let visible = true;

                            filtres.forEach((filtre, i) => {
                                if (filtre) {
                                    const cellText = cells[i+1].textContent.toLowerCase().trim(); // +1 pour colonne numéro
                                    if (modesFiltres[i+1] === 'exact') {
                                        if (cellText !== filtre) visible = false;
                                    } else {
                                        if (!cellText.includes(filtre)) visible = false;
                                    }
                                }
                            });

                            row.style.display = visible ? '' : 'none';

                            if (visible) {
                                cells[0].textContent = countVisible + 1; // numéro
                                countVisible++;
                            }
                        });

                        // Affichage conditionnel des totaux
                        const totalAvantEl = document.getElementById('totalAvant');
                        const totalApresEl = document.getElementById('totalApres');

                        const filtreActif = filtres.some(f => f !== ''); // true si au moins un filtre est actif

                        if (filtreActif) {
                            totalAvantEl.style.display = 'none';
                            totalApresEl.textContent = countVisible;
                            totalApresEl.parentElement.style.display = ''; // afficher totalApres
                        } else {
                            totalAvantEl.style.display = '';
                            totalApresEl.parentElement.style.display = 'none'; // cacher totalApres
                        }

                    // const filtresActifs = filtres
                    //     // .map((val, i) => val ? `${val} ` : "")
                    //     .map((val, i) => val ? `${ths[i].textContent} : ${val} -` : "")
                    //     .filter(Boolean);

                        const filtresActifs = filtres
                            .map((val, i) => val ? `${ths[i + 1].textContent.trim()} : ${val} -` : "")
                            .filter(Boolean);

                            document.getElementById("titreFiltres").textContent = filtresActifs.length
                                ? "{{ __('traduction.listeeleves') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }} " + filtresActifs.join(" ")
                                : "{{ __('traduction.listeeleves') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }} ";

                            // Masquer les colonnes filtrées (th + td), sauf si input a le focus

                                // ths.forEach((th, i) => {
                                //     const filtreActif = filtres[i];
                                //     const input = document.querySelector(`#monTableau thead tr:nth-child(2) th:nth-child(${i + 1}) input`);
                                //     const tds = document.querySelectorAll(`#monTableau tr td:nth-child(${i + 1}), #monTableau thead tr th:nth-child(${i + 1})`);

                                //     if (filtreActif && filtreActif !== '' && document.activeElement !== input) {
                                //         // Cache la colonne uniquement si l'input n'a pas le focus
                                //         tds.forEach(td => td.style.display = 'none');
                                //     } else {
                                //         // Sinon on affiche la colonne
                                //         tds.forEach(td => td.style.display = '');
                                //     }
                                // });
                                filtres.forEach((filtre, i) => {
                                    const colIndex = i + 1; // ⬅️ IMPORTANT : décalage colonne numéro

                                    const input = document.querySelector(
                                        `#monTableau thead tr:nth-child(2) th:nth-child(${colIndex + 1}) input`
                                    );

                                    const cells = document.querySelectorAll(
                                        `#monTableau tr td:nth-child(${colIndex + 1}),
                                        #monTableau thead tr th:nth-child(${colIndex + 1})`
                                    );

                                    if (filtre && document.activeElement !== input) {
                                        cells.forEach(cell => cell.style.display = 'none');
                                    } else {
                                        cells.forEach(cell => cell.style.display = '');
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
                            let titre = document.getElementById('titreFiltres')?.textContent.trim() || '{{ __("traduction.listeeleves") }}';
                            const fileNameSafe = titre.replace(/[\\\/:*?"<>|]/g, '_').slice(0, 200) ;

                            // Nom de feuille max 31 caractères
                            const sheetNameSafe = titre.replace(/[\\\/:*?"<>|]/g, '_').slice(0, 31) || "{{ __("traduction.listeeleves") }}";

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
                        if (!titre) titre = '{{ __('traduction.listeeleves') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */ }}'; // nom par défaut si vide

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
