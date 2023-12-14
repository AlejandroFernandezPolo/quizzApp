<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
            $records = Record::all();
    
    // Agrupa los registros por 'alias' y cuenta las respuestas y las respuestas correctas para cada usuario
    $userStats = $records->groupBy('alias')->map(function ($records) {
        $totalAnswers = $records->count();
        $correctAnswers = $records->sum('correct');
        return compact('totalAnswers', 'correctAnswers');
    });

    return view('record/index',  ['records' => $records, 'userStats' => $userStats ]);
    }
    
    // En tu controlador
public function showDetails($alias)
{
    if ($alias != null){
        
    }else {
        $alias = Auth::user()->name;
    }
    $userRecords = Record::where('alias', $alias)->get();
    
    return view('record.details',  [ 'userRecords' => $userRecords ]);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record) {
        return view('record.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
