<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $table = 'answer';

    public $timestamps = false;
    
    protected $fillable = ['idquestion', 'answer', 'correct'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'idquestion');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Record', 'idanswer');
    }
}


