<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Message;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function create()
    {


        $cartItems = Cart::with('item')
            ->where('user_id', Auth::id())
            ->get();

        $total = 0;
        $totalServing = 0;

        foreach ($cartItems as $cart) {
            $total += $cart->item->price * $cart->quantity;
            $totalServing += $cart->item->serving * $cart->quantity;
        }

        return view('client.create_order', [
            'cartItems' => $cartItems,
            'total' => $total,
            'totalServing' => $totalServing
        ]);

    }



    public function store(Request $request)
    {

        $order = Order::create([
            'user_id' => Auth::id(),
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'event_location' => $request->event_location,
            'guest_count' => $request->guest_count,
            'status' => 'pending'
        ]);


        $cartItems = Cart::with('item')
            ->where('user_id', Auth::id())
            ->get();


        foreach ($cartItems as $cart) {

            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $cart->item_id,
                'price' => $cart->item->price,
                'quantity' => $cart->quantity
            ]);

        }


        /* RESET CART */

        Cart::where('user_id', Auth::id())->delete();


        return redirect('/client/dashboard')
            ->with('success', 'Order created successfully');

    }



    public function clientOrders()
    {

        $orders = Order::with(['items.item'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('client.orders', compact('orders'));

    }



    public function adminOrders()
    {

        $orders = Order::with(['user', 'items.item'])
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));

    }

    public function applyDiscount($id)
    {
        $order = Order::findOrFail($id);

        // Apply 20% Senior/PWD discount
        $order->discount = 0.2;

        $order->save();

        return back()->with('success', 'Senior/PWD discount applied');
    }



    public function approve($id)
    {

        $order = Order::findOrFail($id);

        if ($order->status != 'pending') {

            return back()->with('error', 'Only pending orders can be approved');

        }

        $order->status = 'approved';
        $order->save();

        return back()->with('success', 'Order approved successfully');

    }



    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled');
        }

        $order->status = 'cancelled';
        $order->save();

        Message::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'message' => $request->message
        ]);

        return back()->with('success', 'Order cancelled & message sent');
    }

    public function updatePayment(Request $request, $id)
{
    $order = Order::with('items')->findOrFail($id);

    $request->validate([
        'payment' => 'required|numeric|min:0'
    ]);

    // ✅ Compute original total
    $total = $order->items->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // ✅ Get discount (default 0)
    $discount = $order->discount ?? 0;

    // ✅ Apply discount
    $discountedTotal = $total - ($total * $discount);

    // ✅ Update payment
    $order->payment = $request->payment;

    // ✅ UPDATE STATUS BASED ON PAYMENT
    if ($order->payment <= 0) {
        // no payment yet
        $order->status = 'approved';
    } elseif ($order->payment < $discountedTotal) {
        // partial payment
        $order->status = 'approved';
    } else {
        // fully paid
        $order->status = 'completed';
    }

    $order->save();

    return back()->with('success', 'Payment updated successfully');
}

    public function clientCancel($id)
    {
        $order = Order::findOrFail($id);

        // Ensure user owns the order
        if ($order->user_id != Auth::id()) {
            return back()->with('error', 'Unauthorized action');
        }

        // Prevent cancelling completed/cancelled
        if (in_array($order->status, ['completed', 'cancelled', 'rejected'])) {
            return back()->with('error', 'This order cannot be cancelled');
        }

        $order->status = 'cancelled';
        $order->save();

        return back()->with('success', 'Order cancelled successfully');
    }

}