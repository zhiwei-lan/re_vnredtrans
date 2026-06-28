<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

/**
 * 验证迁移路径命令
 */
class VerifyMigrationPaths extends BaseCommand
{
    protected $group       = 'Article';
    protected $name        = 'verify:paths';
    protected $description = '验证媒体文件路径是否正确包含 uploads 前缀';
    protected $usage       = 'php spark verify:paths';

    public function run(array $params)
    {
        try {
            $db = Database::connect();
            
            CLI::write("\n", 'white');
            CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');
            CLI::write("验证媒体文件路径", 'cyan');
            CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');
            
            // 查询前 10 条记录
            CLI::write("\n前 10 条媒体记录的路径:\n", 'yellow');
            
            $results = $db->table('media')
                ->select('id, path')
                ->limit(10)
                ->get()
                ->getResultArray();
            
            foreach ($results as $row) {
                $hasUploads = strpos($row['path'], 'uploads/') === 0;
                $icon = $hasUploads ? '✓' : '✗';
                $color = $hasUploads ? 'green' : 'red';
                
                CLI::write("[ID: {$row['id']}] {$icon} {$row['path']}", $color);
            }
            
            // 统计
            CLI::write("\n", 'white');
            CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');
            CLI::write("路径统计", 'cyan');
            CLI::write("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━", 'cyan');
            
            $result = $db->table('media')
                ->select("
                    SUM(CASE WHEN path LIKE 'uploads/%' THEN 1 ELSE 0 END) as with_uploads,
                    SUM(CASE WHEN path NOT LIKE 'uploads/%' THEN 1 ELSE 0 END) as without_uploads,
                    COUNT(*) as total
                ")
                ->get()
                ->getFirstRow('array');
            
            $withUploads = (int)$result['with_uploads'];
            $withoutUploads = (int)$result['without_uploads'];
            $total = (int)$result['total'];
            
            CLI::write("\n✓ 包含 uploads 前缀的: {$withUploads} 条", 'green');
            CLI::write("✗ 不包含 uploads 前缀的: {$withoutUploads} 条", $withoutUploads > 0 ? 'red' : 'green');
            CLI::write("  总计: {$total} 条\n", 'white');
            
            if ($withoutUploads > 0) {
                CLI::write("⚠ 发现 {$withoutUploads} 条路径不包含 uploads 前缀！", 'yellow');
                
                // 显示缺少前缀的路径示例
                CLI::write("\n缺少前缀的路径示例:\n", 'yellow');
                
                $missingUploads = $db->table('media')
                    ->select('id, path')
                    ->where('path NOT LIKE', 'uploads/%')
                    ->limit(5)
                    ->get()
                    ->getResultArray();
                
                foreach ($missingUploads as $row) {
                    CLI::write("  [ID: {$row['id']}] {$row['path']}", 'red');
                }
                
                return 1;
            } else {
                CLI::write("✓ 所有路径都正确包含了 uploads 前缀！\n", 'green');
                return 0;
            }
            
        } catch (\Throwable $e) {
            CLI::error("✗ 错误: " . $e->getMessage());
            return 1;
        }
    }
}
