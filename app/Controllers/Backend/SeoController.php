<?php

namespace App\Controllers\Backend;
use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MediaModel;
use App\Services\Backend\MediaService;


/**
 * Class Seo.
 */
class SeoController extends AdminBaseController
{
    use ResponseTrait;
    protected MediaService $MediaService;

    public function __construct()
    {
        $this->MediaService = new MediaService();
    }

    public function edit()
    {   
        $lang = $this->request->getGet('lang');
        if(empty($lang) || !in_array($lang,config('App')->supportedLocales)){
            $lang = config('App')->defaultLocale;
        }
        
        $config = config('Config\SiteLang\\'.$lang);
        
        return view('Backend/Seo/write', [
            'title'    => lang('Haoadmin.seo.title'),
            'data'   => $config,
            'lang'  => $lang
        ]);
    }
        
    public function update()
    {   
        // 字段白名单
        $allowed = [
            'site_name',
            'company_name',
            'company_name_en',
            'company_ceo',
            'company_fax',
            'company_address',
            'company_address1',
            'company_address2',
            'company_address3',
            'company_base_email',
            'company_phone',
            'company_email',
            'company_phone1',
            'company_email1',
            'company_phone2',
            'company_email2',
            'company_phone3',
            'company_email3',
            'company_number',
            'company_sales_number',
            'meta_tags',
            'meta_description',
            'meta_keywords',
            'og_image',
            'lang',
        ];
        
        // 过滤白名单字段
        $data = array_intersect_key($this->request->getPost(), array_flip($allowed));
        
        $lang = $this->request->getPost('lang');
        if(!in_array($lang, config('App')->supportedLocales)){
            return redirect()->back()->with('sweet-error', "Can not find language: {$lang}");
        }

        // 1. 生成配置文件内容
        $content = $this->buildConfigFile($data, $lang);
        
        $configFile = APPPATH . 'Config/SiteLang/' . $lang . '.php';
        $tmp = $configFile . '.tmp';

        // 2. 写入临时文件
        file_put_contents($tmp, $content, LOCK_EX);

        $isSyntaxValid = true;
        try {
            // 使用 token_get_all 解析生成的代码，如果有致命语法错误会抛出异常或返回 false
            // 这种方式比 exec 更快、更安全
            if (@token_get_all($content) === false) {
                $isSyntaxValid = false;
            }
        } catch (\Throwable $e) {
            $isSyntaxValid = false;
        }

        if (!$isSyntaxValid) {
            if (file_exists($tmp)) unlink($tmp);
            return redirect()->back()->with('sweet-error', 'Generated Config has syntax errors');
        }

        // 3. 校验通过，正式替换文件
        rename($tmp, $configFile);

        // 4. 转存 og_image
        $ogImageId = $this->request->getPost('og_image');
        if($ogImageId){
            $this->MediaService->saveOgImage($ogImageId, $lang);
        }

        // 5. 清理缓存 (防止旧配置生效)
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        return redirect()->back()->with('sweet-success', 'Update Success');
    }
    //生成配置文件
    private function buildConfigFile(array $data,string $lang): string
{
return <<<PHP
<?php

namespace Config\SiteLang;

use CodeIgniter\Config\BaseConfig;

class {$lang} extends BaseConfig
{
    public string \$site_name = {$this->export($data, 'site_name')};
    public string \$company_name = {$this->export($data, 'company_name')};
    public string \$company_name_en = {$this->export($data, 'company_name_en')};
    public string \$company_ceo = {$this->export($data, 'company_ceo')};
    public string \$company_phone = {$this->export($data, 'company_phone')};
    public string \$company_phone1 = {$this->export($data, 'company_phone1')};
    public string \$company_phone2 = {$this->export($data, 'company_phone2')};
    public string \$company_phone3 = {$this->export($data, 'company_phone3')};
    public string \$company_fax = {$this->export($data, 'company_fax')};
    public string \$company_address = {$this->export($data, 'company_address')};
    public string \$company_address1 = {$this->export($data, 'company_address1')};
    public string \$company_address2 = {$this->export($data, 'company_address2')};
    public string \$company_address3 = {$this->export($data, 'company_address3')};
    public string \$company_base_email = {$this->export($data, 'company_base_email')};
    public string \$company_email = {$this->export($data, 'company_email')};
    public string \$company_email1 = {$this->export($data, 'company_email1')};
    public string \$company_email2 = {$this->export($data, 'company_email2')};
    public string \$company_email3 = {$this->export($data, 'company_email3')};
    public string \$company_number = {$this->export($data, 'company_number')};
    public string \$company_sales_number = {$this->export($data, 'company_sales_number')};
    public string \$meta_tags = {$this->export($data, 'meta_tags')};
    public string \$meta_description = {$this->export($data, 'meta_description')};
    public string \$meta_keywords = {$this->export($data, 'meta_keywords')};
}
PHP;
}
    private function export(array $data, string $key): string
    {
        return var_export($data[$key] ?? '', true);
    }
}
