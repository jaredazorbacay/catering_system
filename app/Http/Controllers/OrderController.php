<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function create()
{

    $cartItems = Cart::with('item')
        ->where('user_id',Auth::id())
        ->get();

    $total = 0;

    foreach($cartItems as $cart){
        $total += $cart->item->price * $cart->quantity;
    }

    return view('client.create_order',[
        'cartItems'=>$cartItems,
        'total'=>$total
    ]);

}



public function store(Request $request)
{

    $order = Order::create([
        'user_id'=>Auth::id(),
        'event_name'=>$request->event_name,
        'event_date'=>$request->event_date,
        'event_location'=>$request->event_location,
        'guest_count'=>$request->guest_count,
        'status'=>'pending'
    ]);


    $cartItems = Cart::with('item')
        ->where('user_id',Auth::id())
        ->get();


    foreach($cartItems as $cart){

        OrderItem::create([
            'order_id'=>$order->id,
            'item_id'=>$cart->item_id,
            'price'=>$cart->item->price,
            'quantity'=>$cart->quantity
        ]);

    }


    /* RESET CART */

    Cart::where('user_id',Auth::id())->delete();


    return redirect('/client/dashboard')
        ->with('success','Order created successfully');

}



    public function clientOrders()
    {

        $orders = Order::with(['items.item'])
            ->where('user_id',Auth::id())
            ->latest()
            ->get();

        return view('client.orders',compact('orders'));

    }



    public function adminOrders()
    {

        $orders = Order::with(['user','items.item'])
            ->latest()
            ->get();

        return view('admin.orders',compact('orders'));

    }



    public function approve($id)
    {

        $order = Order::findOrFail($id);

        if($order->status != 'pending'){

            return back()->with('error','Only pending orders can be approved');

        }

        $order->status = 'approved';
        $order->save();

        return back()->with('success','Order approved successfully');

    }



    public function cancel($id)
    {

        $order = Order::findOrFail($id);

        if($order->status != 'pending'){

            return back()->with('error','Only pending orders can be cancelled');

        }

        $order->status = 'cancelled';
        $order->save();

        return back()->with('success','Order cancelled successfully');

    }

    public function updatePayment(Request $request, $id)
    {
        echo "Hello";
        $order = Order::with('items')->findOrFail($id);
    
        $request->validate([
            'payment' => 'required|numeric|min:0'
        ]);
    
        // ✅ SAME LOGIC AS BLADE (IMPORTANT)
        $total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
    
        $payment = $request->payment;
    
        $order->payment = $payment;
    
        $order->save();
    
        return back()->with('success', 'Payment updated successfully');
    }

}