<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | CLIENT INBOX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // Mark all messages as read FIRST
        Message::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Then fetch messages
        $messages = Message::with('order')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('client.inbox', compact('messages'));
    }

    public function markAsRead()
    {
        Message::where('user_id', Auth::id())
            ->update(['is_read' => true]);

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | STORE MESSAGE (used by admin cancel)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'order_id' => 'required',
            'message' => 'required|string'
        ]);

        Message::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'message' => $request->message,
            'is_read' => false
        ]);

        return back()->with('success','Message sent');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE MESSAGE (optional)
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        // Only owner can delete
        if($message->user_id != Auth::id()){
            return back()->with('error','Unauthorized');
        }

        $message->delete();

        return back()->with('success','Message deleted');
    }

}