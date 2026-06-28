<?php

namespace App\Tasks;

class LogCleanupTask
{
    /**
     * Execute the task
     */
    public function execute(): void
    {
        $logPath = WRITEPATH . 'logs/';

        // Keep logs from the last 30 days
        $keepAfter = time() - (30 * 24 * 60 * 60);

        if (! is_dir($logPath)) {
            log_message('error', 'Log directory does not exist: ' . $logPath);

            return;
        }

        $deleted = 0;
        $files = glob($logPath . '*.log');

        if (is_array($files)) {
            foreach ($files as $file) {
                if (filemtime($file) < $keepAfter) {
                    unlink($file);
                    $deleted++;
                }
            }
        }

        log_message('info', "Log cleanup completed. Deleted {$deleted} old log files.");
    }
}
