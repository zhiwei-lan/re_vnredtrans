<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => '최고 관리자',
        ],
        'admin' => [
            'title'       => 'Admin',
            'description' => '관리자',
        ],
        'developer' => [
            'title'       => 'Developer',
            'description' => '개발자',
        ],
        'user' => [
            'title'       => 'User',
            'description' => '사용자',
        ],
        'beta' => [
            'title'       => 'Beta User',
            'description' => '사요자(beta)',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.access'        => '관리자 영역에 접근할 수 있음',
        'admin.settings'      => '사이트의 주요 설정에 접근할 수 있음',
        'users.manage-admins' => '다른 관리자를 관리할 수 있음',
        'users.create'        => '새 일반 사용자를 생성할 수 있음',
        'users.edit'          => '기존 일반 사용자를 수정할 수 있음',
        'users.delete'        => '기존 일반 사용자를 삭제할 수 있음',
        'beta.access'         => '베타 기능에 접근할 수 있음',
        'menu.create'         => '메뉴 생성',
        'menu.delete'         => '메뉴 삭제',
        'menu.edit'           => '메뉴 수정',
        'menu.show.dashboard'      => '대시보드',
        'menu.show.system'         => '시스템 관리',
        'menu.show.contact'        => '문의 관리',
        'menu.show.category'       => '분류 관리',
        'menu.show.user'           => '사용자 관리',
        'menu.show.menu'           => '메뉴 관리',
        'menu.show.safety'         => '보안감사',
        'menu.show.article'         => '게시물 관리',
        'menu.show.site'         => '사이트 관리',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'dashboard.*',
            'admin.*',
            'users.*',
            'beta.*',
            'menu.*',
            'system.*',
            'category.*',
            'article.*',
            'media.*',
            'contact.*',
            'navigation.*',
            'config.*',
            'form.*',
            'site.*',
            'popup.*',
            'language.*',
            'seo.*',
            'family_site.*',
            'slide.*'
        ],
        'admin' => [
            'dashboard.*',
            'category.*',
            'article.*',
            'media.*',
            'contact.*',
            'navigation.*',
            'form.*',
            'popup.*',
            'language.*',
            'seo.*',
            'family_site.*',
            'slide.*'
        ],
        'developer' => [
        ],
        'user' => [],
        'beta' => [
            'beta.access',
        ],
    ];
}
