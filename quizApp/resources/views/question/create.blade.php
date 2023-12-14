@extends('app.base')

@section('title', 'Question Create')

@section('content')

<form action="{{ url('question') }}" method="post">

    @csrf

    <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" id="question" name="question" maxlength="200" required value="{{ old('question') }}">
    </div>

    <button type="submit" class="btn btn-success">Create</button>

</form>

    

@endsection