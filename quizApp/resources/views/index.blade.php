@extends('app.base')

@section('content')
    <h3>What do you want to do?</h3>

    <div class="mb-3">
        <a href="{{ url('quizz') }}" class="btn btn-primary">Play</a>
    </div>

    <div class="mb-3">
        <a href="{{ url('question') }}" class="btn btn-success">View Questions</a>
    </div>

    <div class="mb-3">
        <a href="{{ url('question/create') }}" class="btn btn-info">Create New Question</a>
    </div>

    <div class="mb-3">
        <a href="{{ url('record') }}" class="btn btn-warning">View All Records</a>
    </div>

@auth
    <div class="mb-3">
        <div style="display:none;">{{ $alias = Auth::user()->name }}</div>
        <a href="{{ route('records.details', ['alias' => $alias]) }}" class="btn btn-danger">View My Records</a>
    </div>
    @endauth

@endsection
