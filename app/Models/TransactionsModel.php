<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantManager;
use Auth;

class TransactionsModel extends Model
{
    use HasFactory;

    protected $table = 'transactions'; // Define o nome da tabela corretamente

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'description',
        'tenant_id', // Add tenant_id to fillable
    ];

    // Adicionando relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Adicionando relacionamento com o modelo ProductModel
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = TenantManager::getTenantId();
            if ($tenantId) {
                $builder->where('transactions.tenant_id', Auth::id());
            }
        });
    }
}
