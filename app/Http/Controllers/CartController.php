<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; 
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\Wallet;


class CartController extends Controller
{
    public function index()
   {
    $user = auth()->user(); 
    $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
    $products = Product::all();
    return view('cart.index', compact('cartItems', 'products'));
   }


   public function add(Request $request)
{
   $user = auth()->user();
   $productId = $request->input('product_id');
   $quantity = 1; 
   $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();
   if ($cartItem) {
       $cartItem->quantity += $quantity;
       $cartItem->save();
   } else {
       Cart::create([
           'user_id' => $user->id,
           'product_id' => $productId,
           'quantity' => $quantity,
       ]);
   }
   return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
}

   public function removeFromCart($itemId)
   {
    $user = Auth::user();
    $cartItems = Cart::where('user_id', $user->id)->get();
    if ($cartItems->isEmpty()) {
        return response()->json(['message' => 'العربة فارغة'], 400);
    }
    $totalPrice = 0;
    $products = [];
    foreach ($cartItems as $item) {
        $product = Product::find($item->product_id);
        $totalPrice += $product->price * $item->quantity;
        $products[] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'quantity' => $item->quantity,
            'price' => $product->price
        ];
        $product->decrement('stock', $item->quantity);
    }
    $wallet = Wallet::where('user_id', $user->id)->first();
    if ($wallet->balance < $totalPrice) {
        return response()->json(['message' => 'رصيد المحفظة غير كافٍ لإتمام العملية'], 400);
    }
    $wallet->decrement('balance', $totalPrice);

    Order::create([
        'user_id' => $user->id,
        'total_price' => $totalPrice,
        'products' => json_encode($products)
    ]);

    Cart::where('user_id', $user->id)->delete();
    return response()->json(['message' => 'تم إتمام عملية الشراء بنجاح'], 200);
}

public function checkout()
{
    $user = auth()->user();
    $cartItems = Cart::where('user_id', $user->id)->get();


    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });


    $order = Order::create([
        'user_id' => $user->id,
        'total' => $total,
    ]);


    foreach ($cartItems as $cartItem) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
        ]);
    }

    Cart::where('user_id', $user->id)->delete();

    return redirect()->route('order.index');
}

}

