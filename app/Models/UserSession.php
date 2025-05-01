<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',      // Campo para armazenar o email
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'created_at',
        'updated_at',
    ];
}
