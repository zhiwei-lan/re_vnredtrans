<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\LanguageModel;
use CodeIgniter\API\ResponseTrait;

/**
 * Class LanguageController.
 */
class LanguageController extends AdminBaseController
{
    use ResponseTrait;

    protected $LanguageModel;

    public function __construct()
    {
        $this->LanguageModel = new LanguageModel();
    }


    // 获取
    public function show()
    {
        $params = $this->request->getGet();
        $found = $this->LanguageModel
            ->where('trans_id', $params['trans_id'])
            ->where('trans_type', $params['trans_type'])
            ->where('lang', $params['lang'])
            ->first();
        if ($this->request->isAJAX()) {
            return $this->respond([
                'data' => $found
            ]);
        }
    }

    // 更新
    public function write()
    {
        $params = $this->request->getPost();
        if (! $this->LanguageModel->save($params)) {
            return $this->fail($this->LanguageModel->errors());
        }
        return $this->respondUpdated('Successfully saved.');
    }
}
