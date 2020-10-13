<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderKiriman extends Model
{
    use HasFactory;

    protected $table = 'kirimans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'jenisKiriman', 'asuransi', 'pertanggungan', 'namaDebitur', 'namaPIC', 'alamat', 'noPenerima', 'statusDetail', 'dokumen'
    ];
}
