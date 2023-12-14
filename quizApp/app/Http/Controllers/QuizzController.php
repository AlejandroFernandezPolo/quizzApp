<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function index()
    {
        $maxQuestions = Question::count(); // Obtener el número máximo de preguntas
        if ($maxQuestions > 10) $maxQuestions = 10;
        return view('quizz.index', ['maxQuestions' => $maxQuestions]);
    }

    // QuizzController.php
    public function start(Request $request)
    {
        $numPreguntas = $request->input('num_questions');

        // Validar que haya suficientes preguntas con al menos 4 respuestas y al menos una correcta
        $preguntasDisponibles = Question::whereHas('answers', function ($query) {
            $query->where('correct', 1);
        })->has('answers', '>=', 4)->get();

        if ($preguntasDisponibles->count() < $numPreguntas) {
            return redirect()->back()->withInput()->withErrors(['message' => 'No hay suficientes preguntas con al menos 4 respuestas y al menos una correcta.']);
        }

        $preguntasAleatorias = collect();

        $preguntasDisponibles = $preguntasDisponibles->shuffle();

        foreach ($preguntasDisponibles as $pregunta) {
            $respuestasCorrectas = $pregunta->answers->where('correct', 1);

            if ($respuestasCorrectas->isEmpty()) {
                // Si no hay respuesta correcta, omitir la pregunta
                continue;
            }

            // Asegurarse de que haya al menos una respuesta correcta
            $respuestaCorrecta = $respuestasCorrectas->first();

            // Obtener todas las respuestas para la pregunta (sin límite)
            $todasRespuestas = $pregunta->answers;

            // Filtrar las respuestas para incluir solo las correctas
            $respuestasCorrectas = $todasRespuestas->where('correct', 1);

            // Filtrar las respuestas para incluir solo las incorrectas
            $respuestasIncorrectas = $todasRespuestas->where('correct', 0);

            // Tomar 2 respuestas incorrectas de forma aleatoria
            $respuestasAleatorias = $respuestasIncorrectas->random(3);

            // Añadir la respuesta correcta a las respuestas aleatorias
            $respuestasAleatorias->push($respuestaCorrecta);

            // Mezclar las respuestas aleatorias
            $respuestasAleatorias = $respuestasAleatorias->shuffle();

            // Mezclar las respuestas aleatorias
            $respuestasAleatorias = $respuestasAleatorias->shuffle();

            $preguntasAleatorias->push(['pregunta' => $pregunta, 'respuestas' => $respuestasAleatorias]);

            // Detener el bucle cuando tengas suficientes preguntas aleatorias
            if ($preguntasAleatorias->count() == $numPreguntas) {
                break;
            }
        }

        return view('quizz.game', ['preguntasAleatorias' => $preguntasAleatorias]);
    }

    // En el método submit
    public function submit(Request $request)
    {
        $respuestasSeleccionadas = $request->input('respuestas');
        
        if($respuestasSeleccionadas != null){

        foreach ($respuestasSeleccionadas as $idPregunta => $idRespuesta) {
            // Obtener la respuesta correcta de la pregunta
            $respuestaCorrecta = Answer::where('idquestion', $idPregunta)
                ->where('correct', 1)
                ->first();

            // Crear un nuevo registro en la tabla de records
            Record::create([
                'idquestion' => $idPregunta,
                'idanswer' => $idRespuesta,
                'alias' => auth()->check() ? Auth::user()->name : 'Sin identificar',
                'correct' => ($idRespuesta == $respuestaCorrecta->id) ? 1 : 0,
            ]);
        }
        }else{
            return back()->withInput()->withErrors(['message' => 'You must answer all the answers to send the test']);
        }

        return redirect('')->with(['message' => 'You have completed the test, you can now see the results']);
    }
}
