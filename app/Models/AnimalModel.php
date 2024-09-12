<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalModel extends Model
{
    use HasFactory;
    protected $table = 'animal';
    protected $primaryKey = 'id_animal';
    protected $fillable = [
        'id_sub_animal_type',
        'id_mitra',
        'animal_code',
        'description',
        'id_sub_animal_type',
        'price',
        'selling_date',
        'purchase_date',
        'status',
        'investment_type',
    ];

    public $timestamps = true;

    public function subAnimalType()
    {
        return $this->belongsTo(SubAnimalTypeModel::class, 'id_sub_animal_type', 'id_sub_animal_type');
    }
    
}
