<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ChallengeDetailController extends Controller
{
    //
    public function index()
    {
        $title = 'Challenge Detail Page';
        $challenge = Challenge::all();
        return view('contents.dashboard.challenge-detail', compact('title', 'challenge'));
    }

    public function show()
    {
        $data = [
            "all" => ChallengeDetail::all()->count(),
            "trash" => ChallengeDetail::onlyTrashed()->count(),
        ];
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return DataTables::of(ChallengeDetail::all())
            ->addColumn('action', function ($challenge) {
                $category = '
                    <a class="btn btn-sm btn-danger Delete" data-id="' . $challenge->id . '"><i class="fas fa-trash"></i></a>
                    <a class="btn btn-sm btn-warning Edit" data-id="' . $challenge->id . '"><i class="fas fa-edit"></i></a>
                    ';
                return $category;
            })
            ->addColumn('check', function ($challenge) {
                return InputElement('checkbox', $challenge->id);
            })
            ->editColumn('created_at', function ($challenge) {
                return FormatDate($challenge->created_at);
            })
            ->rawColumns(['check', 'action', 'image'])->make(true);
    }

    public function store(Request $request)
    {
        $err = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'challenge_id' => 'required',
        ]);


        if ($err->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $err->errors()], 500);
        }
        $request->request->add(['created_by' => 'admin']);
        ChallengeDetail::create($request->only(['title', 'description', 'estimated', 'created_by', 'challenge_id']));
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $request->all()], 200);
    }

    public function destroy(Request $request)
    {
        $data = ChallengeDetail::find($request->data);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        if (is_array($request->data)) {
            foreach ($request->data as $value) {
                $data = ChallengeDetail::find($value);
                $data->delete();
            }
        } else {
            $data->delete();
        }

        return response()->json(['message' => 'Data berhasil dihapus', 'data' => $data], 200);
    }

    public function edit($id)
    {
        $data = ChallengeDetail::find($id);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        return response()->json(['message' => 'Data ditemukan', 'data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ChallengeDetail::find($id);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        $validated = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'estimated' => 'required',
            'image' => 'mimes:jpg,bmp,png,svg|max:2048',
        ]);


        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diperbaharui', 'data' => $validated->errors()], 500);
        }

        $data->update($request->only(['title', 'description', 'estimated', 'created_by', 'challenge_id']));

        return response()->json(['message' => 'Data berhasil diperbaharui', 'data' => $data], 200);
    }
}
