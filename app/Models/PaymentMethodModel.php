<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodModel extends Model
{
    use HasFactory;
    protected $table = 'payment_method';
    protected $primaryKey = 'id_payment_method';
    protected $fillable = [
        'payment_name',
        'payment_number',
        'payment_provider',
    ];

    public $timestamps = true;

    public function marketplaceDetails()
    {
        return $this->hasMany(MarketplaceDetailsModel::class, 'id_payment_method', 'id_payment_method');
    }
}
