<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Protect routes
    }

    public function index()
    {
        $users = User::where('role', 'voter')->get();
        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'voter', // Default to voter
        ]);

        return redirect()->route('admin.index')->with('success', 'User Created Successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User Deleted!');
    }
}


