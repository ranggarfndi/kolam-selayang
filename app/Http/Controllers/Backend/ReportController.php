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
        // Default filter: 7 hari terakhir jika tidak ada input
        $startDate = $request->input('start_date', Carbon::today()->subDays(6)->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        $reports = $this->getReportData($startDate, $endDate);

        // Kalkulasi Total untuk Summary
        $totalVisitors = $reports->sum('total_visitors');
        $totalRevenue = $reports->sum('total_revenue');

        return view('backend.reports.index', compact('reports', 'startDate', 'endDate', 'totalVisitors', 'totalRevenue'));
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $reports = $this->getReportData($startDate, $endDate);

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

            // Tambahkan baris total di bawah
            fputcsv($file, ['', '', '']);
            fputcsv($file, ['TOTAL KESELURUHAN', $reports->sum('total_visitors'), $reports->sum('total_revenue')]);
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    // Fungsi helper agar query tidak diulang
    private function getReportData($startDate, $endDate)
    {
        return VisitorLog::selectRaw('DATE(created_at) as date, SUM(quantity) as total_visitors, SUM(total_price) as total_revenue')
            ->where('type', 'in') // Hanya hitung yang masuk untuk laporan ini
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
    }
}