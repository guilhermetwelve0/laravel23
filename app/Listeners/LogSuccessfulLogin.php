<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\UserSession;
use Carbon\Carbon;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;
        UserSession::create([
            'user_id'    => $user->id,
            'email'      => $user->email,  // Registra o email
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'login_at'   => Carbon::now('America/Sao_Paulo'),
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
        ]);
    }
}
