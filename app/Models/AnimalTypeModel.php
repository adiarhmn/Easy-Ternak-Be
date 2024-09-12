<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalTypeModel extends Model
{
    use HasFactory;
    protected $table = 'animal_type';
    protected $primaryKey = 'id_animal_type';
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function subAnimalType()
    {
        return $this->hasMany(SubAnimalTypeModel::class, 'id_animal_type', 'id_animal_type');
    }

}
