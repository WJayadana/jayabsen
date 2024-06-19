<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiSiswaExcel implements FromView, WithStyles, WithEvents
{
    protected $absensis, $startDate, $endDate, $siswa;

    public function __construct($absensis, $startDate, $endDate, $siswa)
    {
        $this->absensis = $absensis;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->siswa = $siswa;
    }

    public function view(): View
    {
        return view('website.report.report_siswa_excel', [
            'absensis' => $this->absensis,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'siswa' => $this->siswa,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Menerapkan gaya batas pada seluruh tabel
        $sheet->getStyle('A10:E' . (count($this->absensis) + 9))
              ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A10:E' . (count($this->absensis) + 9); // Mulai dari baris 10 hingga baris terakhir
                $event->sheet->getDelegate()->getStyle($cellRange)
                              ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            },
        ];
    }
}
