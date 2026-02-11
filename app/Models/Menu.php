<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menuID';

    protected $fillable = [
        'menuName', 'menuIDParent', 'menuLink', 'menuIcon', 'menuPriority', 
        'menuStatus', 'menuCreateDate', 'menuCreatedBy', 'menuDeleted', 'menuDeletedAt'
    ];
}
