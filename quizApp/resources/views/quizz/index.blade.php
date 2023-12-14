@extends('app.base')
@section('content')
<div class="container">
        <h2>How many questions do you want your quiz to have?</h2>
        <form method="get" action="{{ url('quizz/start') }}">
            <div class="mb-3">
                <label for="num_questions"></label>
                <select class="form-select" id="num_questions" name="num_questions" required>
                    @for ($i = 1; $i <= $maxQuestions; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Start Quizz</button>
        </form>
        </div>
@endsection
