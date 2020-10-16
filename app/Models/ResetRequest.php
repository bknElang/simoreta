<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetRequest extends Model
{
    use HasFactory;

    protected $table = 'resetrequests';

    protected $fillable = [
        'user_id', 'hc_id', 'status'
    ];
}
