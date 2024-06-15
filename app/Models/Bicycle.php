<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicycle extends Model
{
    protected $table = 'bicycles';
    protected $fillable = 
    [
        'id',
        'title',
        'manufactor',
        'price',
        'image',
        'description',
        
    ];

    
}
