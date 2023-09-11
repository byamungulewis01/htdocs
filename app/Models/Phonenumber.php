<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonenumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
