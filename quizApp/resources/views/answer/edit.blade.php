@extends('app.base')

@section('title', 'Phone Create')

@section('content')

@include('modal.deletequestion')

<form action="{{ url('question/' . $question->id) }}" method="post">

    <!-- Solución de error por CSRF -->
    <!--<input type="hidden" name="_method" value="post">-->
    <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
    @method('put')
    @csrf

    <!-- Inputs del formulario -->
    
    <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" id="question" name="question" maxlength="200" required value="{{ old('question', $question->question) }}">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <button id="deleteButton" data-url="{{ url('question/' . $question->id) }}" data-name="{{ $question->question }}" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
        Link to delete v3
    </button>
                

</form>

<script>
    // //solucion3
     const deleteQuestionModal = document.getElementById('deleteQuestionModal');
     const questionQuestion = document.getElementById('questionQuestion');
     const formDelete = document.getElementById('formDelete');
     deleteQuestionModal.addEventListener('show.bs.modal', event => {
         questionQuestion.innerHTML = event.relatedTarget.dataset.name;
         formDelete.action = event.relatedTarget.dataset.url;
     });
</script>
@endsection