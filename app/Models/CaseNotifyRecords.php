<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseNotifyRecords extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_id',
        'message',
        'defandant_name',
        'plaintiff_name',
    ];
}
