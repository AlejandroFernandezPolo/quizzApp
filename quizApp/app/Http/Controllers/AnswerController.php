<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all(); // Eloquent
        return view('answer.index', ['answers' => $answers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->createQuestion($request, $request->idquestion);
    }

    function createQuestion(Request $request, $idquestion)
    {
        if ($idquestion == null) {
            return back();
        }
        $question = Question::find($idquestion);
        if ($question == null) {
            return back();
        }
        $questions = Question::pluck('question', 'id');
        return view('answer.create', ['questions' => $questions, 'idquestion' => $idquestion, 'question' => $question]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // Get data from the form
            $answersData = $request->only('answers', 'correct_answer', 'idquestion');
            $answers = $answersData['answers'];

            // Check if there is already a correct answer for the question
            $existingCorrectAnswer = Answer::where('idquestion', $answersData['idquestion'])
                ->where('correct', 1)
                ->first();

            // Check if the answer being added is correct and there is already an existing correct answer
            if ($existingCorrectAnswer && $answersData['correct_answer'] != 'none') {
                return back()->withInput()->withErrors(['message' => 'There is already a correct answer for this question.']);
            }

            // Allow the creation of answers even if there is already a correct answer
            // If there is a correct answer, simply overwrite its correct value
            foreach ($answers as $key => $answerText) {
                $isCorrect = $key + 1 == $answersData['correct_answer'];

                $answer = new Answer([
                    'answer' => $answerText,
                    'correct' => $isCorrect,
                    'idquestion' => $answersData['idquestion'],
                ]);
                $answer->save();
            }

            return redirect('question/' . $answersData['idquestion'])->with(['message' => 'The answers have been saved successfully.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'There was an error saving the answers.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        try {
            $answer->delete();
            return back()->with(['message' => 'The answer has been deleted.']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['message' => 'The answer has not been deleted.']);
        }
    }

    public function deleteAllAnswers($questionId)
    {
        try {
            Answer::where('idquestion', $questionId)->delete();

            return redirect()->back()->with(['message' => 'All answers have been deleted.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Failed to delete answers.']);
        }
    }
}
