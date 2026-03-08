<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function create()
    {
        $foods = Item::where('category','food')->get();
        $drinks = Item::where('category','drink')->get();
        $desserts = Item::where('category','dessert')->get();

        return view('client.create_order',compact('foods','drinks','desserts'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string|max:255',
            'guest_count' => 'required|integer|min:1',
            'items' => 'required|array|min:1'
        ]);


        $order = Order::create([
            'user_id' => Auth::id(),
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'event_location' => $request->event_location,
            'guest_count' => $request->guest_count,
            'status' => 'pending'
        ]);


        foreach($request->items as $item_id){

            $item = Item::find($item_id);

            if($item){

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item_id,
                    'quantity' => 1,
                    'price' => $item->price
                ]);

            }

        }


        return redirect('/client/orders')
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

}