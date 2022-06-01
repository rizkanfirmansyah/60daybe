<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeDetail;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ChallengeController extends Controller
{
    //
    public function index()
    {
        $title = 'Challenge Page';
        return view('contents.dashboard.challenge', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return DataTables::of(Challenge::all())
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
            ->editColumn('image', function ($challenge) {
                return '<img src="/images/' . $challenge->image . '" class="img-fluid" alt="' . $challenge->title . '"/>';
            })
            ->rawColumns(['check', 'action', 'image'])->make(true);
    }

    public function store(Request $request)
    {
        $err = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'estimated' => 'required',
            'day' => 'required',
            'image' => 'mimes:jpg,bmp,png,svg|max:2048',
        ]);

        if ($request->file('images')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('images')->getClientOriginalName());
            // Storage::disk('local')->put($filename,fopen($request->file('images'), 'r+'));
            $request->file('images')->move('images', $filename);
            $request->request->add(['image' => $filename]);
        }

        if ($err->fails()) {
            return response()->json(['message' => 'Data gagal diinput', 'data' => $err->errors()], 500);
        }
        $slug = strtolower(Challenge::all()->count() + 1 . str_replace(' ', '-', $request->name));
        $request->request->add(['slug' => $slug]);
        $request->request->add(['created_by' => 'admin']);
        Challenge::create($request->only(['image', 'title', 'slug', 'description', 'estimated', 'day', 'created_by', 'category', 'level']));
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $request->all()], 200);
    }

    public function destroy(Request $request)
    {
        $data = Challenge::find($request->data);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        if (is_array($request->data)) {
            foreach ($request->data as $value) {
                $data = Challenge::find($value);
                $data->delete();
            }
        } else {
            $data->delete();
        }

        return response()->json(['message' => 'Data berhasil dihapus', 'data' => $data], 200);
    }

    public function edit($id)
    {
        $data = Challenge::find($id);
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
        $data = Challenge::find($id);
        if ($data === null) {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => 'Value not null'], 500);
        }

        $validated = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'estimated' => 'required',
            'day' => 'required',
            'image' => 'mimes:jpg,bmp,png,svg|max:2048',
        ]);

        if ($request->file('images')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('images')->getClientOriginalName());
            // Storage::disk('local')->put($filename,fopen($request->file('images'), 'r+'));
            $request->file('images')->move('images', $filename);
            $request->request->add(['image' => $filename]);
        }

        if ($validated->fails()) {
            return response()->json(['message' => 'Data gagal diperbaharui', 'data' => $validated->errors()], 500);
        }
        $data->update($request->only(['image', 'title', 'slug', 'description', 'estimated', 'day', 'created_by', 'category', 'level']));

        return response()->json(['message' => 'Data berhasil diperbaharui', 'data' => $data], 200);
    }

    public function show()
    {
        $data = [
            "all" => Challenge::all()->count(),
            "trash" => Challenge::onlyTrashed()->count(),
        ];
        return response()->json(['message' => 'Data berhasil diinput', 'data' => $data], 200);
    }

    public function query()
    {
        $challenges = Challenge::all()->take(3);
        if (!empty($_GET['id']) && !empty($_GET['title'])) {
            $data = Challenge::where('id',$_GET['id'])->first();
            $questions = Question::all();
            $datas = ChallengeDetail::where('challenge_id',$_GET['id'])->get();
            return view('contents.pages.detail', compact('data', 'datas', 'questions', 'challenges'));
        }else {
            $data = Challenge::where('title', 'LIKE', '%'.$_GET['search'].'%')->orWhere('description', 'LIKE', '%'.$_GET['search'].'%')->get();
            $questions = Question::all();
            $search = $_GET['search'];
            return view('contents.pages.search', compact('data', 'search', 'challenges', 'questions'));
        }
    }
}
