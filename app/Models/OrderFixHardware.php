<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFixHardware extends Model
{
    use HasFactory;

    protected $table = 'orderfixhardware';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'orderDate', 'jenis_id', 'keterangan', 'statusDetail'
    ];

    public function jenishardware()
    {
        return $this->hasOne('App\Models\JenisHardware');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
