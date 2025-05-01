<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use Auth;

class MemberModel extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected static function booted()
{
    static::addGlobalScope('tenant', function (Builder $builder) {
        $tenantId = TenantManager::getTenantId();
        if ($tenantId) {
            $builder->where('tenant_id', Auth::id());
        }
    });
}


}
