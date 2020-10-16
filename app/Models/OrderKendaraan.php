<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderKendaraan extends Model
{
    use HasFactory;

    protected $table = 'orderkendaraans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'useDatetime', 'finishDatetime', 'pickupAddress', 'destinationAddress', 'necessity', 'totalPassanger', 'keterangan', 'assign_id', 'status', 'hc_id'
    ];

    public function assignkendaraan()
    {
        return $this->hasOne('App\Models\AssignKendaraan');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
