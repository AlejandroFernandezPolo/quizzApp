<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $questions = Question::all();//eloquent
        return view('question.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try{
            $question = Question::create($request ->all());
            return redirect('answer/create?idquestion=' . $question->id) -> with(['message' => 'The question has been saved, now you can create answers.']);
        } catch(\Exception $e) {
            return back() ->withInput() -> withErrors(['message' => 'The question has not been saved.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question) {
        return view('question.show', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question) {
        return view('question.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question) {
        try{
            $result = $question->update($request->all());
            return redirect('question') -> with(['message' => 'The question has been updated.']);
        } catch(\Exception $e) {
            return back() ->withInput() -> withErrors(['message' => 'The question has not been updated.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question) {
        try {
            $question->delete();
            return redirect('question')->with(['message' => 'The question has been deleted.']);
        } catch(\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['message' => 'The question has not been deleted.']);
        }
    }
}
