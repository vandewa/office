<?php

namespace App\Livewire\Chart;

use App\Models\Sppd;
use App\Models\SuratMasuk;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class SuratMasukChart extends Component
{
    public $selectedYear; // Property untuk tahun yang dipilih
    public $firstRun = true;
    public $showDataLabels = false;


    public function render()
    {

        $years = SuratMasuk::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Daftar lengkap bulan dalam bahasa Indonesia
        $months = collect([
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ]);

        // Default ke tahun saat ini jika belum ada pilihan tahun
        $selectedYear = $this->selectedYear ?? now()->year;

        // Ambil data dari database
        $jingan = DB::table('surat_masuks')
            ->where('kdunit', auth()->user()->kdunit)
            ->selectRaw('MONTHNAME(MAX(created_at)) as month, COUNT(*) as total_sppds')
            ->whereYear('created_at', $selectedYear)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        // Siapkan data untuk grafik dengan menggabungkan hasil database dengan semua bulan
        $data = $months->map(function ($month, $index) use ($jingan) {
            $record = $jingan->firstWhere('month', $this->getEnglishMonthName($index + 1)); // Konversi indeks bulan ke nama bulan Inggris
            return [
                'month' => $month,
                'total_sppds' => $record ? $record->total_sppds : 0
            ];
        });

        //total data
        $total = DB::table('surat_masuks')
            ->where('kdunit', auth()->user()->kdunit)
            ->whereYear('created_at', $selectedYear)
            ->count();

        // Bangun model grafik
        $columnChartModel = $data->reduce(
            function ($columnChartModel, $data) {
                $type = $data['month'];
                $value = $data['total_sppds'];

                return $columnChartModel->addColumn($type, $value, '#017bfe');
            },
            LivewireCharts::columnChartModel()
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors([
                    '#b01a1b',  // Merah Tua
                    '#d41b2c',  // Merah Sedang
                    '#ec3c3b',  // Merah Terang
                    '#f66665',  // Merah Pastel
                    '#f8a488',  // Oranye Pastel
                    '#ffcb8e',  // Kuning Pastel
                    '#ffd77f',  // Kuning Lemon
                    '#b5e48c',  // Hijau Pastel
                    '#52b788',  // Hijau Sedang
                    '#76c893',  // Hijau Terang
                    '#57a0d3',  // Biru Sedang
                    '#4d8dc2',  // Biru Laut
                ])
                ->setColumnWidth(90)
        );

        return view('livewire.chart.surat-masuk-chart', [
            'columnChartModel' => $columnChartModel,
            'years' => $years,
            'total' => $total,
        ]);
    }

    // Fungsi untuk mendapatkan nama bulan dalam bahasa Inggris berdasarkan indeks
    private function getEnglishMonthName($monthNumber)
    {
        $englishMonths = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        return $englishMonths[$monthNumber] ?? null;
    }



}
