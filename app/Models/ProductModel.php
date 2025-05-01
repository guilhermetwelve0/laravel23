<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use Auth;
use Request;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'category_id', 'product_code', 'name_product', 'brand',
        'purchase_price', 'selling_price', 'discount', 'stock', 'tenant_id'
    ];
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
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