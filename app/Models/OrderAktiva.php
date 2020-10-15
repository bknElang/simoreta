<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAktiva extends Model
{
    use HasFactory;

    protected $table = 'aktivas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'jenisBarang', 'spesifikasi', 'statusDetail', 'keterangan', 'hc_id', 'jumlah'
    ];

}
