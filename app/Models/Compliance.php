<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'user_id',
        'cle_credits',
        'meeting_credits',
        'extra_credits',
        'total_credits',
        'created_by',
        'update_by',
];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function created_by()
        {
            return $this->belongsTo(Admin::class , 'created_by', 'id');
        }
}
