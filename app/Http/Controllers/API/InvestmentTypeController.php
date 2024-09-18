<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InvestmentTypeModel;
use Illuminate\Http\Request;

class InvestmentTypeController extends Controller
{
    public function index()
    {
        $investmentTypes = InvestmentTypeModel::all();
        return response()->json(['message' => 'Investment Type data', 'investmentTypes' => $investmentTypes]);
    }
}
