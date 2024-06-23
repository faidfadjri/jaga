<?php

namespace App\Http\Controllers;

use App\Models\Auth\Users;
use App\Models\Menu\Record;
use App\Models\Menu\Report;
use App\Models\Menu\ReportNews;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        session()->put('active', 'home');
        return view('pages.index');
    }

    public function about()
    {
        session()->put('active', 'about');
        return view('pages.about');
    }

    public function record(Request $request)
    {

        $records = Users::with(['attachment', 'crimes']);

        $keyword = $request->input('search') ?? null;
        $records->where("username", "like", "%$keyword%")->orWhere("email", "like", "%$keyword%");

        session()->put('active', 'record');

        return view('pages.admin.record', [
            'records' => $records->paginate(4)
        ]);
    }

    public function detailRecord(Request $request)
    {
        $userId = $request->input('user_id');
        if (!$userId) return response()->json([
            'message' => 'user id not found',
            'error'   => 'NOT_FOUND'
        ], 404);

        $records = Users::with(['crimes'])->find($userId);
        return response()->json([
            'records' => $records,
            'message' => 'Getting record data succeed'
        ], 200);
    }

    public function addRecord(Request $request)
    {
        try {
            $record = $request->input('record');
            $record['userId'] = $request->input('user_id');

            Record::create([
                'userId'        => $record['userId'],
                'crimeType'     => $record['category'],
                'description'   => $record['description'],
                'date'          => $record['date'],
                'location'      => $record['location']
            ]);

            return response()->json($record);
        } catch (Exception $err) {
            return response()->json([
                'message' => $err->getMessage()
            ], 500);
        }
    }

    public function deleteRecord($recordId)
    {
        try {
            $record = Record::find($recordId);
            $userId = $record->userId;

            $record->delete();
            return response()->json([
                'userId' => $userId
            ]);
        } catch (Exception $err) {
            return response()->json([
                'message' => $err->getMessage()
            ], 500);
        }
    }

    public function report()
    {


        $reports = Report::with(['pelapor', 'news']);
        session()->put('active', 'report');

        // dd($reports->first()->toArray());

        return view('pages.admin.report', [
            'reports' => $reports->paginate(4)
        ]);
    }

    public function reportVerification(Request $request)
    {

        // Retrieve inputs from the request
        $reportId = $request->input('reportId');
        $verification = $request->input('verification');
        $news = $request->file('news');

        // Find the report
        $report = Report::find($reportId);

        // Check if there is existing news
        $existingNews = ReportNews::where('reportId', $reportId)->first();

        // Delete existing news if it exists
        if ($existingNews) {
            // Delete the associated file
            Storage::disk('public_assets')->delete('news/' . $existingNews->fileName);

            // Delete the existing news record
            $existingNews->delete();
        }

        // Store new news file
        $newsName = uniqid('avatar_') . '.' . $news->getClientOriginalExtension();
        $news->storeAs('news', $newsName, 'public_assets');

        // Create a new ReportNews record
        ReportNews::create([
            'reportId' => $reportId,
            'fileName' => $newsName,
            'fileType' => $news->getClientOriginalExtension()
        ]);

        // Update the status of the report based on verification
        $report->update(['status' => $verification == "Benar" ? "Verified" : "Rejected"]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Proses verifikasi kasus berhasil');
    }


    public function user()
    {
        session()->put('active', 'user');
        return view('pages.admin.user');
    }
}
