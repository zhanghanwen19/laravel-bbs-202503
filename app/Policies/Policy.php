<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    /**
     * If the user has permission to manage contents, allow all abilities.
     *
     * @param $user
     * @param $ability
     * @return true|void
     */
    public function before($user, $ability)
    {
        // 如果用户拥有管理内容权限，即授权通过
        if ($user->can('manage_contents')) {
            return true;
        }
    }
}
