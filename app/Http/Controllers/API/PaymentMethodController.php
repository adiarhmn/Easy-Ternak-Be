<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodModel;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethod = PaymentMethodModel::all();
        return response()->json([
            'status' => 'success',
            'payment_methods' => $paymentMethod
        ]);
    }
}
