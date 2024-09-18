<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressImageModel extends Model
{
    use HasFactory;
    protected $table = 'progress_image';
    protected $primaryKey = 'id_progress_image';
    protected $fillable = [
        'id_animal_progress',
        'image',
    ];

    public $timestamps = true;

    public function animalProgress()
    {
        return $this->belongsTo(AnimalProgressModel::class, 'id_animal_progress', 'id_animal_progress');
    }
}
