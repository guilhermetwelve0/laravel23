<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use Auth;
use Request;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    static public function getRecord()
    {
        // return self::get();
        $return = self::select('supplier.*');
        if(!empty(Request::get('id')))
        {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if(!empty(Request::get('supplier_name')))
        {
            $return = $return->where('supplier_name', 'like', '%'.Request::get('supplier_name').'%');
        }
        if(!empty(Request::get('supplier_telephone')))
        {
            $return = $return->where('supplier_telephone', 'like', '%'.Request::get('supplier_telephone').'%');
        }
        if(!empty(Request::get('supplier_address')))
        {
            $return = $return->where('supplier_address', 'like', '%'.Request::get('supplier_address').'%');
        }
        if(!empty(Request::get('created_at')))
        {
            $return = $return->where('created_at', 'like', '%'.Request::get('created_at').'%');
        }
        if(!empty(Request::get('updated_at')))
        {
            $return = $return->where('updated_at', 'like', '%'.Request::get('updated_at').'%');
        }
        $return = $return->orderBy('id', 'asc')->paginate(5);
        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function TotalSupplierCount()
    {
        return self::count();
    }
    static public function recordInsert($request)
    {
        try {
           $save = new self();
           $save-> supplier_name = trim($request->supplier_name);
           $save->tenant_id = Auth::id();
           $save-> supplier_telephone = trim($request->supplier_telephone);
           $save-> supplier_address = trim($request->supplier_address);
           $save-> created_at = Carbon::now('America/Sao_Paulo');
           $save-> updated_at = Carbon::now('America/Sao_Paulo');
           $save->save();
        } catch (\Throwable $e) {
            \Log::error("Error saving record: " . $e->getMessage());
            throw $e;
        }
    }
    static public function recordUpdate($request, $id)
    {
        try {
            $save = self::getSingle($id);
            $save-> supplier_name = trim($request->supplier_name);
           $save-> supplier_telephone = trim($request->supplier_telephone);
           $save-> supplier_address = trim($request->supplier_address);
           $save-> created_at = Carbon::now('America/Sao_Paulo');
           $save-> updated_at = Carbon::now('America/Sao_Paulo');
           $save->save();
        } catch (\Throwable $e) {
            \Log::error("Error updating record: " . $e->getMessage());
            throw $e;
        }
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