<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class CleanMigration extends BaseCommand
{
    protected $group       = 'Migration';
    protected $name        = 'clean:migration';
    protected $description = '清理迁移数据（删除新系统中通过迁移添加的文章和媒体）';

    public function run(array $params = [])
    {
        CLI::write('╔════════════════════════════════════════════╗', 'red');
        CLI::write('║  清理迁移数据                              ║', 'red');
        CLI::write('╚════════════════════════════════════════════╝', 'red');
        CLI::newLine();

        if (CLI::prompt('⚠️  这将删除所有文章和媒体！确定要继续吗？(yes/no)', ['yes', 'no']) !== 'yes') {
            CLI::write('已取消', 'yellow');
            return 0;
        }

        try {
            $db = Database::connect();
            $db->transBegin();

            // 删除媒体关系
            CLI::write('删除媒体关系...', 'yellow');
            $db->table('media_relations')->truncate();
            CLI::write('✓ 媒体关系已删除', 'green');

            // 删除文章语言版本
            CLI::write('删除文章语言版本...', 'yellow');
            $db->table('articles_lang')->truncate();
            CLI::write('✓ 文章语言版本已删除', 'green');

            // 删除文章
            CLI::write('删除文章...', 'yellow');
            $db->table('articles')->truncate();
            CLI::write('✓ 文章已删除', 'green');

            // 删除媒体
            CLI::write('删除媒体文件...', 'yellow');
            $db->table('media')->truncate();
            CLI::write('✓ 媒体已删除', 'green');

            $db->transCommit();
            CLI::newLine();
            CLI::write('✓ 清理完成', 'green');
            return 0;

        } catch (\Throwable $e) {
            CLI::error("✗ 错误: " . $e->getMessage());
            return 1;
        }
    }
}
