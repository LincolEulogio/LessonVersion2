<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $table = 'question_type';
    protected $primaryKey = 'questionTypeID';

    protected $fillable = [
        'name'
    ];
}
