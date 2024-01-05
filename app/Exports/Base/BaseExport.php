<?php

namespace App\Exports\Base;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class BaseExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    public $query;
    public $selectedCols = null;

    public function __construct($query, $cols)
    {
        $this->query = $query;
        $this->selectedCols = $cols;
    }

    public function query()
    {
        return $this->query;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }

    public function headings(): array
    {
        if (!$this->selectedCols) {
            return $this->cols();
        }

        return array_intersect_key($this->cols(), $this->filterSelectedCols());
    }

    abstract public function cols(): array;

    public function map($row): array
    {
        if (!$this->selectedCols) {
            return $this->data($row);

        }

        return array_intersect_key($this->data($row), $this->filterSelectedCols());
    }

    abstract public function data($row): array;

    private function filterSelectedCols(): array
    {
        return array_filter($this->selectedCols, function ($value) {
            return $value === true;
        });
    }
}
