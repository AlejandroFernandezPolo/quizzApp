<!-- resources/views/records/show.blade.php -->

@extends('app.base')

@section('content')
    <div class="container">
        <h2>Record Details</h2>

        <p>ID: {{ $record->id }}</p>
        <p>Question: {{ $record->question->question }}</p>
        <p>Selected Answer: {{ $record->answer->answer }}</p>
        <p>Alias: {{ $record->alias }}</p>
        <p>Correct: {{ $record->correct ? 'Yes' : 'No' }}</p>
    </div>
@endsection
