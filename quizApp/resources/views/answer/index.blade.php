@extends('app.base')
@section('title', 'Answer List')

@section('content')

@include('modal.deleteanswer')

<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Answer</th>
                <th scope="col">Correct</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $answer)
                <tr>
                    <td>{{ $answer ->id }}</td>
                    <td>{{ $answer ->idquestion }}</td>
                    <td>{{ $answer ->answer }}</td>
                    <td>{{ $answer ->correct }}</td>

                    <td>
                        <a class="btn-primary btn" href="{{ url('answer/' . $answer->id) }}">link to show</a>
                        <a class="btn-danger btn"  href="{{ url('answer/' . $answer->id . '/edit') }}">link to edit</a>
                    <button data-url="{{ url('answer/' . $answer->id) }}" data-name="{{ $answer->answer }}" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAnswerModal">
                                Delete Answer
                            </button>
                </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <a class="btn-info btn"  href="{{ url('answer/create') }}">link to create</a>
</div>

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

