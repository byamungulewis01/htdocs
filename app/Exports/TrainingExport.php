<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TrainingExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }
    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Email',
            'Mobile Number',
            'Status',
            'Credit',
            'Price',
        ];
    }
}
