<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search/Filter logic (Optional but good for UX)
        if ($request->filled('filter_name')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filter_name . '%')
                ->orWhere('email', 'like', '%' . $request->filter_name . '%');
            });
        }

        if ($request->filled('filter_role')) {
            $query->where('role', $request->filter_role);
        }

        $users = $query->latest()->paginate(10);

        // Simple index view
        return view('users.index', compact('users'));
    }

    /**
     * Show the index page with Create Mode enabled.
     */
    public function create()
    {
        $users = User::latest()->paginate(10);
        $createMode = true; // Isse index page par form open hoga
        
        return view('users.index', compact('users', 'createMode'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric',
            'role' => 'required|in:admin,user',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Show the index page with Edit Mode and User data.
     */
    public function edit(User $user)
    {
        $users = User::latest()->paginate(10);
        $editMode = true; // Isse index page par form populated dikhega
        
        return view('users.index', compact('users', 'user', 'editMode'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|numeric',
            'role' => 'required|in:admin,user',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
   public function bulkDelete(Request $request)
{
    // Check if IDs are coming
    if (!$request->has('ids') || empty($request->ids)) {
        return response()->json(['status' => 'error', 'message' => 'Koi user select nahi kiya!'], 400);
    }

    // Delete users
    User::whereIn('id', $request->ids)->delete();

    return response()->json(['status' => 'success']);
}

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }
}