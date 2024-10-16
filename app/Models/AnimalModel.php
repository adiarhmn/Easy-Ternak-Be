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
        'id_investment_type',
        'animal_code',
        'description',
        'id_sub_animal_type',
        'purchase_price',
        'selling_price',
        'selling_date',
        'purchase_date',
        'start_date',
        'end_date',
        'status',
        'total_slots',
    ];

    public $timestamps = true;

    public function subAnimalType()
    {
        return $this->belongsTo(SubAnimalTypeModel::class, 'id_sub_animal_type', 'id_sub_animal_type');
    }

    public function investmentSlot()
    {
        return $this->hasMany(InvestmentSlotModel::class, 'id_animal', 'id_animal');
    }

    public function investmentType()
    {
        return $this->belongsTo(InvestmentTypeModel::class, 'id_investment_type', 'id_investment_type');
    }

    public function mitra()
    {
        return $this->belongsTo(MitraModel::class, 'id_mitra', 'id_mitra');
    }

    public function animalExpenses()
    {
        return $this->hasMany(AnimalExpensesModel::class, 'id_animal', 'id_animal');
    }

    public function animalProgress()
    {
        return $this->hasMany(AnimalProgressModel::class, 'id_animal', 'id_animal');
    }

    public function animalImage()
    {
        return $this->hasMany(AnimalImageModel::class, 'id_animal', 'id_animal');
    }

    public function marketplaceAnimal()
    {
        return $this->hasOne(MarketplaceAnimalModel::class, 'id_animal', 'id_animal');
    }

    public function mitraProfit()
    {
        return $this->hasOne(MitraProfitModel::class, 'id_animal', 'id_animal');
    }

    public function investorProfit()
    {
        return $this->hasMany(InvestorProfitModel::class, 'id_animal', 'id_animal');
    }
}
