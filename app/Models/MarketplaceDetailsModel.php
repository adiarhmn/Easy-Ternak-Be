<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'marketplace_details';
    protected $primaryKey = 'id_marketplace_details';
    protected $fillable = [
        'id_marketplace_animal',
        'id_payment_method',
        'id_user',
        'proof_image',
        'status',
        'expired_at',
    ];

    public $timestamps = true;

    public function marketplaceAnimal()
    {
        return $this->belongsTo(MarketplaceAnimalModel::class, 'id_marketplace_animal', 'id_marketplace_animal');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethodModel::class, 'id_payment_method', 'id_payment_method');
    }
}
