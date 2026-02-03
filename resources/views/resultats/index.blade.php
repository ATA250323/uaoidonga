@extends('layouts.appespace2')
<style>
/* Masquer la ligne des filtres */
/* thead tr:nth-child(2) {
    display: none;
} */

/* Ne jamais afficher les inputs à l'impression */
@media print {
    .column-search {
        display: none !important;
    }
}
</style>

@section('content')
    <div class="pc-container">
        <div class="pc-content">
                        <table id="resultatsTable" class="table table-bordered table-striped">
                            <div id="titreFiltres" style="margin-bottom:10px; font-weight:bold;"></div>
                            <thead>
                                <tr>
                                    @foreach($colonnes as $col)
                                    <th>
                                        @if($col == 'matricule')
                                            {{ __('traduction.matri') }}
                                        @elseif($col == 'nom')
                                            {{ __('traduction.nom') }}
                                        @elseif($col == 'prenom')
                                            {{ __('traduction.prenom') }}
                                        @elseif($col == 'sexe')
                                            {{ __('traduction.sexe') }}
                                        @elseif($col == 'etablissement')
                                            {{ __('traduction.etabli') }}
                                        @elseif($col == 'centre')
                                            {{ __('traduction.centre_id') }}
                                        @elseif($col == 'examen')
                                            {{ __('traduction.exam') }}
                                        @elseif($col == 'annee')
                                            {{ __('traduction.annee') }}
                                        @else
                                            {{ ucfirst(str_replace('_',' ',$col)) }}
                                        @endif
                                    </th>
                                    @endforeach
                                    {{-- @foreach($colonnes as $col)
                                        <th>{{ ucfirst(str_replace('_',' ',$col)) }}</th>
                                    @endforeach --}}
                                </tr>
                                <tr>
                                    @foreach($colonnes as $col)
                                        <th>
                                            <input type="text"
                                                class="form-control form-control-sm column-search"
                                                placeholder="{{ __('traduction.reche') }}">
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultats as $row)
                                    <tr>
                                        @foreach($colonnes as $col)
                                        <td>
                                            @php
                                                $statuts = [
                                                    __('traduction.admis')   => 'bg-success',
                                                    __('traduction.admise')  => 'bg-success',
                                                    __('traduction.refuse')  => 'bg-danger',
                                                    __('traduction.refusee') => 'bg-danger',
                                                ];
                                                $valeur = $row->$col ?? null;
                                            @endphp

                                            @if(isset($statuts[$valeur]))
                                                <span class="badge fs-6 px-4 py-2 {{ $statuts[$valeur] }}">
                                                    {{ $valeur }}
                                                </span>
                                            @else
                                                {{ $valeur ?? '-' }}
                                            @endif

                                        </td>
                                        @endforeach
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
        text: '➕ {{ __('traduction.import') }}',
        className: 'btn btn-primary btn-sm',
        action: function () {
            window.location.href = "{{ route('charger') }}";
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
            filtresActifs.length ? '{{ __('traduction.list') }}' + filtresActifs.join(' | ') : ''
        );
    });
});

});
</script>

@endsection
