<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Children;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildrenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Children $children)
    {
        return $user->id === $children->user_id
                ? Response::allow()
                : Response::deny('TÁTO AKCIA JE NEOPRÁVNENÁ.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Children $children)
    {
        return $user->id === $children->user_id
                ? Response::allow()
                : Response::deny('TÁTO AKCIA JE NEOPRÁVNENÁ.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Children $children)
    {
        return $user->id === $children->user_id
                ? Response::allow()
                : Response::deny('TÁTO AKCIA JE NEOPRÁVNENÁ.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Children $children)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Children $children)
    {
        //
    }
}
