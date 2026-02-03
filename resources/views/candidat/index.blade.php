@extends('layouts.appespace2')

@section('template_title')
    Candidats
@endsection
@php
    $headers = [
        'numero_table' => __('traduction.matri'),
        'nom' => __('traduction.nom'),
        'prenom' => __('traduction.prenom'),
        'sexe' => __('traduction.sexe'),
        'etablissement_id' => __('traduction.etabli'),
        'centre_id' => __('traduction.centr'),
        'categorie_examen_id' => __('traduction.exame'),
        'anneescolaire_id' => __('traduction.annee'),
    ];
@endphp
@section('content')
    <div class="pc-container">
        <div class="pc-content">
                        <table id="resultatsTable" class="table table-bordered table-striped">
                            <div id="titreFiltres" style="margin-bottom:10px; font-weight:bold;"></div>
                            <thead>
                                <tr>
                                    @foreach($colonnes as $col)
                                        <th>{{ $headers[$col] ?? ucfirst(str_replace('_',' ',$col)) }}</th>
                                    @endforeach
                                        {{-- Colonne Action UNE SEULE FOIS --}}
                                        <th class="no-print">{{ __('traduction.action') }}</th>
                                </tr>
                                <tr>
                                    @foreach($colonnes as $col)
                                        <th> <input type="text" class="form-control form-control-sm column-search" placeholder="{{ __('traduction.reche') }}"></th>
                                    @endforeach
                                    {{-- Pas de recherche pour Action --}}
                                    <th class="no-print"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($candidats as $row)
                                <tr>
                                    @foreach($colonnes as $col)
                                        <td>
                                            @if($col == 'etablissement_id')
                                                {{ $row->nomarabe ?? '-' }}
                                            @elseif($col == 'centre_id')
                                                {{ $row->nomar ?? '-' }}
                                            @elseif($col == 'categorie_examen_id')
                                                {{ $row->libelle ?? '-' }}
                                            @elseif($col == 'anneescolaire_id')
                                                {{ $row->anneefr ?? '-' }}
                                            @else
                                                {{ $row->$col ?? '-' }}
                                            @endif
                                        </td>
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
    {
        extend: 'excelHtml5',
        text: '📊 {{ __('traduction.excel') }}',
        className: 'btn btn-success btn-sm',
        exportOptions: { columns: ':visible' },
        title: function() {
            return ($('#titreFiltres').text() || "Sans filtre");
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
        text: '🖨️ {{ __('traduction.imprimer') }}',
        className: 'btn btn-info btn-sm',
        exportOptions: { columns: ':visible' },
        title: "", // On vide le titre par défaut pour utiliser le messageTop
        messageTop: function() {
            return  $('#titreFiltres').text() ;
        }
    },
    {
        text: '🔄 {{ __('traduction.actua') }}',
        className: 'btn btn-secondary btn-sm',
        action: function () {
            table.search('').columns().search('').draw();
            $('.column-search').val('');
            table.columns().visible(true);
            $('#titreFiltres').text('');
        }
    },
    {
        text: '➕ {{ __('traduction.ajout') }}',
        className: 'btn btn-primary btn-sm',
        action: function () {
            window.location.href = "{{ route('candidats.create') }}";
        }
    }

],
        language: {
            lengthMenu: "{{ __('traduction.affiche') }} _MENU_ {{ __('traduction.entr') }}",
            search: "{{ __('traduction.recheglob') }}",
            info: "{{ __('traduction.afficha') }} _START_ {{ __('traduction.a') }} _END_ {{ __('traduction.sur') }} _TOTAL_ {{ __('traduction.entr') }}",
            zeroRecords: "{{ __('traduction.aucun') }}",
            infoFiltered: "({{ __('traduction.filt') }} _MAX_ {{ __('traduction.entrtotal') }})",
            loadingRecords: "Chargement...",
            emptyTable: "{{ __('traduction.aucuntab') }}",
            paginate: { previous: "{{ __('traduction.prece') }}", next: "{{ __('traduction.suv') }}" }
        }
    });

    $('#resultatsTable thead tr:eq(1) th').each(function(i) {
    $('input', this).on('keyup change', function() {
        let valeur = this.value.trim();

        table.column(i).search(valeur).draw();

        if (valeur !== "") {
            table.column(i).visible(false);
        }

        let filtresActifs = [];

        table.columns().every(function(index) {
            let searchVal = this.search();
            if (searchVal) {
                // SOLUTION : On récupère le texte du header via l'API DataTables
                // header() renvoie l'élément <th> original, même si la colonne est masquée
                let nom = $(table.column(index).header()).text().trim();
                filtresActifs.push(nom + ": " + searchVal);
            }
        });

        $('#titreFiltres').text(
            filtresActifs.length ? ' {{ __('traduction.list') }} ' + filtresActifs.join(' | ') : ''
        );
    });
});

});
</script>

@endsection

