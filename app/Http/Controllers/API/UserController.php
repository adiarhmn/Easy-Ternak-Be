<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MarketplaceDetailsModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function myOrder()
    {
        // Get Authenticated Route
        $user = JWTAuth::user();

        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $MyOrders = MarketplaceDetailsModel::where('id_user', $user->id_user)
            ->with(['marketplaceAnimal.animal.subAnimalType.animalType', 'paymentMethod'])
            ->get();

        if ($MyOrders == null) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json(['message' => 'My Orders', 'my_orders' => $MyOrders]);

    }
}
