<?php

namespace App\Http\Controllers;

use App\Models\InvestmentSlotModel;
use Illuminate\Http\Request;

class InvestmentSlotController extends Controller
{
    public function ValidateSlot(int $id)
    {
        $slot = InvestmentSlotModel::where('id_slot', $id)->first();
        if ($slot == null) {
            return response()->json(['message' => 'Slot not found'], 404);
        }

        $slot->status = 'validated';
        $slot->save();

        return response()->json(['message' => 'Slot validated', 'slot' => $slot]);
    }
}
