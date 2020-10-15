<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFixAplikasi extends Model
{
    use HasFactory;

    protected $table = 'orderfixaplikasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'orderDate', 'jenis_id', 'keterangan', 'statusDetail'
    ];

    public function jenisaplikasi()
    {
        return $this->hasOne('App\Models\JenisAplikasi');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
