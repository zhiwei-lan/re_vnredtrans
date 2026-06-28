<?php

namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ArticlesLangModel extends Model
{
    protected $table = 'articles_lang';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    //可添加修改的字段 防止大规模赋值漏洞
    protected $allowedFields = [ 
        'title',
        'subject',
        'description',
        'lang',
        'article_id',
        'content_delta',
        'content_html',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    // Validation 字段验证规则
    protected $validationRules = [
        'title' => 'required|min_length[2]|max_length[255]',
        'meta_title'       => 'permit_empty|max_length[255]',
        'meta_keywords'    => 'permit_empty|max_length[255]',
        'meta_description' => 'permit_empty|max_length[255]',
    ];

     // Callbacks 模型事件回调
    protected $allowCallbacks = true;
    protected $beforeInsert = ['addCreatedBy'];
    protected $beforeUpdate = ['addUpdatedBy'];

    // 创建者  
    protected function addCreatedBy(array $data)
    {
        // 如果已经设置了created_by，则不覆盖
        if (!isset($data['data']['created_by']) || empty($data['data']['created_by'])) {
            // 尝试从认证系统获取用户
            $user = auth()->user();
            if ($user && isset($user->id)) {
                $data['data']['created_by'] = $user->id;
            }
            // 如果获取不到用户（如在CLI中），则使用系统用户ID 0
            else {
                $data['data']['created_by'] = 0;
            }
        }
        return $data;
    }

    // 修改者
    protected function addUpdatedBy(array $data)
    {
        // 如果已经设置了updated_by，则不覆盖
        if (!isset($data['data']['updated_by']) || empty($data['data']['updated_by'])) {
            // 尝试从认证系统获取用户
            $user = auth()->user();
            if ($user && isset($user->id)) {
                $data['data']['updated_by'] = $user->id;
            }
            // 如果获取不到用户（如在CLI中），则使用系统用户ID 0
            else {
                $data['data']['updated_by'] = 0;
            }
        }
        return $data;
    }

}