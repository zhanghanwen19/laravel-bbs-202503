<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * 在删除用户的时候删除掉用户发布的话题和回复
     *
     * @param User $user
     * @return void
     */
    public function deleting(User $user): void
    {
        $user->topics()->delete();
        $user->replies()->delete();
    }
}
