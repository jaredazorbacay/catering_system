<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
{

    $foods = Item::where('category','food')->get();
    $drinks = Item::where('category','drink')->get();
    $desserts = Item::where('category','dessert')->get();

    $cartItems = Cart::with('item')
        ->where('user_id',Auth::id())
        ->get();

    $total = 0;

    foreach($cartItems as $cart){
        $total += $cart->item->price * $cart->quantity;
    }

    return view('client.cart',[
        'foods'=>$foods,
        'drinks'=>$drinks,
        'desserts'=>$desserts,
        'cartItems'=>$cartItems,
        'total'=>$total
    ]);
}



    public function add(Request $request)
    {

        $item = Item::findOrFail($request->item_id);

        $cart = Cart::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->first();

        if ($cart) {

            $cart->quantity += $request->quantity;
            $cart->save();

        } else {

            Cart::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
                'quantity' => $request->quantity
            ]);

        }

        return back()->with('success','Item added to cart');
    }


    public function update(Request $request)
    {

        $cart = Cart::findOrFail($request->cart_id);

        $cart->quantity = $request->quantity;

        $cart->save();

        return back();
    }


    public function remove($id)
    {
    
        $cart = Cart::where('id',$id)
            ->where('user_id',Auth::id())
            ->first();
    
        if($cart){
            $cart->delete();
        }
    
        return back();
    
    }


    public function show($id)
    {

        $item = Item::findOrFail($id);

        return view('client.cart_item',compact('item'));

    }




    public function clear()
    {

        Cart::where('user_id',Auth::id())->delete();

        return back();

    }


}