<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Discipline;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisciplinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the discipline can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the discipline can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Discipline  $model
     * @return mixed
     */
    public function view(User $user, Discipline $model)
    {
        return true;
    }

    /**
     * Determine whether the discipline can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the discipline can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Discipline  $model
     * @return mixed
     */
    public function update(User $user, Discipline $model)
    {
        return true;
    }

    /**
     * Determine whether the discipline can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Discipline  $model
     * @return mixed
     */
    public function delete(User $user, Discipline $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Discipline  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the discipline can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Discipline  $model
     * @return mixed
     */
    public function restore(User $user, Discipline $model)
    {
        return false;
    }

    /**
     * Determine whether the discipline can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Discipline  $model
     * @return mixed
     */
    public function forceDelete(User $user, Discipline $model)
    {
        return false;
    }
}
