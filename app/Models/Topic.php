<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $primaryKey = 'topicID';

    protected $fillable = [
        'title', 
        'description', 
        'classesID', 
        'subjectID', 
        'create_userID', 
        'create_usertype'
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjectID', 'subjectID');
    }
}
