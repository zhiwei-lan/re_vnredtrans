<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailQueueModel extends Model
{
    protected $table = 'email_queue';
    protected $primaryKey = 'id';
    protected $allowedFields = ['to_email', 'subject', 'message', 'status', 'batch_id', 'attempts', 'error_log', 'updated_at'];
    protected $useTimestamps = true; 

    /**
     * 将邮件推入队列
     */
    public function push($to, $subject, $message)
    {
        return $this->insert([
            'to_email' => $to,
            'subject'  => $subject,
            'message'  => $message,
            'status'   => 'pending'
        ]);
    }

    /**
     * 原子锁
     */
    public function lockAndGetBatch($limit = 10)
    {
        $batchId = uniqid('batch_', true);

        //加锁
        $sql = "UPDATE {$this->table} 
                SET status = 'processing', batch_id = ? 
                WHERE status = 'pending' 
                LIMIT ?";
        
        $this->db->query($sql, [$batchId, $limit]);

        //取出
        return $this->where('batch_id', $batchId)
                    ->where('status', 'processing')
                    ->findAll();
    }
}