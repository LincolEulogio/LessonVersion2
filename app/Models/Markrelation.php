<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Markrelation extends Model
{
    protected $table = 'markrelation';
    protected $primaryKey = 'markrelationID';

    protected $fillable = [
        'markID', 'markpercentageID', 'mark'
    ];

    public function percentage()
    {
        return $this->belongsTo(Markpercentage::class, 'markpercentageID', 'markpercentageID');
    }
}
