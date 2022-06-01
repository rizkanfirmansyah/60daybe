<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Section Page';
        return view('contents.pages.section', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return DataTables::of(Section::all())
            ->addColumn('action', function ($section) {
                $category = '
                    <a class="btn btn-sm btn-danger Delete" data-id="' . $section->id . '"><i class="fas fa-trash"></i></a>
                    <a class="btn btn-sm btn-warning Edit" data-id="' . $section->id . '"><i class="fas fa-edit"></i></a>
                    ';
                return $category;
            })
            ->addColumn('check', function ($section) {
                return InputElement('checkbox', $section->id);
            })
            ->editColumn('created_at', function ($section) {
                return FormatDate($section->created_at);
            })
            ->editColumn('status', function ($section) {
                $checked = $section->status == 1 ? 'checked' : '';
                return '<input type="checkbox" class="input-toggle" ' . $checked . ' data-value="' . $section->id . '"> ';
            })
            ->rawColumns(['check', 'action', 'status'])->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $err = Validator::make($request->all(), [
            'name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ]);

        if ($err->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $err->errors()], 500);
        }
        $request->request->add(['created_by' => 'admin']);
        Section::create($request->all());
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = [
            "all" => Section::all()->count(),
            "active" => Section::where("status", "1")->count(),
            "inactive" => Section::where("status", "0")->count(),
            "trash" => Section::onlyTrashed()->count(),
        ];
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $data], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Section::find($id);
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
        $data = Section::find($id);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        $validated = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:sections,name,' . $id,
            'description' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diperbaharui', 'data' => $validated->errors()], 500);
        }

        $data->update($request->all());

        return response()->json(['message' => 'Data berhasil diperbaharui', 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Section::find($request->data);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        if (is_array($request->data)) {
            foreach ($request->data as $value) {
                $data = Section::find($value);
                $data->delete();
            }
        }else{
            $data->delete();
        }

        return response()->json(['message' => 'Data berhasil dihapus', 'data' => $data], 200);
    }

    public function change(Request $request)
    {
        if ($request->value === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }
        $data = Section::find($request->value);
        $data->update(['status' => $data->status == 1 ? '0' : '1']);

        return response()->json(['message' => 'Data berhasil diperbaharui', 'data' => $data], 200);
    }
}
