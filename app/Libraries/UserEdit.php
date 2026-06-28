<?php

namespace App\Libraries;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Shield\Entities\User;
use Config\Database;

class UserEdit
{
    public function handleEdit(User $user)
    {
        try {
            $db  = \Config\Database::connect();
            $db2 = \Config\Database::connect('db2');
            $identity = $db->table('auth_identities')
                ->where('user_id', $user->id)
                ->where('type', 'email_password')
                ->get()
                ->getRowArray();
            if (! $identity) {
                log_message('error', 'Password identity not found: ' . $user->id);
                return;
            }
            $db2->table('auth_identities')
                ->where('user_id', $user->id)
                ->where('type', 'email_password')
                ->update([
                    'secret2'     => $identity['secret2'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            if ($db2->affectedRows() === 0) {
                log_message('error', 'DB2 password update failed: ' . $user->id);
            }
        } catch (\Exception $e) {
            log_message('error', 'Password sync error: ' . $e->getMessage());
        }
    }
}