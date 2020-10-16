<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtkDetail extends Model
{
    use HasFactory;

    protected $table = 'atkdetails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'atk_id', 'name', 'spesifikasi', 'jumlah'
    ];

    public function orderatk()
    {
        return $this->belongsTo('App\Models\OrderAtk');
    }
    
}
