<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFixComputer extends Model
{
    use HasFactory;

    protected $table = 'orderfixcomputer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'orderDate', 'jenis_id', 'keterangan', 'statusDetail'
    ];

    public function jeniskomponencomputer()
    {
        return $this->hasOne('App\Models\JenisKomponenComputer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
