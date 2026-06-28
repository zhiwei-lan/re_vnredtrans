<?php

namespace App\Services;

use App\Models\EmailQueueModel;

class EmailQueueService
{
    public function processBatch(int $limit = 5): void
    {
        try {
            $emailQueue = new EmailQueueModel();
            log_message('info', 'EmailQueueService: Starting email batch processing');

            $jobs = $emailQueue->lockAndGetBatch($limit);

            if (empty($jobs)) {
                log_message('debug', 'EmailQueueService: No pending emails to process');
                return;
            }

            $email = service('email');
            $processed = 0;
            $failed = 0;

            foreach ($jobs as $job) {
                try {
                    $email->clear();
                    $email->setTo($job['to_email']);
                    $email->setSubject($job['subject']);
                    $email->setMailType('html');
                    $email->setMessage($job['message']);

                    if ($email->send()) {
                        $emailQueue->update($job['id'], [
                            'status'   => 'completed',
                            'batch_id' => null,
                        ]);
                        $processed++;
                    } else {
                        $attempts = ($job['attempts'] ?? 0) + 1;
                        $emailQueue->update($job['id'], [
                            'status'    => $attempts >= 3 ? 'failed' : 'pending',
                            'attempts'  => $attempts,
                            'batch_id'  => null,
                            'error_log' => $email->printDebugger(['headers']),
                        ]);
                        $failed++;
                    }
                } catch (\Throwable $e) {
                    $failed++;
                    $emailQueue->update($job['id'], [
                        'status'    => 'pending',
                        'batch_id'  => null,
                        'error_log' => $e->getMessage(),
                    ]);
                }
            }

            log_message(
                'info',
                "EmailQueueService: Batch done. processed={$processed}, failed={$failed}"
            );
        } catch (\Throwable $e) {
            log_message('critical', 'EmailQueueService fatal: ' . $e->getMessage());
        }
    }
}
