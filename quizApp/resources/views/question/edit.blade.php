@extends('app.base')

@section('title', 'Phone Create')

@section('content')

@include('modal.deletequestion')
<div class="container">
<form action="{{ url('question/' . $question->id) }}" method="post">

    @method('put')
    @csrf
    
    <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" id="question" name="question" maxlength="200" required value="{{ old('question', $question->question) }}">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <button id="deleteButton" data-url="{{ url('question/' . $question->id) }}" data-name="{{ $question->question }}" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
        Delete
    </button>

</form>
</div>

<script>
     const deleteQuestionModal = document.getElementById('deleteQuestionModal');
     const questionQuestion = document.getElementById('questionQuestion');
     const formDelete = document.getElementById('formDelete');
     deleteQuestionModal.addEventListener('show.bs.modal', event => {
         questionQuestion.innerHTML = event.relatedTarget.dataset.name;
         formDelete.action = event.relatedTarget.dataset.url;
     });
</script>
@endsection