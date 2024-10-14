<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentSlotModel extends Model
{
    use HasFactory;
    protected $table = 'investment_slot';
    protected $primaryKey = 'id_investment_slot';
    
    protected $fillable = [
        'id_investor',
        'id_animal',
        'slot_code',
        'slot_price',
        'profit',
        'status',
        'id_payment_method',
        'distribution_status',
        'expired_at',
    ];

    public $timestamps = true;

    public function investor()
    {
        return $this->belongsTo(InvestorModel::class, 'id_investor', 'id_investor');
    }

    public function animal()
    {
        return $this->belongsTo(AnimalModel::class, 'id_animal', 'id_animal');
    }

    public function transferProof()
    {
        return $this->hasMany(TransferProofsModel::class, 'id_investment_slot', 'id_investment_slot');
    }

    public function investorProfit()
    {
        return $this->hasOne(InvestorProfitModel::class, 'id_investment_slot', 'id_investment_slot');
    }
}

