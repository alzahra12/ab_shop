<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use App\Http\Controllers\CartController;
use App\Models\CartItem;
use App\Models\Cart;
//use App\Http\Controllers\OrderItem;
use App\Models\OrderItem;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = auth()->user()->orders;
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();
   $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
   if ($cartItems->isEmpty()) {
       return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
   }
   $total = 0;
   foreach ($cartItems as $item) {
       $total += $item->quantity * $item->product->price;
   }
   $order = Order::create([
       'user_id' => $user->id,
       'total' => $total,
       'status' => 'pending',
   ]);
   foreach ($cartItems as $item) {
       OrderItem::create([
           'order_id' => $order->id,
           'product_id' => $item->product_id,
           'quantity' => $item->quantity,
           'price' => $item->product->price,
       ]);
   }
   Cart::where('user_id', $user->id)->delete();
   return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
        $total = 0;

        foreach ($request->products as $product) {
            $productModel = Product::find($product['id']);
            $total += $productModel->price * $product['quantity'];
        }

        $wallet = auth()->user()->wallet;
        if ($wallet->balance < $total) {
            return response()->json(['message' => 'Insufficient funds'], 400);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'completed'
        ]);

        foreach ($request->products as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        $wallet->balance -= $total;
        $wallet->save();
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // 
       $order = Order::with('items.product')->findOrFail($id);
       return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       
    }

   public function checkout(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->quantity * $item->product->price;
        }
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total, 
            'status' => 'pending',
        ]);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function export()
   {
    return Excel::download(new OrdersExport, 'orders.xlsx');
   }
}
