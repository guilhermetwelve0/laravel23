<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\UserSession;
use Carbon\Carbon;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        $user = $event->user;
        if ($user) {
            $session = UserSession::where('user_id', $user->id)
                ->orderBy('login_at', 'desc')
                ->first();
            if ($session) {
                $session->update(['logout_at' => Carbon::now('America/Sao_Paulo')]);
            }
        }
    }
}
