<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentTypeModel extends Model
{
    use HasFactory;
    protected $table = 'investment_type';
    protected $primaryKey = 'id_investment_type';
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function animal()
    {
        return $this->hasMany(AnimalModel::class, 'id_investment_type', 'id_investment_type');
    }
}
