<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorModel extends Model
{
    use HasFactory;
    protected $table = 'investor';
    protected $primaryKey = 'id_investor';
    protected $fillable = [
        'id_user',
        'name',
        'address',
        'telephone',       
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function investmentSlot()
    {
        return $this->hasMany(InvestmentSlotModel::class, 'id_investor', 'id_investor');
    }
}
