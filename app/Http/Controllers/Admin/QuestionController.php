<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::latest('id')->get();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $question = Question::create([
                'title' => $request->title,
                'exam_id' => $request->exam_id,
            ]);

            foreach($request->answers as $ans) {
                $question->answers()->create([
                    'content' => $ans['answer'],
                    'is_correct' => $ans['correct']??0,
                ]);
            }

            DB::commit();
        }catch(Exception $e) {
            DB::rollback();

            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.questions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
