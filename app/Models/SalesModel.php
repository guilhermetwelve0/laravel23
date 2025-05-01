<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use Auth;
use Request;

class SalesModel extends Model
{
    use HasFactory;
    protected $table = 'sales';
    static public function TotalSalescount()
    {
        return self::count();
    }

    protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = TenantManager::getTenantId();
            if ($tenantId) {
                $builder->where('sales.tenant_id', Auth::id());
            }
        });
    }

    public function transaction()
    {
        return $this->belongsTo(TransactionsModel::class, 'transaction_id');
    }
}