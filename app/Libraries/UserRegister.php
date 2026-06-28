<?php

namespace App\Libraries;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Shield\Entities\User;
use Config\Database;

class UserRegister
{
    /**
     * 用户注册事件：
     *
     * @param Entity $user CodeIgniter Shield
     */
    public function handleRegister(User $user)
    {

        $db2 = \Config\Database::connect('db2');
        $db2->transBegin();
        try {
            $db2->table('users')->insert([
                'id'          => $user->id,
                'username'    => $user->username,
                'nickname'    => $user->nickname,
                'phone'       => $user->phone,
                'active'      => 1,
                'created_at'  => $user->created_at ?? date('Y-m-d H:i:s'),
                'updated_at'  => $user->updated_at ?? date('Y-m-d H:i:s'),
            ]);
            $db = \Config\Database::connect();
            $identities = $db->table('auth_identities')
                ->where('user_id', $user->id)
                ->get()
                ->getResultArray();

            foreach ($identities as $identity) {
                unset($identity['id']);

                $db2->table('auth_identities')->insert($identity);
            }
            $groups = $db->table('auth_groups_users')
                ->where('user_id', $user->id)
                ->get()
                ->getResultArray();
           
            foreach ($groups as $group) {
                unset($group['id']);
                $db2->table('auth_groups_users')->insert($group);
            }
            if ($db2->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }
            $db2->transCommit();
        } catch (\Exception $e) {
            log_message('error', 'User sync failed: ' . $e->getMessage());
        }
    }
}