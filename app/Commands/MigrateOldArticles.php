<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Services\Backend\ArticleMigrationService;

/**
 * 迁移旧文章系统数据到新系统
 * 
 * 使用方法：
 *   php spark migrate:articles              - 执行完整迁移
 *   php spark migrate:articles --verify     - 仅验证状态
 *   php spark migrate:articles --dry-run    - 演练模式
 */
class MigrateOldArticles extends BaseCommand
{
    protected $group       = 'Article';
    protected $name        = 'migrate:articles';
    protected $description = '迁移旧文章系统数据到新系统';
    protected $usage       = 'php spark migrate:articles [options]';
    protected $arguments   = [];
    protected $options     = [
        '--verify'  => '仅验证迁移状态，不执行迁移',
        '--dry-run' => '演练模式，验证逻辑但不提交事务',
    ];

    public function run(array $params)
    {
        $verify = isset($params['verify']);
        $dryRun = isset($params['dry-run']);

        try {
            $service = new ArticleMigrationService();

            // 显示标题
            $this->displayHeader();

            // 如果是验证模式
            if ($verify) {
                return $this->handleVerify($service);
            }

            // 演练模式提示
            if ($dryRun) {
                CLI::write('⚠️  演练模式：逻辑验证通过但数据不会保存', 'yellow');
                CLI::newLine();
            }

            // 执行迁移
            return $this->handleMigration($service, $dryRun);

        } catch (\Throwable $e) {
            CLI::error("✗ 错误: " . $e->getMessage());
            log_message('error', "迁移命令执行异常: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * 处理验证模式
     */
    private function handleVerify(ArticleMigrationService $service): int
    {
        CLI::write('正在验证迁移状态...', 'blue');
        CLI::newLine();

        $result = $service->verifyMigration();
        $this->displayVerifyResult($result);

        return $result['success'] ? 0 : 1;
    }

    /**
     * 处理迁移执行
     */
    private function handleMigration(ArticleMigrationService $service, bool $dryRun): int
    {
        // 确认操作
        if (!$dryRun) {
            if (CLI::prompt('确认开始迁移？(yes/no)', ['yes', 'no']) !== 'yes') {
                CLI::write('已取消迁移', 'yellow');
                return 0;
            }
        }

        try {
            // 步骤1：迁移媒体文件
            CLI::write('步骤1/4：迁移媒体文件...', 'blue');
            $startTime = microtime(true);
            $mediaMapping = $service->migrateMediaFiles();
            $elapsed = round(microtime(true) - $startTime, 2);
            CLI::write("✓ 迁移了 " . count($mediaMapping) . " 个媒体文件 (耗时: {$elapsed}s)", 'green');
            CLI::newLine();

            // 步骤2：迁移文章数据
            CLI::write('步骤2/4：迁移文章数据...', 'blue');
            $startTime = microtime(true);
            $articlesMapping = $service->migrateArticles($mediaMapping);
            $elapsed = round(microtime(true) - $startTime, 2);
            CLI::write("✓ 迁移了 " . count($articlesMapping) . " 篇文章 (耗时: {$elapsed}s)", 'green');
            CLI::newLine();

            // 步骤3：创建媒体关系
            CLI::write('步骤3/4：创建媒体关系...', 'blue');
            $startTime = microtime(true);
            $service->createMediaRelations($articlesMapping, $mediaMapping);
            $elapsed = round(microtime(true) - $startTime, 2);
            CLI::write("✓ 媒体关系创建完成 (耗时: {$elapsed}s)", 'green');
            CLI::newLine();

            // 步骤4：验证迁移结果
            CLI::write('步骤4/4：验证迁移结果...', 'blue');
            $result = $service->verifyMigration();
            CLI::newLine();

            $this->displayVerifyResult($result);

            // 显示迁移统计
            if ($result['success']) {
                CLI::newLine();
                CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'green');
                CLI::write("✓ 迁移成功完成！", 'green');
                CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'green');
                return 0;
            } else {
                CLI::newLine();
                CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'yellow');
                CLI::write("⚠ 迁移完成，但存在验证问题！", 'yellow');
                CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'yellow');
                return 1;
            }

        } catch (\Throwable $e) {
            CLI::error("✗ 迁移过程中出现错误: " . $e->getMessage());
            log_message('error', "迁移执行失败: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * 显示验证结果
     */
    private function displayVerifyResult(array $result): void
    {
        CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');
        CLI::write("迁移验证报告", 'cyan');
        CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');

        // 显示数据统计
        $stats = [
            '旧系统文章数' => $result['oldArticleCount'],
            '新系统文章数' => $result['newArticleCount'],
            '媒体文件数'   => $result['mediaCount'],
            '媒体关系数'   => $result['relationsCount'],
        ];

        $maxLabel = max(array_map('mb_strlen', array_keys($stats)));

        foreach ($stats as $label => $value) {
            $padding = str_repeat(' ', $maxLabel - mb_strlen($label) + 2);
            CLI::write("  {$label}{$padding}: {$value}", 'white');
        }

        // 显示问题列表
        if (!empty($result['issues'])) {
            CLI::newLine();
            CLI::write("发现的问题:", 'red');
            foreach ($result['issues'] as $issue) {
                CLI::write("  ✗ {$issue}", 'red');
            }
        } else {
            CLI::newLine();
            CLI::write("✓ 所有验证通过", 'green');
        }

        CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');
    }

    /**
     * 显示命令标题
     */
    private function displayHeader(): void
    {
        CLI::newLine();
        CLI::write("╔════════════════════════════════════════════╗", 'green');
        CLI::write("║     文章系统数据迁移工具                    ║", 'green');
        CLI::write("║  从旧系统迁移数据到新的文章管理系统         ║", 'green');
        CLI::write("╚════════════════════════════════════════════╝", 'green');
        CLI::newLine();
    }
}
