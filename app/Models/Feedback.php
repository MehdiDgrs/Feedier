<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'rating',
        'start_date',
        'address',
        'apartments',
        'source'
    ];

    protected $table = 'feedbacks';
}
