<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiDateExport implements FromView
{
    protected $absensis, $date;

    public function __construct($absensis, $date)
    {
        $this->absensis = $absensis;
        $this->date = $date;
    }

    public function view(): View
    {
        return view('website.report.report_data_excel', [
            'absensis' => $this->absensis,
            'date' => $this->date
        ]);
    }
}
