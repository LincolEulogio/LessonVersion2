<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    protected $table = 'question_bank';
    protected $primaryKey = 'questionBankID';

    protected $fillable = [
        'questionGroupID', 'questionLevelID', 'questionTypeID', 'question', 
        'explanation', 'upload', 'create_date', 'modify_date'
    ];
}
