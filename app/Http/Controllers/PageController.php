<?php

namespace App\Http\Controllers;

use App\Models\Auth\Users;
use App\Models\Menu\Record;
use Exception;
use Illuminate\Http\Request;

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
        session()->put('active', 'report');
        return view('pages.admin.report');
    }

    public function user()
    {
        session()->put('active', 'user');
        return view('pages.admin.user');
    }
}
