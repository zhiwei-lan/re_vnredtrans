# 清理未使用媒体文件 Task 说明

## 概述
`CleanupUnusedMediaTask` 是一个定时任务，用于清理系统中未被使用的媒体文件。每天凌晨 3:00 自动执行，防止磁盘空间被浪费。

## 工作原理

### 两层清理策略

#### 1. 孤立文件清理
清理所有被标记为 `is_used=0` 的媒体文件：

```php
// 自动运行
$mediaModel->where('is_used', 0)->findAll();

// 双重验证
$mediaRelationsModel->where('media_id', $id)->first();
```

- 查找所有 `is_used=0` 的媒体
- 在 `media_relations` 表中检查是否有关联
- 如果有关联，重新标记为 `is_used=1`
- 否则删除物理文件和数据库记录

#### 2. 临时文件清理
清理超过 7 天未使用的临时文件：

```php
// 查找超过 7 天的未使用文件
$cutoffDate = date('Y-m-d H:i:s', strtotime("-7 days"));
$mediaModel
    ->where('is_used', 0)
    ->where('created_at <', $cutoffDate)
    ->findAll();
```

## 清理过程

### 第一步：标记未使用
当媒体从文章/内容中移除时，自动标记为 `is_used=0`：

```php
// 在 syncMedia() 时
$removed = array_diff($oldMediaIds, $newMediaIds);
if ($removed) {
    $mediaModel->whereIn('id', $removed)->set(['is_used' => 0])->update();
}
```

### 第二步：等待冷却期
- 孤立文件：立即可以清理
- 临时文件：等待 7 天后清理（给用户恢复的时间）

### 第三步：定期清理
每天凌晨 3:00 自动执行清理：

```php
// 配置中的任务调度
$schedule->call(function () {
    (new \App\Tasks\CleanupUnusedMediaTask())->execute();
})
->named('Cleanup Unused Media')
->daily('03:00')
->singleInstance();
```

## 安全机制

### ✅ 路径验证
防止目录遍历攻击：

```php
$realPath = realpath(dirname($filePath));
$allowedDir = realpath(FCPATH . MediaConfig::UPLOAD_BASE_DIR);

if (!str_starts_with($realPath, $allowedDir)) {
    throw new \RuntimeException('Invalid media path');
}
```

### ✅ 双重确认
删除前两次检查文件是否真的没有被使用：

```php
// 检查 1: is_used 字段
if ($media['is_used'] === 0) {
    // 检查 2: media_relations 表
    $hasRelations = $mediaRelationsModel
        ->where('media_id', $id)
        ->first();
}
```

### ✅ 故障恢复
单个文件失败不影响其他文件的清理：

```php
foreach ($medias as $media) {
    try {
        $this->deleteMediaFile($media);
    } catch (\Throwable $e) {
        // 记录错误，继续处理下一个
        log_message('warning', 'Failed to delete: ' . $e->getMessage());
        continue;
    }
}
```

## 日志输出

### 执行成功
```
INFO - 2026-01-27 03:00:00 --> CleanupUnusedMediaTask: Starting cleanup of unused media files
INFO - 2026-01-27 03:00:05 --> CleanupUnusedMediaTask: Found 15 unused media files
INFO - 2026-01-27 03:00:10 --> CleanupUnusedMediaTask: Deleted 15 unused media files, Failed: 0
INFO - 2026-01-27 03:00:12 --> CleanupUnusedMediaTask: Found 8 old temporary media files
INFO - 2026-01-27 03:00:15 --> CleanupUnusedMediaTask: Deleted 8 old unused media files, Failed: 0
INFO - 2026-01-27 03:00:15 --> CleanupUnusedMediaTask: Cleanup completed successfully
```

### 执行失败
```
ERROR - 2026-01-27 03:00:00 --> CleanupUnusedMediaTask: Invalid media path detected: /invalid/path
WARNING - 2026-01-27 03:00:05 --> CleanupUnusedMediaTask: Failed to delete media #123: Permission denied
CRITICAL - 2026-01-27 03:00:10 --> CleanupUnusedMediaTask: Database connection error
```

## 手动清理

### 立即清理未使用文件
```bash
php spark tasks:run "Cleanup Unused Media"
```

### 查看任务状态
```bash
php spark tasks:list
```

输出示例：
```
| Cleanup Unused Media   | closure | 00 3 * * * | --  | 2026-01-28 05:00:00 | in 16 hours |
```

## 清理配置自定义

### 修改清理天数
编辑 `app/Tasks/CleanupUnusedMediaTask.php`：

```php
// 修改这一行（默认 7 天）
$this->cleanupTemporaryMedia(7);

// 改成 14 天
$this->cleanupTemporaryMedia(14);
```

### 修改清理时间
编辑 `app/Config/Tasks.php`：

```php
// 改成每天晚上 10 点清理
->daily('22:00')
```

### 改成每周清理
```php
// 每周日凌晨 3 点清理
->weekly('03:00')
```

## 存储空间节省

### 示例计算
假设平均每个媒体文件 500KB：

```
未使用文件: 100 个
文件大小: 100 × 500KB = 50MB

清理后节省: 50MB 磁盘空间
```

## 最佳实践

### 1. 合理设置清理周期
- **孤立文件**: 可立即清理（已确认不使用）
- **临时文件**: 建议 7-14 天（给用户足够时间）

### 2. 监控清理日志
定期检查日志，确保没有异常删除：

```bash
Get-Content writable/logs/*.log | Select-String "CleanupUnused" | Tail -50
```

### 3. 备份重要数据
在执行此任务前，建议定期备份数据库和文件

### 4. 设置告警
如果清理失败达到阈值，发送告警通知：

```php
if ($failed > 5) {
    // 发送告警邮件
    // service('emailQueue')->push(...);
}
```

## 故障排除

### Q: 任务没有执行？
**A**: 检查以下项：
- `$enableTaskRunner` 是否为 `true`
- 任务是否正确注册在 `Config/Tasks.php`
- 检查服务器时间是否正确

### Q: 出现 "Permission denied" 错误？
**A**: 检查文件权限：
```bash
chmod 755 writable/uploads/
chmod 644 writable/uploads/*
```

### Q: 误删了重要文件？
**A**: 
1. 从备份恢复
2. 检查日志找出原因
3. 修改清理策略，增加等待时间

### Q: 想临时禁用此任务？
**A**: 在 `Config/Tasks.php` 中注释掉：
```php
// $schedule->call(function () { ... })->daily('03:00')->singleInstance();
```

## 相关资源

- [MediaService](../Services/Backend/MediaService.php) - 媒体服务类
- [MediaModel](../Models/MediaModel.php) - 媒体数据模型
- [MediaRelationsModel](../Models/MediaRelationsModel.php) - 媒体关联模型
- [Tasks Config](../Config/Tasks.php) - 任务配置文件
