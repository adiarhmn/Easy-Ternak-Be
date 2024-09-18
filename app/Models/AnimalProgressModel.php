<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalProgressModel extends Model
{
    use HasFactory;

    protected $table = 'animal_progress';
    protected $primaryKey = 'id_animal_progress';

    protected $fillable = [
        'id_animal',
        'description',
        'date',
    ];

    public $timestamps = true;

    public function animal()
    {
        return $this->belongsTo(AnimalModel::class, 'id_animal', 'id_animal');
    }
}
