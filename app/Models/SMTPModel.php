<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMTPModel extends Model
{
    use HasFactory;

    protected $table = 'smtp';
    protected $fillable = [
        'user_id', 'app_name', 'mail_mailer', 'mail_host',
        'mail_port', 'mail_username', 'mail_password',
        'mail_encryption', 'mail_from_address',
    ];

    public static function getUserSMTP($userId)
    {
        return self::firstOrNew(['user_id' => $userId]);
    }
}
