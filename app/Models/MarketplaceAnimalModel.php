<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceAnimalModel extends Model
{
    use HasFactory;
    protected $table = 'marketplace_animal';
    protected $primaryKey = 'id_marketplace_animal';
    protected $fillable = [
        'id_animal',
        'id_mitra',
        'price',
        'status',
    ];
    public $timestamps = true;


    public function animal()
    {
        return $this->belongsTo(AnimalModel::class, 'id_animal', 'id_animal');
    }

    public function mitra()
    {
        return $this->belongsTo(MitraModel::class, 'id_mitra', 'id_mitra');
    }

    public function marketplaceDetails()
    {
        return $this->hasOne(MarketplaceDetailsModel::class, 'id_marketplace_animal', 'id_marketplace_animal');
    }
}
