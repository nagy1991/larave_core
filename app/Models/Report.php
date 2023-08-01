<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'devices',
        'description',
        'dateofrepair',
    ];

    protected $casts = [
        'dateofrepair' => 'datetime',
    ];

}
