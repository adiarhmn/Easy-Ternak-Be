<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraModel extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    protected $primaryKey = 'id_mitra';
    protected $fillable = [
        'id_user',
        'name',
        'address',
        'telephone',
        'nik',
        'ktp_image',
        'rating',
        'payment_number',
        'provider',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function animal()
    {
        return $this->hasMany(AnimalModel::class, 'id_mitra', 'id_mitra');
    }

    public function investmentSlot()
    {
        return $this->hasMany(InvestmentSlotModel::class, 'id_mitra', 'id_mitra');
    }

    public function mitraProfit()
    {
        return $this->hasMany(MitraProfitModel::class, 'id_mitra', 'id_mitra');
    }


}
