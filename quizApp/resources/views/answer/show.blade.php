@extends('app.base')
@section('title', 'Phone Show')

@section('content')

@include('modal.deletequestion')

<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <tbody>
            <tr>
                <td>#</td>
                <td>{{ $question ->id }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $question ->question }}</td>
                <td>
                    <button id="deleteButton" data-url="{{ url('question/' . $question->id) }}" data-name="{{ $question->question }}" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
                        Link to delete v3
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <a class="btn-danger btn"  href="{{ url('question/' . $question->id . '/edit') }}">link to edit</a>
</div>

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