<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Class Boilerplate.
 */
class Haoadmin extends BaseConfig
{
    //--------------------------------------------------------------------------
    // App name
    //--------------------------------------------------------------------------

    public $appName = 'Hao Admin';

    //--------------------------------------------------------------------------
    // Dashboard controller
    //--------------------------------------------------------------------------

    public $dashboard = [
        'namespace'  => 'Controllers\Backend',
        'controller' => 'DashboardController::index',
        'filter'     => 'permission:back-office',
    ];

    public $i18n = 'ko';

    public $theme = [
        'body-sm' => false,
        'navbar'  => [
            'bg'     => 'white',
            'type'   => 'light',
            'border' => true,
            'user'   => [
                'visible' => true,
                'shadow'  => 0,
            ],
        ],
        'sidebar' => [
            'type'    => 'dark',
            'shadow'  => 4,
            'border'  => false,
            'compact' => true,
            'links'   => [
                'bg'     => 'blue',
                'shadow' => 1,
            ],
            'brand' => [
                'bg'   => 'gray-dark',
                'logo' => [
                    'icon'   => 'favicon.ico', // path to image | this example icon on public root folder.
                    'text'   => '<strong>HAO</strong>admin',
                    'shadow' => 2,
                ],
            ],
            'user' => [
                'visible' => false,
                'shadow'  => 2,
            ],
        ],
        'footer' => [
            'fixed'      => false,
            'vendorname' => 'firstd.co.kr',
            'vendorlink' => 'http://web.firstd.co.kr/',
        ],
    ];
}