<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use App\Models\CategoryModel;
use Auth;
use Request;

class PurchaseModel extends Model
{
    use HasFactory;
    protected $table = 'purchase';

    static public function getRecord()
    {
        $return = self::select('purchase.*', 'supplier.supplier_name')
        ->join('supplier', 'purchase.supplier_id', '=', 'supplier.id')
        ->orderBy('id', 'asc');
        if(!empty(Request::get('id')))
        {
            $return = $return->where('purchase.id', '=', Request::get('id'));
        }
        if(!empty(Request::get('supplier_id')))
        {
            $return = $return->where('supplier.supplier_name', 'like', '%'.Request::get('supplier_id').'%');
        }
        if(!empty(Request::get('total_item')))
        {
            $return = $return->where('purchase.total_item', 'like', '%'.Request::get('total_item').'%');
        }
        if(!empty(Request::get('total_price')))
        {
            $return = $return->where('purchase.total_price', 'like', '%'.Request::get('total_price').'%');
        }
        if(!empty(Request::get('discount')))
        {
            $return = $return->where('purchase.discount', 'like', '%'.Request::get('discount').'%');
        }
        if(!empty(Request::get('created_at')))
        {
            $return = $return->where('purchase.created_at', 'like', '%'.Request::get('created_at').'%');
        }
        if(!empty(Request::get('updated_at')))
        {
            $return = $return->where('purchase.updated_at', 'like', '%'.Request::get('updated_at').'%');
        }
        $return = $return->orderBy('id', 'asc')->paginate(5);
        return $return;
    }

    protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = TenantManager::getTenantId();
            if ($tenantId) {
                $builder->where('purchase.tenant_id', Auth::id());
            }
        });
    }
    
    

}