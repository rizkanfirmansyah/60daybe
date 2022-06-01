<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    //
    public function index()
    {
        $title = 'question Page';
        return view('contents.dashboard.question', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return DataTables::of(Question::all())
            ->addColumn('action', function ($question) {
                $category = '
                    <a class="btn btn-sm btn-danger Delete" data-id="' . $question->id . '"><i class="fas fa-trash"></i></a>
                    <a class="btn btn-sm btn-warning Edit" data-id="' . $question->id . '"><i class="fas fa-edit"></i></a>
                    ';
                return $category;
            })
            ->addColumn('check', function ($question) {
                return InputElement('checkbox', $question->id);
            })
            ->editColumn('created_at', function ($question) {
                return FormatDate($question->created_at);
            })
            ->rawColumns(['check', 'action', 'image'])->make(true);
    }

    public function store(Request $request)
    {
        $err = Validator::make($request->all(), [
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        if ($err->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $err->errors()], 500);
        }
        $request->request->add(['created_by' => 'admin']);
        Question::create($request->all());
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $request->all()], 200);
    }

    public function destroy(Request $request)
    {
        $data = Question::find($request->data);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        if (is_array($request->data)) {
            foreach ($request->data as $value) {
                $data = Question::find($value);
                $data->delete();
            }
        } else {
            $data->delete();
        }

        return response()->json(['message' => 'Data berhasil dihapus', 'data' => $data], 200);
    }

    public function edit($id)
    {
        $data = Question::find($id);
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
        $data = Question::find($id);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        $err = Validator::make($request->all(), [
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        if ($err->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $err->errors()], 500);
        }
        $request->request->add(['created_by' => 'admin']);
        $data->update($request->all());

        return response()->json(['message' => 'Data berhasil diperbaharui', 'data' => $data], 200);
    }

    public function show()
    {
        $data = [
            "all" => Question::all()->count(),
            "trash" => Question::onlyTrashed()->count(),
        ];
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $data], 200);
    }

}
