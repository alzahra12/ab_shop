<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function addFunds(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');
        $user->wallet_balance += $amount;
        $user->save();
        return response()->json(['message' => 'Funds added successfully!', 'wallet_balance' => $user->wallet_balance], 200);
    }
}
