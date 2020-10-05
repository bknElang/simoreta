<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequestJob extends Model
{
    use HasFactory;

    protected $table = 'requestjobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'jenis', 'roles_to_id', 'statusDetail'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
