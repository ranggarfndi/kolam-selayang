<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Default filter
        $startDate = $request->input('start_date', Carbon::today()->subDays(6)->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        // 2. Ambil data mentah untuk SUMMARY (Semua data dalam range tanpa paginate)
        $rawReports = $this->getReportData($startDate, $endDate)->get();
        $totalVisitors = $rawReports->sum('total_visitors');
        $totalRevenue = $rawReports->sum('total_revenue');

        // 3. Ambil data untuk TABEL (Dengan Paginate)
        // Kita gunakan 10 atau 31 (sebulan) agar rapi
        $reports = $this->getReportData($startDate, $endDate)->paginate(15)->withQueryString();

        return view('backend.reports.index', compact('reports', 'startDate', 'endDate', 'totalVisitors', 'totalRevenue'));
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Untuk ekspor, kita ambil SEMUA data (get)
        $reports = $this->getReportData($startDate, $endDate)->get();

        $fileName = "laporan-kolam-selayang-{$startDate}-sd-{$endDate}.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Tanggal', 'Total Pengunjung Masuk', 'Total Pendapatan (Rp)'];

        $callback = function() use($reports, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reports as $row) {
                fputcsv($file, [
                    Carbon::parse($row->date)->translatedFormat('d F Y'),
                    $row->total_visitors,
                    $row->total_revenue
                ]);
            }

            fputcsv($file, ['', '', '']);
            fputcsv($file, ['TOTAL KESELURUHAN', $reports->sum('total_visitors'), $reports->sum('total_revenue')]);
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    // Helper diubah agar mengembalikan Query Builder (tanpa ->get() di akhir)
    private function getReportData($startDate, $endDate)
    {
        return VisitorLog::selectRaw('DATE(created_at) as date, SUM(quantity) as total_visitors, SUM(total_price) as total_revenue')
            ->where('type', 'in')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('date')
            ->orderBy('date', 'desc');
    }
}