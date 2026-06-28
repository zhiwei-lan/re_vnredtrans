<?php

namespace App\Controllers\Backend;
use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MediaModel;
use App\Services\Backend\MediaService;


/**
 * Class Config.
 */
class ConfigController extends AdminBaseController
{
    use ResponseTrait;
    private string $configFile;
    protected MediaService $MediaService;

    public function __construct()
    {
        $this->configFile = APPPATH . 'Config/Site.php';
        $this->MediaService = new MediaService();
    }

    public function edit()
    {   
        $config = config('Site', false);
        return view('Backend/Config/write', [
            'title'    => lang('Haoadmin.config.title'),
            'data'   => $config
        ]);
    }

    public function testmail()
    {   
        //email 发送测试
        $params = $this->request->getPost();
        //载入email服务
        $email = service('email');
        //根据设置初始化email服务 
        //注意！此处为测试用途 根据前台发送数据初始化email服务 
        //实际业务无需配置初始化选项 默认读取网站设置内的配置项
        $config['protocol'] = $params['email_protocol'];
        if($params['email_protocol']=='smtp'){
            $config['SMTPHost'] = $params['email_smtp_host'];
            $config['SMTPUser'] = $params['email_smtp_user'];
            $config['SMTPPass'] = $params['email_smtp_pass'];
            $config['SMTPPort'] = (int)$params['email_smtp_port'];
        }
        $email->initialize($config);
        //发送内容
        $email->setFrom($params['email_from'], $params['email_from_name']);
        $email->setTo($params['email_to']);
        $email->setSubject('이메일 알림 테스트');
        $email->setMessage('이 메일을 받으셨다면 웹사이트의 이메일 알림 시스템이 정상적으로 설정되었음을 의미합니다.');
        //发送
        if (! $email->send()) {
            return redirect()->back()->with('sweet-error', 'Send Error');
        }
        return redirect()->back()->with('sweet-success', 'Send Success');
    }

    public function update()
    {   
        // 字段白名单
        $allowed = [
            'meta_tags',
            'meta_description',
            'meta_keywords',
            'email_from',
            'email_from_name',
            'email_protocol',
            'email_smtp_host',
            'email_smtp_user',
            'email_smtp_pass',
            'email_smtp_port',
            'file_max_size',
            'map_key_google',
            'map_key_daum',
            'map_loaction1',
            'map_loaction2',
            'favicon',
            'login_kakao_client_id',
            'login_kakao_client_secret',
            'login_naver_client_id',
            'login_naver_client_secret',
        ];
        // 过滤白名单字段
        $data = array_intersect_key($this->request->getPost(), array_flip($allowed));

        // 1. 生成配置文件内容
        $content = $this->buildConfigFile($data);
        
        // 2. 写入临时文件
        $tmp = $this->configFile . '.tmp';
        file_put_contents($tmp, $content, LOCK_EX);

        // --- 使用 Token 扫描替代 exec 检查语法 ---
        $isSyntaxValid = true;
        try {
            // @ 符号抑制潜在的解析警告，通过返回结果判断逻辑
            if (@token_get_all($content) === false) {
                $isSyntaxValid = false;
            }
        } catch (\Throwable $e) {
            $isSyntaxValid = false;
        }

        if (!$isSyntaxValid) {
            if (file_exists($tmp)) unlink($tmp);
            return redirect()->back()->with('sweet-error', 'Config syntax error');
        }
        // ----------------------------------------

        // 3. 校验通过，重命名为正式文件
        rename($tmp, $this->configFile);

        // 4. 生成 favicon.ico
        $faviconId = $this->request->getPost('favicon');
        if($faviconId){
            try {
                $this->MediaService->pngToIcoPure($faviconId);
            } catch (\Throwable $e) {
                return redirect()->back()->with('sweet-error', $e->getMessage());
            }
        }

        // 5. 清理缓存
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        return redirect()->back()->with('sweet-success', 'Update Success');
    }
    //生成配置文件
    private function buildConfigFile(array $data): string
{
return <<<PHP
<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Site extends BaseConfig
{
    public string \$login_kakao_client_id = {$this->export($data, 'login_kakao_client_id')};
    public string \$login_kakao_client_secret = {$this->export($data, 'login_kakao_client_secret')};
    public string \$login_naver_client_id = {$this->export($data, 'login_naver_client_id')};
    public string \$login_naver_client_secret = {$this->export($data, 'login_naver_client_secret')};
    public string \$map_loaction1 = {$this->export($data, 'map_loaction1')};
    public string \$map_loaction2 = {$this->export($data, 'map_loaction2')};
    public string \$map_key_google = {$this->export($data, 'map_key_google')};
    public string \$map_key_daum = {$this->export($data, 'map_key_daum')};
    public string \$email_from = {$this->export($data, 'email_from')};
    public string \$email_from_name = {$this->export($data, 'email_from_name')};
    public string \$email_protocol = {$this->export($data, 'email_protocol')};
    public string \$email_smtp_host = {$this->export($data, 'email_smtp_host')};
    public string \$email_smtp_user = {$this->export($data, 'email_smtp_user')};
    public string \$email_smtp_pass = {$this->export($data, 'email_smtp_pass')};
    public string \$email_smtp_port = {$this->export($data, 'email_smtp_port')};
    public string \$file_max_size = {$this->export($data, 'file_max_size')};
}
PHP;
}
    private function export(array $data, string $key): string
    {
        return var_export($data[$key] ?? '', true);
    }
}
