<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubAnimalTypeModel;
use Illuminate\Http\Request;

class SubAnimalTypeController extends Controller
{
    public function index(){
        $subAnimalTypes = SubAnimalTypeModel::with('animalType')->get();
        return response()->json(['message' => 'Sub Animal Type data', 'subAnimalTypes' => $subAnimalTypes]);
    }
}
