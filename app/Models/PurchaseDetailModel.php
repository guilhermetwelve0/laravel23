<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use Auth;
use App\Models\CategoryModel;
use Request;

class PurchaseDetailModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_detail';

    protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = TenantManager::getTenantId();
            if ($tenantId) {
                $builder->where('purchase_detail.tenant_id', Auth::id());
            }
        });
    }
}