<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraProfitModel extends Model
{
    use HasFactory;
    protected $table = 'mitra_profit';
    protected $primaryKey = 'id_mitra_profit';
    protected $fillable = [
        'id_mitra',
        'id_animal',
        'profit',
        'status',
        'proof_image',
    ];

    public $timestamps = true;

    public function mitra()
    {
        return $this->belongsTo(MitraModel::class, 'id_mitra', 'id_mitra');
    }

    public function animal()
    {
        return $this->belongsTo(AnimalModel::class, 'id_animal', 'id_animal');
    }
}
