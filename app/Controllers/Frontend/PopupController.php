<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PopupModel;

/**
 * Class PopupController.
 */
class PopupController extends BaseController
{
    use ResponseTrait;
    
    protected PopupModel $PopupModel;

    public function __construct()
    {
        $this->PopupModel = new PopupModel();
    }
    /**
     * 显示弹出层数据
     *
     * @return mixed
     */
    public function show()
    {
        $locale = service('lang')->getLocale();
        $popup = $this->PopupModel->getPopupForLocale($locale);

        $this->respond([
            'code'   => 200,
            'status' => 'success',
            'data'   => $popup,
        ])->setHeader('X-CSRF-TOKEN', csrf_hash())->send();

        // 后台异步处理
        // 立即关闭 Session 写锁
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        // 切断 HTTP 连接
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } else {
            // 兼容非 FPM 环境 
            // 手动处理兜底
            ignore_user_abort(true);
            // 如果 headers 还没发送强制发送
            if (!headers_sent()) {
                header('Connection: close');
            }
            flush();
        }

        // 概率触发
        // 假设每天被调用 10,000 次 设置 5% - 10% 的概率即可，既保证邮件发送及时，又保护数据库。
        // 如果流量很小（每天 < 100 IP），可以去掉这个判断。
        $triggerProbability = 100; // 概率
        if (rand(1, 100) <= $triggerProbability) {
            // 防止脚本超时
            set_time_limit(60); 
            try {
                service('emailQueue')->processBatch(5);
            } catch (\Throwable $e) {
                // 捕获所有错误
                log_message('error', 'Async Mail Error: ' . $e->getMessage());
            }
        }
    }
}

