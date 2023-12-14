@extends('app.base')
@section('title', 'Questions List')

@section('content')

@include('modal.deletequestion')

<div class="table-responsive small">
    <h2>List of questions</h2>
    <br>
    @if(count($questions) > 0)
    
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Question</th>
                    <th scope="col">Number of Answers</th>
                    <th scope="col">Actions</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ count($question->answers) }}</td>

                        <td>
                            <a class="btn-primary btn" href="{{ url('question/' . $question->id) }}">Show question</a>
                            </td>
                            <td>
                            <a class="btn-warning btn"  href="{{ url('question/' . $question->id . '/edit') }}">Edit question</a>
                            </td>
                            <td>
                            <button id="deleteButton" data-url="{{ url('question/' . $question->id) }}" data-name="{{ $question->question }}" type="button" class="btn-danger btn" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
                                Delete question
                            </button>
                            </td>
                            <td>
                            <a class="btn btn-success" href="{{ url('answer/create?idquestion=' . $question->id) }}">Add answers</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No questions have been generated yet.</p>
    @endif
    <a class="btn-success btn"  href="{{ url('question/create') }}">Create new question</a>
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

