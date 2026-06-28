<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Services\Backend\ArticleMigrationService;

/**
 * 文章迁移管理控制器
 * 提供Web界面来执行和监控文章迁移
 */
class ArticleMigrationController extends AdminBaseController
{
    use ResponseTrait;

    protected ArticleMigrationService $migrationService;

    public function __construct()
    {
        $this->migrationService = new ArticleMigrationService();
    }

    /**
     * 迁移管理首页
     */
    public function index()
    {
        // 获取验证结果
        $verification = $this->migrationService->verifyMigration();
        
        $data = [
            'title'        => '文章数据迁移',
            'subtitle'     => '从旧系统迁移文章数据到新系统',
            'verification' => $verification,
        ];

        return view('Backend/ArticleMigration/index', $data);
    }

    /**
     * 获取迁移状态（AJAX）
     */
    public function status()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('只允许AJAX请求');
        }

        try {
            $verification = $this->migrationService->verifyMigration();
            $stats = $this->migrationService->getMigrationStats();

            return $this->respond([
                'success' => true,
                'verification' => $verification,
                'stats' => $stats,
            ]);
        } catch (\Throwable $e) {
            log_message('error', "获取迁移状态失败: " . $e->getMessage());
            return $this->failServerError('获取状态失败: ' . $e->getMessage());
        }
    }

    /**
     * 执行迁移（AJAX）
     */
    public function execute()
    {
        if (!$this->request->isAJAX() || !$this->request->isPost()) {
            return $this->failForbidden('只允许POST AJAX请求');
        }

        try {
            // 检查权限
            if (!auth()->user()->can('article.manage')) {
                return $this->failForbidden('您没有权限执行此操作');
            }

            $startTime = microtime(true);
            $result = [
                'steps' => [],
            ];

            // 步骤1：迁移媒体文件
            $result['steps'][] = [
                'step'   => 1,
                'name'   => '迁移媒体文件',
                'status' => 'processing',
            ];

            $mediaMapping = $this->migrationService->migrateMediaFiles();

            $result['steps'][0]['status'] = 'completed';
            $result['steps'][0]['count'] = count($mediaMapping);

            // 步骤2：迁移文章数据
            $result['steps'][] = [
                'step'   => 2,
                'name'   => '迁移文章数据',
                'status' => 'processing',
            ];

            $articlesMapping = $this->migrationService->migrateArticles($mediaMapping);

            $result['steps'][1]['status'] = 'completed';
            $result['steps'][1]['count'] = count($articlesMapping);

            // 步骤3：创建媒体关系
            $result['steps'][] = [
                'step'   => 3,
                'name'   => '创建媒体关系',
                'status' => 'processing',
            ];

            $this->migrationService->createMediaRelations($articlesMapping, $mediaMapping);

            $result['steps'][2]['status'] = 'completed';
            $result['steps'][2]['count'] = count($articlesMapping);

            // 步骤4：验证
            $result['steps'][] = [
                'step'   => 4,
                'name'   => '验证迁移结果',
                'status' => 'processing',
            ];

            $verification = $this->migrationService->verifyMigration();

            $result['steps'][3]['status'] = $verification['success'] ? 'completed' : 'warning';
            $result['steps'][3]['verification'] = $verification;

            $elapsed = round(microtime(true) - $startTime, 2);
            $result['success'] = $verification['success'];
            $result['elapsed'] = $elapsed;

            return $this->respond($result);

        } catch (\Throwable $e) {
            log_message('error', "执行迁移失败: " . $e->getMessage());
            return $this->failServerError('迁移失败: ' . $e->getMessage());
        }
    }

    /**
     * 获取迁移日志（AJAX）
     */
    public function logs()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('只允许AJAX请求');
        }

        try {
            $logFile = WRITEPATH . 'logs/log-' . date('Y-m-d') . '.log';

            if (!file_exists($logFile)) {
                return $this->respond([
                    'logs' => '暂无日志',
                ]);
            }

            // 读取日志文件
            $logs = file_get_contents($logFile);
            
            // 筛选迁移相关的日志
            $lines = explode("\n", $logs);
            $migrationLogs = [];
            
            foreach ($lines as $line) {
                if (stripos($line, 'migrate') !== false || stripos($line, 'article') !== false) {
                    $migrationLogs[] = $line;
                }
            }

            // 返回最后100条
            $migrationLogs = array_slice($migrationLogs, -100);

            return $this->respond([
                'logs' => implode("\n", $migrationLogs),
                'total' => count($migrationLogs),
            ]);

        } catch (\Throwable $e) {
            log_message('error', "获取日志失败: " . $e->getMessage());
            return $this->failServerError('获取日志失败');
        }
    }

    /**
     * 回滚迁移（AJAX）
     */
    public function rollback()
    {
        if (!$this->request->isAJAX() || !$this->request->isPost()) {
            return $this->failForbidden('只允许POST AJAX请求');
        }

        try {
            // 检查权限
            if (!auth()->user()->can('article.manage')) {
                return $this->failForbidden('您没有权限执行此操作');
            }

            $db = \Config\Database::connect();
            $db->transBegin();

            $result = [
                'steps' => [],
            ];

            try {
                // 步骤1：删除媒体关系
                $result['steps'][] = [
                    'step'   => 1,
                    'name'   => '删除媒体关系',
                    'status' => 'processing',
                ];

                $relationCount = $db->table('media_relations')->delete();
                $result['steps'][0]['status'] = 'completed';
                $result['steps'][0]['count'] = $relationCount;

                // 步骤2：删除文章语言记录
                $result['steps'][] = [
                    'step'   => 2,
                    'name'   => '删除文章语言记录',
                    'status' => 'processing',
                ];

                $langCount = $db->table('articles_lang')->delete();
                $result['steps'][1]['status'] = 'completed';
                $result['steps'][1]['count'] = $langCount;

                // 步骤3：删除文章主表
                $result['steps'][] = [
                    'step'   => 3,
                    'name'   => '删除文章主表',
                    'status' => 'processing',
                ];

                $articleCount = $db->table('articles')->delete();
                $result['steps'][2]['status'] = 'completed';
                $result['steps'][2]['count'] = $articleCount;

                $db->transCommit();

                $result['success'] = true;
                $result['message'] = '回滚完成';

                log_message('warning', "用户 " . auth()->user()->username . " 执行了文章迁移回滚");

                return $this->respond($result);

            } catch (\Throwable $e) {
                $db->transRollback();
                throw $e;
            }

        } catch (\Throwable $e) {
            log_message('error', "回滚迁移失败: " . $e->getMessage());
            return $this->failServerError('回滚失败: ' . $e->getMessage());
        }
    }
}
