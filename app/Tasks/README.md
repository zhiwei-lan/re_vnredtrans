# CodeIgniter 4 Tasks 使用指南

## 概述
CI4 Tasks 是 CodeIgniter 4 的定时任务执行框架，允许你创建可以定期执行的后台任务，类似于 Linux 的 Cron 任务。所有任务在 [app/Config/Tasks.php](../Config/Tasks.php) 配置文件中注册和管理。

## 项目架构

### 目录结构
```
app/
├── Config/
│   └── Tasks.php                 # 任务配置和注册文件
├── Tasks/                        # 任务类目录
│   ├── LogCleanupTask.php       # 日志清理任务
│   └── README.md                # 本文件
├── Models/
│   └── EmailQueueModel.php      # 邮件队列数据模型
└── Services/
    └── EmailQueueService.php    # 邮件队列服务
```

## 当前已配置的任务

### 1. Email Queue Processing Task（邮件队列处理任务）
**配置位置**: Config/Tasks.php 中以闭包形式定义  
**执行频率**: 每分钟执行一次（`everyMinute()`）  
**单实例**: 是 - 防止并发执行

**功能说明**:
- 调用 `EmailQueueService::processBatch(5)` 处理邮件队列
- 每次处理最多 5 封待发送的邮件
- 自动处理邮件发送失败重试机制（最多重试 3 次）
- 更新邮件状态（pending → completed/failed）

**工作流程**:
1. 从 `email_queue` 表查询 status='pending' 的邮件
2. 使用原子锁机制避免重复处理（batch_id）
3. 逐个发送邮件，记录结果
4. 发送成功：status 改为 'completed'
5. 发送失败：attempts 加 1，如果超过 3 次则标记为 'failed'

---

### 2. Log Cleanup Task（日志清理任务）
**文件**: [LogCleanupTask.php](LogCleanupTask.php)  
**执行频率**: 每天凌晨 2:00（02:00）  
**单实例**: 是 - 防止并发执行

**功能说明**:
- 自动删除超过 30 天的旧日志文件
- 扫描 `writable/logs/` 目录
- 按文件修改时间判断
- 执行后记录日志

---

### 3. Cleanup Unused Media Task（清理未使用媒体文件任务）
**文件**: [CleanupUnusedMediaTask.php](CleanupUnusedMediaTask.php)  
**执行频率**: 每天凌晨 3:00（03:00）  
**单实例**: 是 - 防止并发执行

**功能说明**:
- 清理被标记为未使用的孤立媒体文件
- 清理超过 7 天没有被使用的临时上传文件
- 包含路径验证防止目录遍历
- 双重确认：检查数据库关联关系后再删除

**清理策略**:
1. **孤立文件清理** - 查找所有 `is_used=0` 的媒体
   - 双重验证：检查 `media_relations` 表是否有关联
   - 如果有关联，重新标记为 `is_used=1`
   - 删除物理文件和数据库记录

2. **临时文件清理** - 清理超过 7 天的未使用文件
   - 查找 `created_at` 超过 7 天且 `is_used=0` 的文件
   - 再次检查是否有关联
   - 逐个安全删除，失败不中断

**安全机制**:
- ✅ 路径安全验证（防止目录遍历攻击）
- ✅ 双重确认机制（避免误删有效文件）
- ✅ 完整的错误处理和日志记录
- ✅ 单文件失败不影响其他文件

---

## 任务配置详解

### Config/Tasks.php 结构

```php
public function init(Scheduler $schedule)
{
    // 邮件队列处理 - 每分钟执行
    $schedule->call(function () {
        service('emailQueue')->processBatch(5);
    })
    ->named('Email Queue Processing')
    ->everyMinute()
    ->singleInstance();

    // 日志清理 - 每天凌晨 2 点执行
    $schedule->call(function () {
        (new \App\Tasks\LogCleanupTask())->execute();
    })
    ->named('Log Cleanup')
    ->daily('02:00')
    ->singleInstance();

    // 媒体文件清理 - 每天凌晨 3 点执行
    $schedule->call(function () {
        (new \App\Tasks\CleanupUnusedMediaTask())->execute();
    })
    ->named('Cleanup Unused Media')
    ->daily('03:00')
    ->singleInstance();
}
```

### 配置选项说明

| 选项 | 默认值 | 说明 |
|------|--------|------|
| `$enableTaskRunner` | `true` | 是否启用任务运行器 |
| `$logTaskExecution` | `true` | 是否记录任务执行日志 |
| `$runTasksOnResponse` | `true` | 是否在 HTTP 响应时运行任务 |
| `$probability` | `10` | 任务自动执行的概率（0-100），降低服务器负载 |
| `$timezone` | `'UTC'` | Cron 计算使用的时区 |

---

## 创建新任务

### 1. 创建任务类

```php
<?php

namespace App\Tasks;

class MyTask
{
    /**
     * 执行任务的主方法
     * 任务框架会自动调用此方法
     */
    public function execute(): void
    {
        try {
            // 编写任务逻辑
            log_message('info', 'MyTask: Task started');
            
            // 你的业务代码
            
            log_message('info', 'MyTask: Task completed successfully');
        } catch (\Throwable $e) {
            log_message('error', 'MyTask: ' . $e->getMessage());
        }
    }
}
```

### 2. 在 Config/Tasks.php 中注册任务

```php
public function init(Scheduler $schedule)
{
    // 使用闭包方式调用任务
    $schedule->call(function () {
        (new \App\Tasks\MyTask())->execute();
    })
        ->everyFiveMinutes()           // 执行频率
        ->singleInstance();             // 可选：单实例执行
}
```

---

## 执行频率方法

### 常用的频率设置

| 方法 | 说明 | Cron 表达式 |
|------|------|-----------|
| `->everyMinute()` | 每分钟 | `* * * * *` |
| `->everyFiveMinutes()` | 每 5 分钟 | `*/5 * * * *` |
| `->everyTenMinutes()` | 每 10 分钟 | `*/10 * * * *` |
| `->everyFifteenMinutes()` | 每 15 分钟 | `*/15 * * * *` |
| `->everyThirtyMinutes()` | 每 30 分钟 | `*/30 * * * *` |
| `->hourly()` | 每小时 | `0 * * * *` |
| `->daily()` | 每天午夜 | `0 0 * * *` |
| `->daily()->at('14:30')` | 每天 14:30 | `30 14 * * *` |
| `->weekly()` | 每周一午夜 | `0 0 * * 0` |
| `->monthly()` | 每月 1 日午夜 | `0 0 1 * *` |

### 自定义 Cron 表达式

```php
$schedule->call(function () {
    // 任务代码
})->cron('0 9-17 * * 1-5'); // 工作时间每小时运行一次
```

---

## 任务选项

### singleInstance() - 单实例执行
防止任务并发执行，同一时间最多只有一个任务实例在运行。

```php
$schedule->call(function () {
    // ...
})->everyMinute()->singleInstance();
```

### environments() - 环境限制
指定任务只在特定环境中执行。

```php
$schedule->call(function () {
    // ...
})->daily()->environments('production', 'staging');
```

---

## 执行任务

### CLI 命令

```bash
# 列出所有任务
php spark tasks:list

# 运行所有任务（无视执行时间限制）
php spark tasks:run

# 运行指定任务
php spark tasks:run "Email Queue Processing Task"
php spark tasks:run "Log Cleanup Task"
```

### 自动执行

任务会在以下情况自动执行：
1. **请求响应时**: 根据 `$runTasksOnResponse` 配置
2. **后台进程**: 需要单独的 Cron 或计划任务调用 `php spark tasks:run`

---

## 邮件队列使用示例

### 添加邮件到队列

```php
// 在控制器或其他地方
$emailQueue = model(\App\Models\EmailQueueModel::class);

// 推送邮件到队列
$emailQueue->push(
    'user@example.com',
    'Welcome!',
    '<h1>Hello User</h1><p>Welcome to our platform.</p>'
);

// 系统会自动在下一分钟的任务执行中处理此邮件
```

### 邮件队列表结构

```sql
CREATE TABLE `email_queue` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `to_email` VARCHAR(255) NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `message` LONGTEXT NOT NULL,
    `status` ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
    `batch_id` VARCHAR(255) NULL,
    `attempts` INT DEFAULT 0,
    `error_log` LONGTEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 日志查看

所有任务执行都会记录到日志文件中：

```bash
# 查看最新日志
tail -f writable/logs/log-*.log

# Windows PowerShell 查看
Get-Content writable/logs/*.log | Tail -50
```

### 日志格式

```
INFO - 2026-01-27 11:47:06 --> EmailQueueService: Starting email batch processing
DEBUG - 2026-01-27 11:47:06 --> EmailQueueService: Found 2 emails to process
INFO - 2026-01-27 11:47:07 --> EmailQueueService: Email sent to user@example.com
INFO - 2026-01-27 11:47:08 --> EmailQueueService: Batch completed. Processed: 2, Failed: 0
```

---

## 最佳实践

### 1. 错误处理
始终在任务中使用 try-catch 捕获异常，防止任务中断。

```php
public function execute(): void
{
    try {
        // 业务逻辑
    } catch (\Throwable $e) {
        log_message('error', 'TaskName: ' . $e->getMessage());
    }
}
```

### 2. 日志记录
使用 `log_message()` 记录任务执行情况，便于调试和监控。

```php
log_message('info', 'MyTask: Task started');
log_message('debug', 'MyTask: Processing item ' . $id);
log_message('error', 'MyTask: Error processing item');
```

### 3. 单实例执行
对于资源密集或长时间运行的任务，使用 `->singleInstance()` 防止并发。

```php
$schedule->call(function () {
    // 长时间运行的任务
})->hourly()->singleInstance();
```

### 4. 批量处理
处理大量数据时，分批进行避免超时。

```php
$emailQueue->processBatch(5);  // 每次处理 5 条记录
```

### 5. 监控任务执行
定期查看任务列表和日志，确保任务正常运行。

```bash
php spark tasks:list  # 查看任务状态和下次执行时间
```

---

## 常见问题

### Q: 任务没有执行？
**A**: 检查以下几点：
- `$enableTaskRunner` 是否为 `true`
- 任务是否已在 `init()` 方法中注册
- 任务执行时间是否正确
- 查看日志文件查找错误信息

### Q: 任务并发执行导致数据混乱？
**A**: 使用 `->singleInstance()` 方法确保同时只有一个任务实例运行：
```php
$schedule->call(function () { ... })->everyMinute()->singleInstance();
```

### Q: 如何手动触发任务？
**A**: 使用 CLI 命令：
```bash
php spark tasks:run "Task Name"
```

### Q: 任务执行失败如何调试？
**A**: 
1. 查看 `writable/logs/` 目录中的日志文件
2. 在任务中添加详细的日志记录
3. 使用 `php spark tasks:run` 手动运行任务查看错误

---

## 相关资源

- [CodeIgniter 4 官方文档 - CLI](https://codeigniter.com/user_guide/general/cli.html)
- [CodeIgniter 4 Tasks 包](https://github.com/codeigniter4/tasks)
- [EmailQueueModel](../Models/EmailQueueModel.php) - 邮件队列数据模型
- [EmailQueueService](../Services/EmailQueueService.php) - 邮件队列服务
- [Tasks Config](../Config/Tasks.php) - 任务配置文件
