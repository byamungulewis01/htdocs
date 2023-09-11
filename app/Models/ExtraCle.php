<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCle extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'closing_date',
        'category',
        'hours',
        'credits',
        'advocate',
        'yearInBar',
    ];
}
