<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'company',
        'phone',
        'email',
        'birthday',
        'photo',
    ];
}
