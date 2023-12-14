@extends('app.base')
@section('title', 'Answer Details')

@section('content')
    <h2>Answers for {{ Auth::user()->name }}</h2>
    
    @if ($userRecords->isEmpty())
        <p>No details available.</p>
    @else
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Selected Answer</th>
                        <th>Correct</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userRecords as $record)
                        <tr>
                            <td>{{ $record->question->question }}</td>
                            <td>{{ $record->answer->answer }}</td>
                            <td>{{ $record->correct ? 'Yes' : 'No' }}</td>
                            <td>{{ $record->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
