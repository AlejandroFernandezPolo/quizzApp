<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    
    protected $table = 'record';
    
    protected $fillable = ['idquestion', 'idanswer', 'alias', 'correct'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'idquestion');
    }

    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'idanswer');
    }
}


