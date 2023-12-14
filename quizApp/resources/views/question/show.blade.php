@extends('app.base')
@section('title', 'Question Show')

@section('content')
@include('modal.deletequestion')
@include('modal.deleteanswer')
@include('modal.deleteallanswers')

<div class="table-responsive small">
    <h3>Question</h3>
    <table class="table table-striped table-sm">
        <tbody>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Actions</td>
            </tr>
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->question }}</td>
                <td>
                    <button id="deleteButton" data-url="{{ url('question/' . $question->id) }}" data-name="{{ $question->question }}" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
                        Delete question
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <a class="btn-danger btn" href="{{ url('question/' . $question->id . '/edit') }}">Edit question</a>
</div>
<br>
<br>

<div class="table-responsive small">
    <h3>Possible Answers</h3>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Answer</th>
                <th>Is Correct</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($question->answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ $answer->answer }}</td>
                <td>{{ $answer->correct ? 'Yes' : 'No' }}</td>
                <td>
                    <button data-url="{{ url('answer/' . $answer->id) }}" data-name="{{ $answer->answer }}" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal">
                        Delete Answer
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<button id="deleteAllAnswers" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllAnswersModal">Delete All Answers</button>
<a class="btn btn-success" href="{{ url('answer/create?idquestion=' . $question->id) }}">Add Answers</a>

<script>
    const deleteQuestionModal = document.getElementById('deleteQuestionModal');
    const questionQuestion = document.getElementById('questionQuestion');
    const formDelete = document.getElementById('formDelete');
    deleteQuestionModal.addEventListener('show.bs.modal', event => {
        questionQuestion.innerHTML = event.relatedTarget.dataset.name;
        formDelete.action = event.relatedTarget.dataset.url;
    });

    // Listener para el modal de eliminación de respuestas
    const deleteAnswerModal = document.getElementById('deleteAnswerModal');
    const answerName = document.getElementById('answerName');
    const formDeleteAnswer = document.getElementById('formDeleteAnswer');
    deleteAnswerModal.addEventListener('show.bs.modal', event => {
        answerName.innerHTML = event.relatedTarget.dataset.name;
        formDeleteAnswer.action = event.relatedTarget.dataset.url;
    });

    const deleteAllAnswersButton = document.getElementById('deleteAllAnswers');
    const deleteAllAnswersModal = document.getElementById('deleteAllAnswersModal');
    const formDeleteAllAnswers = document.getElementById('formDeleteAllAnswers');

    deleteAllAnswersButton.addEventListener('click', () => {
        deleteAllAnswersModal.classList.add('show');
    });

    deleteAllAnswersModal.addEventListener('show.bs.modal', event => {
        formDeleteAllAnswers.action = '{{ url("question/$question->id/delete-answers") }}';
    });

    deleteAllAnswersModal.addEventListener('hidden.bs.modal', event => {
        formDeleteAllAnswers.action = ''; // Limpia la acción para evitar envíos accidentales
    });
</script>
@endsection