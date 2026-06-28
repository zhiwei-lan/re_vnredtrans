<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Tasks\Scheduler;

class Tasks extends BaseConfig
{
    /**
     * Whether to enable the task runner in responses
     */
    public bool $enableTaskRunner = true;

    /**
     * Whether to log task execution
     */
    public bool $logTaskExecution = true;

    /**
     * Path to store task execution logs
     */
    public string $logPath = WRITEPATH . 'logs/';

    /**
     * Whether tasks should be executed based on cron schedule
     * when the response is sent
     */
    public bool $runTasksOnResponse = true;

    /**
     * The probability of running a task on response (0-100)
     * Lower values mean less chance of running, which improves performance
     * Set to 0 to disable automatic execution
     */
    public int $probability = 10; // 10% chance

    /**
     * Timezone for cron calculations
     */
    public string $timezone = 'UTC';

    /**
     * Initialize and register all tasks
     */
    public function init(Scheduler $schedule)
    {
        // 每分钟处理邮件队列
        $schedule->call(function () {
             service('emailQueue')->processBatch(5);
        })
        ->named('Email Queue Processing')
        ->everyMinute()
        ->singleInstance();

        // 每天凌晨2点清理日志文件
        $schedule->call(function () {
            (new \App\Tasks\LogCleanupTask())->execute();
        })
        ->named('Log Cleanup')
        ->daily('02:00')
        ->singleInstance();

        // 每天凌晨3点清理未使用的媒体文件
        $schedule->call(function () {
            (new \App\Tasks\CleanupUnusedMediaTask())->execute();
        })
        ->named('Cleanup Unused Media')
        ->daily('03:00')
        ->singleInstance();
    }
}
