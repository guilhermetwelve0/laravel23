<?php

namespace App\Services;

class TenantManager
{
    protected static $tenantId;

    public static function setTenantId($id)
    {
        self::$tenantId = $id;
    }

    public static function getTenantId()
    {
        return self::$tenantId;
    }
}
