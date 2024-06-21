<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu\Report;
use App\Models\Menu\ReportNews;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SikatController extends Controller
{
    public function store(Request $request)
    {
        $reportForm = $request->input('report');
        $reportForm['reportBy'] = session()->get('user')->id;

        $evidence = $request->file('evidence');

        DB::beginTransaction();
        try {
            // Capture the created report instance
            $report = Report::create([
                'crimeType'   => $reportForm['crime_type'],
                'reportBy'    => $reportForm['reportBy'],
                'location'    => $reportForm['location'],
                'description' => $reportForm['description'],
                'date'        => $reportForm['date'],
            ]);

            // Commit the transaction
            DB::commit();

            // Retrieve the ID of the created report
            $reportId     = $report->id;
            $evidenceName = uniqid('evidence_') . $evidence->getClientOriginalName();
            $evidence->storeAs('crime', $evidenceName, 'public_assets');

            ReportNews::create([
                'reportId' => $reportId,
                'fileName' => $evidenceName,
                'fileType' => $evidence->getClientOriginalExtension()
            ]);

            return redirect()->to('/menu#sikat')->with('success', 'Pengaduan kasus kriminal berhasil');
        } catch (Exception $error) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return redirect()->to('/menu#sikat')->with('error', 'Pengaduan kasus kriminal gagal, coba lagi');
        }
    }
}
