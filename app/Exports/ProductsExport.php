<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;      
use Maatwebsite\Excel\Concerns\ShouldAutoSize;  
use Maatwebsite\Excel\Events\AfterSheet;        
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;    
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ProductsExport implements FromCollection, WithHeadings, WithTitle, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    /**
    * Ini HANYA untuk header tabelnya saja.
    * Judul laporan akan kita buat di registerEvents().
    */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Unit',
            'Category',
            'Description',
            'Stock',
            'Supplier',
            'Created At',
            'Updated At',
        ];
    }

    public function title(): string
    {
        return 'Laporan Data Produk'; 
    }

    /**
    * Fungsi utama untuk styling dan menambah judul
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
            $sheet = $event->sheet->getDelegate();
            $sheet->insertNewRowBefore(1, 3); // tambah 3 baris untuk judul

            $totalColumns = count($this->headings());
            $lastColumn = Coordinate::stringFromColumnIndex($totalColumns);

            // Judul
            $sheet->setCellValue('A1', 'PT. Mondar Mandir');
            $sheet->setCellValue('A2', 'Rekap Mutasi Stok Bulanan');
            $sheet->setCellValue('A3', 'Periode: ' . now()->format('F Y'));
            $sheet->mergeCells("A1:{$lastColumn}1");
            $sheet->mergeCells("A2:{$lastColumn}2");
            $sheet->mergeCells("A3:{$lastColumn}3");
            $sheet->getStyle('A1:A3')->getFont()->setBold(true);
            $sheet->getStyle('A1')->getFont()->setSize(16);
            $sheet->getStyle('A2')->getFont()->setSize(14);
            $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Styling header tabel
            $sheet->getStyle("A4:{$lastColumn}4")->getFont()->setBold(true);
            $sheet->getStyle("A4:{$lastColumn}4")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("A4:{$lastColumn}4")->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('DDEBF7');

            // Border seluruh tabel
            $totalRows = count($this->collection()) + 4;
            $range = "A4:{$lastColumn}{$totalRows}";
            $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }
}