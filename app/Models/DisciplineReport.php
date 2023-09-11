<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplineReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'comments',
        'attachements',
        'user_id',
        'sitting_id',
        'discipline_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
