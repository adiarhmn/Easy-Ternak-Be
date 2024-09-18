<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalExpensesModel extends Model
{
    use HasFactory;
    protected $table = 'animal_expenses';
    protected $primaryKey = 'id_animal_expenses';
    protected $fillable = [
        'id_animal',
        'description',
        'price',
        'date',
    ];

    public $timestamps = true;

    public function animal()
    {
        return $this->belongsTo(AnimalModel::class, 'id_animal', 'id_animal');
    }
}
