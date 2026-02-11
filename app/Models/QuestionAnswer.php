<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = 'question_answer';
    protected $primaryKey = 'questionAnswerID';

    protected $fillable = [
        'questionID', 'answer'
    ];
}
