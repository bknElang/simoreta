<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignKendaraan extends Model
{
    use HasFactory;

    protected $table = 'assignkendaraans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namaDriver', 'jenisKendaraan', 'plateNumber', 'nohpDriver', 'pinPenumpang'
    ];

    public function orderkendaraan()
    {
        return $this->belongsTo('App\Models\OrderKendaraan');
    }
}
