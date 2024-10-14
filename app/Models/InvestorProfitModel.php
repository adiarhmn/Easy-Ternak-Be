<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorProfitModel extends Model
{
    use HasFactory;
    protected $table = 'investor_profit';
    protected $primaryKey = 'id_investor_profit';
    protected $fillable = [
        'id_investment_slot',
        'id_investor',
        'profit',
        'status',
        'proof_image',
    ];

    public $timestamps = true;

    public function investmentSlot()
    {
        return $this->belongsTo(InvestmentSlotModel::class, 'id_investment_slot', 'id_investment_slot');
    }

    public function investor()
    {
        return $this->belongsTo(InvestorModel::class, 'id_investor', 'id_investor');
    }
}
