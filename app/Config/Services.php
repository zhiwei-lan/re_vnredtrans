<?php

namespace Config;

use CodeIgniter\Config\BaseService;
/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    public static function lang(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('lang');
        }

        return new \App\Services\LangService();
    }
    public static function site(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('site');
        }

        return new \App\Services\SiteService();
    }
    public static function emailQueue($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('emailQueue');
        }
        return new \App\Services\EmailQueueService();
    }
    public static function smsManager($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('smsManager');
        }
        return new \App\Libraries\SMSManager();
    }
}
