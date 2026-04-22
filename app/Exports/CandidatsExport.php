<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class CandidatsExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    protected $query;
    protected $visibleCols;

    public function __construct($query, $visibleCols = [])
    {
        $this->query = $query;
        $this->visibleCols = $visibleCols;
    }

    public function collection()
    {
        return $this->query->get(); // ✅ récupère les données filtrées par ID
    }

    public function map($candidat): array
    {
        // toutes les colonnes
        $all = [
            $candidat->numero_table ?? '' ,
            $candidat->nom ?? '' ,
            $candidat->sexe ?? '' ,
            $candidat->etablissement->nomarabe ?? '' ,
            $candidat->centre->nomar ?? '' ,
            $candidat->categoriesExamen->libelle ?? '' ,
		    app()->getLocale() === 'ar' ? $candidat->anneescolaire->anneear : $candidat->anneescolaire->anneefr,
        ];

        // ne retourner que les colonnes visibles
        if(!empty($this->visibleCols)) {
            $filtered = [];
            foreach($this->visibleCols as $i) {
                if(isset($all[$i])) $filtered[] = $all[$i];
            }
            return $filtered;
        }

        return $all;
    }

    public function headings(): array
    {
        $all = [
            __('traduction.matri'),
            __('traduction.noms'),
            __('traduction.sexe'),
            __('traduction.etabli'),
            __('traduction.centr'),
			__('traduction.exame'),
            __('traduction.annee'),
        ];

        if(!empty($this->visibleCols)) {
            $filtered = [];
            foreach($this->visibleCols as $i) {
                if(isset($all[$i])) $filtered[] = $all[$i];
            }
            return $filtered;
        }

        return $all;
    }

    public function styles(Worksheet $sheet)
    {
        // ✅ RTL seulement si arabe
        if (app()->getLocale() === 'ar') {
            $sheet->setRightToLeft(true);
        } else {
            $sheet->setRightToLeft(false);
        }

        // Police
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getFont()->setName('Tahoma')->setSize(11);

        // En-têtes en gras
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
    }
}

