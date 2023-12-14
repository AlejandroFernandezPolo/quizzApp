@extends('app.base')

@section('title', 'Phone Create')

@section('content')

@include('modal.deleteanswer')

<form action="{{ url('answer/' . $answer->id) }}" method="post">
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="answer" class="form-label">Answer</label>
        <input type="text" class="form-control" id="answer" name="answer" maxlength="200" required value="{{ old('answer', $answer->answer) }}">
    </div>
    <div class="mb-3">
        <label for="correct">Is correct ?</label>
        <select class="form-select" id="correct" name="correct" required>
            <option value="1" {{ $answer->correct == '1' ? 'selected' : '' }} >Yes</option>
            <option value="0" {{ $answer->correct == '0' ? 'selected' : '' }} >No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <button data-url="{{ url('answer/' . $answer->id) }}" data-name="{{ $answer->answer }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal">
        Delete Answer
    </button>


</form>

<script>
    // Listener para el modal de eliminación de respuestas
    const deleteAnswerModal = document.getElementById('deleteAnswerModal');
    const answerName = document.getElementById('answerName');
    const formDeleteAnswer = document.getElementById('formDeleteAnswer');
    deleteAnswerModal.addEventListener('show.bs.modal', event => {
        answerName.innerHTML = event.relatedTarget.dataset.name;
        formDeleteAnswer.action = event.relatedTarget.dataset.url;
    });
</script>
@endsection