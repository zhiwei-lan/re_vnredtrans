<?php

declare(strict_types=1);

/**
 * This file is part of Shield OAuth.
 *
 * (c) Datamweb <pooya_parsa_dadashi@yahoo.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use Datamweb\ShieldOAuth\Config\ShieldOAuthConfig as OAuthConfig;

class ShieldOAuthConfig extends OAuthConfig
{
    public function __construct()
    {
        //根据site配置 设定默认参数
        $site = config('Site');
        $this->oauthConfigs['kakao']['client_id'] = $site->login_kakao_client_id ?? '';
        $this->oauthConfigs['kakao']['client_secret'] = $site->login_kakao_client_secret ?? '';
        $this->oauthConfigs['naver']['client_id'] = $site->login_naver_client_id ?? '';
        $this->oauthConfigs['naver']['client_secret'] = $site->login_naver_client_id ?? '';
    }
    /**
     * --------------------------------------------------------------------------
     * OAuth Configs
     * --------------------------------------------------------------------------
     *
     * Set keys and active any OAuth
     *
     * Here you can set the keys received from any OAuth servers.
     * for more information on getting keys:
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/get_keys.md
     *
     * @var array<string, array<string, bool|string>>
     */
    public array $oauthConfigs = [
        'kakao' => [
            'client_id' => '',
            'client_secret' => '',

            'allow_login'    => true,
            'allow_register' => true,
        ],
        'naver' => [
            'client_id'     => '',
            'client_secret' => '',

            'allow_login'    => true,
            'allow_register' => true,
        ]
    ];

    /**
     * --------------------------------------------------------------------------
     * Users Columns Name
     * --------------------------------------------------------------------------
     * If you use different names for the columns in the users table, use the following settings.
     *
     * Data of Table "users":
     * +----+----------+--------+...+------------+-----------+--------+
     * | id | username | status |...| first_name | last_name | avatar |
     * +----+----------+--------+...+------------+-----------+--------+
     * In fact, you set in which column the information received from the OAuth services should be recorded.
     * For example, the first name received from OAuth should be recorded in column 'first_name' of the 'users' table shield.
     * NOTE :
     *       This is suitable for those who have already installed the shield and created their own columns.
     *       In this case, there is no need to execute `php spark migrate -n Datamweb\ShieldOAuth`.
     *       Just set the following values with your table columns.
     *
     * @var array<string, string>
     */
    public array $usersColumnsName = [
        'first_name' => 'first_name',
        'last_name'  => 'last_name',
        'avatar'     => 'avatar',
        'kakao_id' => 'kakao_id',
        'naver_id'  => 'naver_id',
        'phone'      => 'phone',
    ];

    /**
     * --------------------------------------------------------------------------
     * Syncing User Info
     * --------------------------------------------------------------------------
     * Turn ON/OFF user data update
     *
     * If the user is already registered, by default when trying to login, their
     * information will be synchronized. If you want to cancel it, set to false.
     */
    public bool $syncingUserInfo = true;

    /**
     * --------------------------------------------------------------------------
     * Call Back Route
     * --------------------------------------------------------------------------
     * Set your custom call-back name
     *
     * When the user login with his profile, the OAuth server directs him to the following path.
     * So change this value only when you need to customize it.
     * By default, it returns to the following path:
     *      http://localhost:8080/oauth/call-back
     */
    public string $call_back_route = 'call-back';
}
