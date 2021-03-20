<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $admin
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $admin, User $user)
    {
        if (Gate::allows('isAdministrator') && $admin->id != $user->id){
            return Gate::allows('isAdministrator');
        }
        else {
            return false;
        }

    }
}
