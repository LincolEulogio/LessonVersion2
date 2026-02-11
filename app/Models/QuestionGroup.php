<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    protected $table = 'question_group';
    protected $primaryKey = 'questionGroupID';

    protected $fillable = [
        'title', 'create_date', 'modify_date'
    ];
}
