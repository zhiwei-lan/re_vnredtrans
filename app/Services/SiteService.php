<?php
namespace App\Services;

use Config\App;

class SiteService
{
    public static function getSiteInfo()
    {
        $locale = service('lang')->getLocale();
        $site = config('Config\SiteLang\\'.$locale);
        if(empty($site)){
            $site = config('Config\SiteLang\\'.config('App')->defaultLocale);
        }
        return $site;
    }
}
