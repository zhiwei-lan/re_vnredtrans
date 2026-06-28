<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Site extends BaseConfig
{
    public string $login_kakao_client_id = 'aff825e523092b82d453e50c5fc7996b';
    public string $login_kakao_client_secret = 'eleoFhGy2AqYtGTKD5CUwYTGb0G5qiEd';
    public string $login_naver_client_id = 'sy5JUJLk1euw4NOncp8S';
    public string $login_naver_client_secret = '3CwC31js2k';
    public string $map_loaction1 = '36.8829664,128.5293725';
    public string $map_loaction2 = '';
    public string $map_key_google = 'AIzaSyCBu2I93G-q31LtElIMQ7WRl_T1uG3Si7o&callback';
    public string $map_key_daum = '';
    public string $email_from = 'designfox@foxmail.com';
    public string $email_from_name = '농업회사법인(주)네이처포스';
    public string $email_protocol = 'smtp';
    public string $email_smtp_host = 'smtp.qq.com';
    public string $email_smtp_user = 'designfox@foxmail.com';
    public string $email_smtp_pass = 'lpmtozwrdgmzbggd';
    public string $email_smtp_port = '465';
    public string $file_max_size = '3';
}