<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function showLogin()
    {
        Log::info('Login page accessed');

        return view('auth.login', [
            'foods' => \App\Models\Item::where('category','food')->take(100)->get(),
            'drinks' => \App\Models\Item::where('category','drink')->take(100)->get(),
            'desserts' => \App\Models\Item::where('category','dessert')->take(100)->get(),
        ]);
        
    }

    public function showRegister()
    {
        Log::info('Register page accessed');

        return view('auth.register', [
            'foods' => \App\Models\Item::where('category','food')->take(100)->get(),
            'drinks' => \App\Models\Item::where('category','drink')->take(100)->get(),
            'desserts' => \App\Models\Item::where('category','dessert')->take(100)->get(),
        ]);
    }

    public function register(Request $request)
    {
        try {

            Log::info('User registration attempt', [
                'name' => $request->name,
                'phone_number' => $request->phone_number
            ]);

            $request->validate([
                'name' => 'required|string|max:255',

                'phone_number' => [
                    'required',
                    'digits:11',           // exactly 11 digits
                    'numeric',             // numbers only
                    'unique:users,phone_number'
                ],

                'password' => 'required|min:6'
            ],[
                'phone_number.digits' => 'Phone number must be exactly 11 digits.',
                'phone_number.numeric' => 'Phone number must contain only numbers.',
                'phone_number.unique' => 'This phone number is already registered.'
            ]);

            $user = User::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => 'client'
            ]);

            Log::info('User registered successfully', [
                'user_id' => $user->id,
                'phone_number' => $user->phone_number
            ]);

            return redirect('/login')->with('success','Account created successfully');

        } catch (\Exception $e) {

            Log::error('User registration failed', [
                'phone_number' => $request->phone_number ?? null,
                'error' => $e->getMessage()
            ]);

            return back()->with('error',$e->getMessage());
        }
    }

    public function login(Request $request)
    {

        Log::info('User login attempt', [
            'phone_number' => $request->phone_number
        ]);

        $credentials = $request->validate([
            'phone_number' => 'required',
            'password' => 'required'
        ]);
    
        if(Auth::attempt($credentials))
        {

            $request->session()->regenerate();

            Log::info('User login successful', [
                'user_id' => Auth::id(),
                'role' => Auth::user()->role
            ]);

            if(Auth::user()->role == 'admin'){
                return redirect('/admin/dashboard')
                    ->with('success','Login successful. Welcome back!');
            }

            return redirect('/client/dashboard')
                ->with('success','Login successful. Welcome back!');
        }

        Log::warning('User login failed', [
            'phone_number' => $request->phone_number
        ]);
    
        return back()->with('error','Invalid phone number or password');
    }

    public function logout(Request $request)
    {

        Log::info('User logout', [
            'user_id' => Auth::id()
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success','Logged out successfully');
    }

    public function showAdminLogin()
    {

        Log::info('Admin login page accessed');

        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {

        Log::info('Admin login attempt', [
            'phone_number' => $request->phone_number
        ]);

        $request->validate([
            'phone_number'=>'required',
            'password'=>'required'
        ]);

        $credentials = [
            'phone_number'=>$request->phone_number,
            'password'=>$request->password,
            'role'=>'admin'
        ];

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            Log::info('Admin login successful', [
                'admin_id' => Auth::id()
            ]);

            return redirect('/admin/dashboard')
                ->with('success','Admin login successful');
        }

        Log::warning('Admin login failed', [
            'phone_number' => $request->phone_number
        ]);

        return back()->with('error','Invalid admin credentials');
    }

    
}