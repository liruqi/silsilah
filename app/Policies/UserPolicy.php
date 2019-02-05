<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the user data.
     *
     * @param  \App\User  $user
     * @param  \App\User  $editableUser
     * @return mixed
     */
    public function edit(User $user, User $editableUser)
    {
        $emailSuffix = "@qq.com";
        return $editableUser->id == $user->id ||
            $editableUser->manager_id == $user->id || 
            ($user->email && substr($user->email, -strlen($emailSuffix)) === $emailSuffix);
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $editableUser
     * @return mixed
     */
    public function delete(User $user, User $editableUser)
    {
        return $editableUser->manager_id == $user->id && $editableUser->id != $user->id;
    }

    public function admin(User $user) {
        return $user->email === "ruqli@outlook.com";
    }
}
