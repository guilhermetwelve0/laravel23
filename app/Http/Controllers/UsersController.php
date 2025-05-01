<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function users_list()
    {
        $data['getRecord'] = User::getRecord();
        return view('users.list', $data);
    }

    public function users_delete($id)
    {
        if (auth()->user()->id == 5) {
            return redirect('admin/users')->with('error', 'Acesso negado para este usuário.');
        }
        $delete = User::find($id);
        $delete->is_delete = 1; // Marcando como excluído (soft delete)
        $delete->save();
        return redirect()->back()->with('success', "Registro excluído com sucesso");
    }

    // Exibe o formulário para cadastro de um novo usuário por admin
    public function register()
    {
        return view('admin.register_user'); // nova view
    }

    // Processa o registro de um novo usuário
    public function store(Request $request)
    {
        // Validação básica (adicione suas regras conforme necessário)
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
        ]);

        // Cria o novo usuário; definimos is_role como 2 (usuário comum),
        // ou conforme sua lógica de negócio
        $user = \App\Models\User::create([
            'name'     => trim($validated['name']),
            'is_role'  => 2,
        ]);

        return redirect()->route('admin.users.register')
             ->with('success', 'Usuário registrado com sucesso.');
    }
}
