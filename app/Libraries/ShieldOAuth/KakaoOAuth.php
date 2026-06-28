<?php

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;
use \Config\Services;
use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;

class KakaoOAuth extends AbstractOAuth
{
    /** @var string $API_CODE_URL The API URL to get the Auth Code. */
    private static $API_CODE_URL = 'https://kauth.kakao.com/oauth/authorize';

    /** @var string $API_TOKEN_URL The API URL to get the Auth token. */
    private static $API_TOKEN_URL = 'https://kauth.kakao.com/oauth/token';

    /** @var string $API_USER_INFO_URL The API URL to get the user info. */
    private static $API_USER_INFO_URL = 'https://kapi.kakao.com/v2/user/me';

    /** @var string $APPLICATION_NAME The name of this application. */
    private static $APPLICATION_NAME = 'ShieldOAuth';

    protected string $token;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    /**
     * Class construct
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $token
     */
    public function __construct(string $token = '')
    {
        $this->token  = $token;
        $options = [
            'verify' => false, // 禁用证书检查
        ];
        $this->client = Services::curlrequest($options);

        

        $this->config        = config('ShieldOAuthConfig');
        $this->callback_url  = base_url('oauth/' . $this->config->call_back_route);
        $this->client_id     = env('ShieldOAuthConfig.kakao.client_id', $this->config->oauthConfigs['kakao']['client_id']);
        $this->client_secret = env('ShieldOAuthConfig.kakao.client_secret', $this->config->oauthConfigs['kakao']['client_secret']);
    }

    /**
     * Create a link to transfer the user to the new provider.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $state
     * @return string
     */
    public function makeGoLink(string $state): string
    {
        $kakaoURL= self::$API_CODE_URL."?response_type=code&client_id={$this->client_id}&redirect_uri={$this->callback_url}&state={$state}";
        return $kakaoURL;
    }

    /**
     * Try to get the value of `access_token` according to the code
     * received from the `makeGoLink()` method.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param array $allGet
     * @return void
     */
    public function fetchAccessTokenWithAuthCode(array $allGet): void
    {
        $options = [
            'verify' => false, // 禁用证书检查
        ];
        $client = \Config\Services::curlrequest($options);
        try {
            //send request to API URL
            $response = $client->request('POST', self::$API_TOKEN_URL, [
                'form_params' => [
                        'client_id'     => $this->client_id ,
                        'client_secret' => $this->client_secret ,
                        'redirect_uri'  => $this->callback_url,
                        'code'          => $allGet['code'],
                        'grant_type'    => 'authorization_code'
                ],
                'http_errors' => false,
            ]);

        } catch (Exception $e) {
            die($e->getMessage());
        }
         $token = json_decode($response->getBody())->access_token;
         $this->setToken($token);
    }

    protected function fetchUserInfoWithToken(): object
    {
        // send request to API URL
        try {
            $response = $this->client->request('GET', self::$API_USER_INFO_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getToken(),
                ],
                'http_errors' => false,
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
         // getBody() 返回的是 Stream，需要转换成字符串
        $body = (string) $response->getBody();

        if (empty($body)) {
            throw new \Exception('Kakao API 返回空内容。');
        }
        // 解析 JSON
        $data = json_decode($body);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Kakao 用户信息 JSON 解析失败：' . json_last_error_msg());
        }
        // Kakao email 不在顶层，需要取 kakao_account
        $data->email = $data->kakao_account->email ?? null;
        $data->kakao_id = $data->id ?? null;
        $data->phone = $data->kakao_account->phone_number ?? null;
        return $data;
    }

    protected function setColumnsName(string $nameOfProcess, object $userInfo): array
    {
        if($nameOfProcess === 'syncingUserInfo'){
            $usersColumnsName = [
                'username'                                    => $userInfo->properties->nickname,
                'email'                                       => $userInfo->email,
                $this->config->usersColumnsName['phone']     => $userInfo->phone,
            ];
        }
        if($nameOfProcess === 'newUser'){
            $usersColumnsName = [
                'username'                                    => $userInfo->properties->nickname,
                'email'                                       => $userInfo->email,
                'password'                                    => random_string('crypto', 32),
                'active'                                      => 1,
                'kakao_id'                                    => $userInfo->kakao_id,
                $this->config->usersColumnsName['avatar']     => $userInfo->properties->profile_image,
                $this->config->usersColumnsName['phone']      => $userInfo->phone,
            ];
        }
        return $usersColumnsName;
    }
}