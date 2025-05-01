<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ResetPassword;
use App\Mail\ForgotPasswordMail;
use Auth;
use Carbon\Carbon;
use Hash;
use Str;
use Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (Auth::User()->is_role == '1') {
                return redirect()->intended('admin/dashboard');
            } else if (Auth::User()->is_role == '2') {
                return redirect()->intended('user/dashboard');
            } else {
                return redirect('/')->with('error', 'Nenhum e-mail disponível..');
            }
        } else {
            return redirect()->back()->with('error', 'Por favor, insira as credenciais corretas');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgot(Request $request)
    {
        return view('auth.forgot');
    }

    public function forgot_post(Request $request)
    {
        $count = User::where('email', '=', $request->email)->count();
        if ($count > 0) {
            $user = User::where('email', '=', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'A senha foi redefinida.');
        } else {
            return redirect()->back()->withInput()->with('error', 'E-mail não encontrado no sistema.');
        }
    }

    public function getReset($token)
    {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first(); 
        $data['token'] = $token;
        return view('auth.reset', $data);
    }

    public function getResetPost($token, ResetPassword $request)
    {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();
        return redirect('/')->with('success', 'A senha foi redefinida.');
    }

    public function registration(Request $request)
    {
        return view('auth.registration');
    }

    public function registration_post(Request $request)
    {
        $save = request()->validate([
            'email' => 'required|unique:users',
        ]);
        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->remember_token = Str::random(50);
        $save->is_role = 2;
        $save->created_at = Carbon::now('America/Sao_Paulo');
        $save->updated_at = Carbon::now('America/Sao_Paulo');
        $save->save();
        return redirect('/')->with('success', 'Cadastro realizado com sucesso.');
    }
}
