<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Task;

class UserController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function register(Request $request) {
        $incomingData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $incomingData['password'] = Hash::make($incomingData['password']);
        $user = User::create($incomingData);
        
        Auth::login($user);
        
        return redirect('/dashboard')->with('success', 'Registration successful! Welcome to your dashboard.');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    public function dashboard() {
        $upcomingTasks = Auth::user()->tasks()
            ->where('completed', false)
            ->whereNotNull('due_date')
            ->orderBy('due_date')
            ->limit(5)
            ->get();
            
        return view('dashboard', compact('upcomingTasks'));
    }

    public function profile() {
        return view('profile');
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();
        
        $incomingData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($incomingData);
        
        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
