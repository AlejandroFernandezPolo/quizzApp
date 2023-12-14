<!-- game.blade.php -->

@extends('app.base')
@section('title', 'Quizz Game')

@section('content')

<style>
    /*styles.css*/

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    h3 {
        margin-bottom: 10px;
    }

    /*Cambios para mostrar respuestas de dos en dos*/
    .answers-container {
        display: flex;
        flex-wrap: wrap;
    }

    input[type="radio"] {
        display: none;
    }

    label {
        cursor: pointer;
        display: block;
        width: 48%;
        /* Asegúrate de que el ancho sea suficiente para dos elementos por fila */
        padding: 10px;
        margin-bottom: 8px;
        border: 2px solid #3498db;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        box-sizing: border-box;
    }

    input[type="radio"]:checked+label {
        background-color: #3498db;
        color: #fff;
    }

    .btn-primary {
        background-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }
</style>
<div class="container">
    <h2>Quizz Game</h2>

    <form method="post" action="{{ url('quizz/submit') }}">
        @csrf

        @foreach ($preguntasAleatorias as $item)
        @php
        $pregunta = $item['pregunta'];
        $respuestas = $item['respuestas'];
        @endphp

        <div>
            <h2>{{ $pregunta->question }}</h2>

            {{-- Mostrar respuestas como opciones de radio --}}
            <div class="answers-container">
                @foreach ($respuestas as $respuesta)

                <input type="radio" name="respuestas[{{$pregunta->id}}]" value="{{$respuesta->id}}" id="respuesta_{{$respuesta->id}}">
                <label for="respuesta_{{$respuesta->id}}">{{$respuesta->answer}}</label>

                @endforeach
            </div>
        </div>
        @endforeach

        {{-- Botón de envío --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection