<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraModel extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    protected $primaryKey = 'id_mitra';
    protected $fillable = [
        'id_user',
        'name',
        'address',
        'telephone',
        'nik',
        'ktp_image',
        'rating',
    ];
    public $timestamps = true;
}
