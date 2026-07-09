<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function before($user, $ability)
    {
        if (in_array($ability, ['update', 'delete', 'restore', 'forceDelete'])) {
            return null;
        }

        if ($user->type === 'super-admin' || $user->hasRole('Super Admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAbility('users.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasAbility('users.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAbility('users.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->id === $model->id) {
            return false;
        }

        return $user->type === 'super-admin' || $user->hasRole('Super Admin') || $user->hasAbility('users.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->id === $model->id) {
            return false;
        }

        return $user->type === 'super-admin' || $user->hasRole('Super Admin') || $user->hasAbility('users.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        if ($user->id === $model->id) {
            return false;
        }

        return $user->type === 'super-admin' || $user->hasRole('Super Admin') || $user->hasAbility('users.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        if ($user->id === $model->id) {
            return false;
        }

        return $user->type === 'super-admin' || $user->hasRole('Super Admin') || $user->hasAbility('users.delete');
    }

}