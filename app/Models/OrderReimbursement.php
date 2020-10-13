<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReimbursement extends Model
{
    use HasFactory;

    protected $table = 'orderreimbursements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'orderDate', 'keterangan', 'namaRek', 'nomorRek', 'bankRek', 'nominal', 'jenis_id', 'statusDetail', 'hcname'
    ];

    public function jenisreimbursement()
    {
        return $this->hasOne('App\Models\JenisReimbursement');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
