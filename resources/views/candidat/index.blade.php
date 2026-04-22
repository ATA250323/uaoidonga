@extends('layouts.appespace2')

@section('template_title')
    Candidats
@endsection
@php
    $headers = [
        'numero_table' => __('traduction.matri'),
        'nom' => __('traduction.noms'),
        'sexe' => __('traduction.sexe'),
        'etablissement_id' => __('traduction.etabli'),
        'categorie_examen_id' => __('traduction.exame'),
        'anneescolaire_id' => __('traduction.annee'),
    ];
@endphp
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <h3>{{ __('traduction.candidats') }}</h3>
                        <table id="resultatsTable" class="table table-bordered table-striped">
                            <div id="titreFiltres" style="margin-bottom:10px; font-weight:bold;"></div>
                            <thead>
                                <tr>
                                    @foreach($colonnes as $col)
                                        <th>{{ $headers[$col] ?? ucfirst(str_replace('_',' ',$col)) }}</th>
                                        {{-- 🔥 AJOUT CENTRE AU MILIEU --}}
                                        @if($col == 'etablissement_id')
                                            <th>{{ __('traduction.centre') }}</th>
                                        @endif
                                    @endforeach
                                    {{-- action reste à la fin --}}
                                    <th class="no-print">{{ __('traduction.action') }}</th>
                                </tr>
                                <tr>
                                    @foreach($colonnes as $col)
                                        <th>
                                            <input type="text" class="form-control form-control-sm column-search"
                                                placeholder="{{ __('traduction.reche') }}">
                                        </th>
                                        {{-- 🔥 filtre centre au même endroit --}}
                                        @if($col == 'etablissement_id')
                                            <th>
                                                <input type="text" class="form-control form-control-sm column-search"
                                                    placeholder="{{ __('traduction.reche') }}">
                                            </th>
                                        @endif
                                    @endforeach
                                    {{-- pas de filtre pour action --}}
                                    <th class="no-print"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($candidats as $row)
                                <tr data-id="{{ $row->id }}">
                                    @foreach($colonnes as $col)
                                        <td>
                                            @if($col == 'etablissement_id')
                                                {{ $row->nomarabe ?? '-' }}
                                            @elseif($col == 'categorie_examen_id')
                                                {{ $row->libelle ?? '-' }}
                                            @elseif($col == 'anneescolaire_id')
                                                {{ $row->anneefr ?? '-' }}
                                            @else
                                                {{ $row->$col ?? '-' }}
                                            @endif
                                        </td>
                                    {{-- 🔥 AJOUT AU MILIEU --}}
                                        @if($col == 'etablissement_id')
                                            <td>{{ $row->centre_nom ?? '-' }}</td>
                                        @endif
                                    @endforeach
                                    {{-- Actions --}}
                                    <td class="no-print">
                                        <form action="{{ route('candidats.destroy', $row->public_id) }}" method="POST">
                                            <a class="btn btn-sm btn-success" href="{{ route('candidats.edit', $row->public_id) }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                                            confirm('{{ __('traduction.confirm_delete') }}') ? this.closest('form').submit() : false;">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
        </div>
    </div>

<script>
$(document).ready(function () {

    let table = $('#resultatsTable').DataTable({
        pageLength: 10,
        orderCellsTop: true,
        fixedHeader: true,
        dom: 'Blfrtip',
     buttons: [
    // {
    //     extend: 'excelHtml5',
    //     text: '📊 {{ __('traduction.excel') }}',
    //     className: 'btn btn-success btn-sm',
    //     exportOptions: { columns: ':visible' },
    //     title: function() {
    //         return ($('#titreFiltres').text() || "Sans filtre");
    //     }
    // },
    {
        text: '📊 {{ __("traduction.excel") }}',
        className: 'btn btn-success btn-sm',
        action: function (e, dt, node, config) {

            let ids = [];
            let visibleCols = [];

            // ✅ lignes filtrées
            dt.rows({ search: 'applied' }).every(function () {
                let row = this.node();
                let id = $(row).data('id');
                if(id) ids.push(id);
            });

            // ✅ colonnes visibles
            dt.columns(':visible').every(function () {
                visibleCols.push(this.index());
            });

            // ✅ titre
            let title = $('#titreFiltres').text() || "Sans filtre";

            // 🔹 URL
            let query = $.param({
                ids: ids,
                visibleCols: visibleCols,
                title: title
            });

            let url = "{{ route('candidat.export') }}";

            if(ids.length) {
                url += "?" + query;
            }

            window.location.href = url;
        }
    },
    {
        extend: 'pdfHtml5',
        text: '📄 {{ __('traduction.pdf') }}',
        className: 'btn btn-danger btn-sm',
        orientation: 'landscape',
        pageSize: 'A4',
        exportOptions: { columns: ':visible' },
        title: "{{ __('traduction.raport') }}",
        messageTop: function() {
            return $('#titreFiltres').text();
        },
        customize: function (doc) {
            doc.defaultStyle.alignment = 'left'; // Aligné à gauche pour la lecture
            doc.styles.tableHeader.alignment = 'left';
        }
    },
    {
                extend: 'print',
                text: '🖨️ {{ __("traduction.imprimer") }}',
                className: 'btn btn-danger btn-sm',
                // 1. On dit à DataTables de NE PAS exporter la colonne "Action"
                exportOptions: {
                    columns: ':not(.no-print)'
                },
                // 2. On ajoute le titre des filtres au-dessus du tableau
                messageTop: function() {
                    return $('#titreFiltres').text();
                },
                title: '', // On vide le titre par défaut pour laisser place au messageTop
                customize: function(win) {
                    let isRTL = $('html').attr('dir') === 'rtl';

                    // 3. Appliquer le style pour réduire la taille et gérer le RTL
                    $(win.document.body)
                        .attr('dir', isRTL ? 'rtl' : 'ltr')
                        .css({
                            'direction': isRTL ? 'rtl' : 'ltr',
                            'text-align': isRTL ? 'right' : 'left',
                            'font-size': '10pt' // Réduction de la taille globale
                        });

                    // 4. Style CSS spécifique pour l'impression (Tableau compact)
                    var style = document.createElement('style');
                    style.innerHTML = `
                        @page { size: landscape; margin: 1cm; }
                        table { width: 100% !important; border-collapse: collapse !important; }
                        th, td {
                            border: 1px solid #ddd !important;
                            padding: 5px !important;
                            font-size: 9pt !important;
                        }
                        .no-print { display: none !important; } /* Sécurité supplémentaire */
                        #titreFiltres {
                            font-size: 12pt;
                            margin-bottom: 20px;
                            font-weight: bold;
                            text-align: center;
                        }
                    `;
                    win.document.head.appendChild(style);

                    // 5. On s'assure que le titre des filtres est bien aligné en Arabe
                    $(win.document.body).find('div').first().css({
                        'text-align': isRTL ? 'right' : 'left',
                        'margin-bottom': '20px'
                    });
                }
            },
    // {
    //     extend: 'print',
    //     text: '🖨️ {{ __('traduction.imprimer') }}',
    //     className: 'btn btn-info btn-sm',
    //     exportOptions: { columns: ':visible' },
    //     title: "", // On vide le titre par défaut pour utiliser le messageTop
    //     messageTop: function() {
    //         return  $('#titreFiltres').text() ;
    //     }
    // },
    {
        text: '🔄 {{ __('traduction.actua') }}',
        className: 'btn btn-secondary btn-sm',
        action: function () {

            // 🔄 Reset recherche globale
            table.search('');

            // 🔄 Reset filtres colonnes
            table.columns().search('');

            // 🔄 Redessiner proprement
            table.draw();

            // 🔄 Vider les inputs (IMPORTANT)
            $('#resultatsTable thead input').val('');

            // 🔄 Réafficher toutes les colonnes
            table.columns().visible(true);

            // 🔄 Reset titre filtres
            $('#titreFiltres').text('');
        }
    },
    {
        text: '➕ {{ __('traduction.ajout') }}',
        className: 'btn btn-primary btn-sm',
        action: function () {
            window.location.href = "{{ route('candidats.create') }}";
        }
    },
    {
        text: '➕ {{ __('traduction.importcandidat') }}',
        className: 'btn btn-primary btn-sm',
        action: function () {
            window.location.href = "{{ route('chargercandidat') }}";
        }
    }

],
        language: {
            lengthMenu: "{{ __('traduction.affiche') }} _MENU_ {{ __('traduction.entr') }}",
            search: "{{ __('traduction.recheglob') }}",
            info: "{{ __('traduction.afficha') }} _START_ {{ __('traduction.a_a') }} _END_ {{ __('traduction.sur') }} _TOTAL_ {{ __('traduction.entr') }}",
            zeroRecords: "{{ __('traduction.aucun') }}",
            infoFiltered: "({{ __('traduction.filt') }} _MAX_ {{ __('traduction.entrtotal') }})",
            loadingRecords: "Chargement...",
            emptyTable: "{{ __('traduction.aucuntab') }}",
            paginate: { previous: "{{ __('traduction.prece') }}", next: "{{ __('traduction.suv') }}" }
        }
    });

    $('#resultatsTable thead tr:eq(1) th').each(function(i) {
    $('input', this).on('keyup change', function(e) { // ✅ ajouter e
        let valeur = this.value.trim();

        table.column(i).search(valeur).draw();

        // ✅ Masquer seulement avec Enter
        if (e.key === "Enter" && valeur !== "") {
            table.column(i).visible(false);
        }

        let filtresActifs = [];

        table.columns().every(function(index) {
            let searchVal = this.search();
            if (searchVal) {
                let nom = $(table.column(index).header()).text().trim();
                // filtresActifs.push(searchVal);
                filtresActifs.push(nom + ": " + searchVal);
            }
        });

        $('#titreFiltres').text(
            filtresActifs.length ? '{{ __('traduction.list') }} ' + filtresActifs.join(' ') : ''
            // filtresActifs.length ? '{{ __('traduction.list') }} ' + filtresActifs.join(' | ') : ''
        );
    });
});

});
</script>

@endsection

