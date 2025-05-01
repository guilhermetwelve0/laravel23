<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminUserRelationship;

class AdminController extends Controller
{
    public function linkUsersForm()
    {
        if (auth()->user()->id != 1) {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        $admins = User::where('is_role', 1)->get();
        $users = User::where('is_role', 2)->get();

        return view('admin.link_users', compact('admins', 'users'));
    }

    public function linkUsers(Request $request)
    {
        if (auth()->user()->id != 1) {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        $request->validate([
            'admin_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);

        AdminUserRelationship::create([
            'admin_id' => $request->admin_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Usuário vinculado ao administrador com sucesso.');
    }
}