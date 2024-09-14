<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show()
   {
       
    $user = Auth::user();
    $wallet = $user->wallet;
    if (!$wallet) {
        return redirect()->back()->with('error', 'Wallet not found.');
    }
    return view('wallet.index', compact('wallet'));

   }

   public function addFunds(Request $request)
   {
       
    $request->validate([
        'amount' => 'required|numeric|min:0.01',
    ]);
    $user = Auth::user();
    $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
    $wallet->balance += $request->amount;
    $wallet->save();
    return redirect()->route('wallet.show')->with('success', 'Funds added successfully.');

   }
   public function deductFunds(Request $request)
   {
       
    $request->validate([
        'amount' => 'required|numeric|min:0.01',
    ]);
    $user = Auth::user(); 
    $wallet = $user->wallet;
    if (!$wallet || $wallet->balance < $request->amount) {
        return redirect()->route('wallet.show')->with('error', 'Insufficient funds or wallet not found.');
    }
    $wallet->balance -= $request->amount;
    $wallet->save();
    return redirect()->route('wallet.show')->with('success', 'Funds deducted successfully.');
}

  
}