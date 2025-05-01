<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\TenantManager;

class ApplyTenantScope
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->is_role == 1) {
                TenantManager::setTenantId(Auth::id());
            } else {
                TenantManager::setTenantId(Auth::user()->tenant_id);
            }
        }

        return $next($request);
    }
}