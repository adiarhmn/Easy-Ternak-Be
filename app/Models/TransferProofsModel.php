<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferProofsModel extends Model
{
    use HasFactory;
    protected $table = 'transfer_proofs';
    protected $primaryKey = 'id_transfer_proof';
    protected $fillable = [
        'id_investment_slot',
        'proof_image',
    ];

    public $timestamps = true;

    public function investmentSlot()
    {
        return $this->belongsTo(InvestmentSlotModel::class, 'id_investment_slot', 'id_investment_slot');
    }
}
