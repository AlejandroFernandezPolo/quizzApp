@extends('app.base')

@section('content')
<div class="container">
    <h2>Create Answers for {{ $question->question }}</h2>

    <form method="post" action="{{ url('answer') }}">
        @csrf

        <div class="mb-3">
            <label for="num_answers">Number of Answers</label>
            <select class="form-select" id="num_answers" name="num_answers" required>
                @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ old('num_answers') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
            </select>

        </div>

        <div id="answer-section">
            @for ($i = 1; $i <= old('num_answers', 1); $i++) 
            <div class="mb-3">
                <label for="answer{{ $i }}">Answer {{ $i }}</label>
                <input type="text" class="form-control" id="answer{{ $i }}" name="answers[]" required value="{{ old('answers.' . ($i-1)) }}">
            </div>
            @endfor

            <div class="mb-3">
                <label for="correct_answer">Correct Answer</label>
                <select class="form-select" id="correct_answer" name="correct_answer" required>
                    <option value="" disabled selected>Select Correct Answer</option>
                    <option value="none" {{ old('correct_answer') == 'none' ? 'selected' : '' }}>No one is correct</option>
                    @for ($i = 1; $i <= old('num_answers', 1); $i++) <option value="{{ $i }}" {{ old('correct_answer') == $i ? 'selected' : '' }}>Answer {{ $i }}</option>
                        @endfor
                </select>
            </div>
        </div>

        <div>
            <input type="hidden" name="idquestion" value="{{ $idquestion }}">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#num_answers').change(function() {
            var numAnswers = $(this).val();
            var answerSection = $('#answer-section');

            // Limpiar campos existentes
            answerSection.empty();

            // Generar campos de respuestas
            for (var i = 1; i <= numAnswers; i++) {
                var answerField = '<div class="mb-3">' +
                    '<label for="answer' + i + '">Answer ' + i + '</label>' +
                    '<input type="text" class="form-control" id="answer' + i + '" name="answers[]" required>' +
                    '</div>';

                answerSection.append(answerField);
            }

            // Campo para seleccionar la respuesta correcta
            var correctField = '<div class="mb-3">' +
                '<label for="correct_answer">Correct Answer</label>' +
                '<select class="form-select" id="correct_answer" name="correct_answer" required>' +
                '<option value="" disabled selected>Select Correct Answer</option>' +
                '<option value="none">No one is correct</option>';

            for (var i = 1; i <= numAnswers; i++) {
                correctField += '<option value="' + i + '">Answer ' + i + '</option>';
            }

            correctField += '</select></div>';

            answerSection.append(correctField);
        });
    });
</script>

@endsection