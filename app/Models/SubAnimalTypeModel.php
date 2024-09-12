<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAnimalTypeModel extends Model
{
    use HasFactory;
    protected $table = 'sub_animal_type';
    protected $primaryKey = 'id_sub_animal_type';
    protected $fillable = [
        'id_animal_type',
        'name',
    ];

    public $timestamps = true;

    public function animalType()
    {
        return $this->belongsTo(AnimalTypeModel::class, 'id_animal_type', 'id_animal_type');
    }

    public function animal()
    {
        return $this->hasMany(AnimalModel::class, 'id_sub_animal_type', 'id_sub_animal_type');
    }
}
