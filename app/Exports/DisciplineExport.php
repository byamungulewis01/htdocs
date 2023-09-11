<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DisciplineExport implements FromCollection , WithHeadings
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
               'No', 'Case Number,', 'Complaint Subject', 'Plaintiff Names', 'Plaintiff Email', 'Plaintiff Phone', 'Defendant Names', 'Defendant email', 'Defendant Phone','Authority', 'Case Status', 'Complaints Summary', 'Desicion'
            ];
        }

}

