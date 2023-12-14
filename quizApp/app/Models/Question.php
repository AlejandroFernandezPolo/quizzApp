<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $table = 'question';

    public $timestamps = false;

    protected $fillable = ['question'];

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'idquestion');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Record', 'idquestion');
    }
    
}

