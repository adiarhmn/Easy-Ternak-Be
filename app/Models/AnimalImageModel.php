<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalImageModel extends Model
{
    use HasFactory;

    protected $table = 'animal_image';
    protected $primaryKey = 'id_animal_image';
    protected $fillable = [
        'id_animal',
        'image',
    ];

    public $timestamps = true;

    public function animal()
    {
        return $this->belongsTo(AnimalModel::class, 'id_animal', 'id_animal');
    }
}
