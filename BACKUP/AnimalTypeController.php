<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalTypeModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AnimalTypeController extends Controller
{
    public function index()
    {
        $user = JWTAuth::user();
        if ($user == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $animalTypes = AnimalTypeModel::with('subAnimalType.animalType')->get();
        return response()->json(['message' => 'Animal Type data', 'animalTypes' => $animalTypes]);
    }
}
