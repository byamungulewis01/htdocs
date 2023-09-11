<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitations extends Model
{
    use HasFactory;
    protected $table = 'invitation';
    protected $fillable = [
        'user_id',
        'meeting_id',
        'credit',
        'status',
        'booked',
        'yearInBar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // meeting
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
