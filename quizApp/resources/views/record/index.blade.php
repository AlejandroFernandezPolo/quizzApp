@extends('app.base')

@section('content')
<h2>List of records</h2>
<br>
@if ($userStats->isEmpty())
<p>No hay registros disponibles.</p>
@else
<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Alias</th>
                <th>Questions Answered Correctly</th>
                <th>Questions Answered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userStats as $alias => $stats)
            <tr>
                <td>{{ $alias }}</td>
                <td>{{ $stats['correctAnswers'] }}</td>
                <td>{{ $stats['totalAnswers'] }}</td>
                <td>
                    <!-- Puedes agregar acciones según tus necesidades -->
                    <a href="{{ route('records.details', ['alias' => $alias]) }}" class="btn btn-primary">See details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection