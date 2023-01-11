<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Professor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the professor can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the professor can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Professor  $model
     * @return mixed
     */
    public function view(User $user, Professor $model)
    {
        return true;
    }

    /**
     * Determine whether the professor can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the professor can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Professor  $model
     * @return mixed
     */
    public function update(User $user, Professor $model)
    {
        return true;
    }

    /**
     * Determine whether the professor can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Professor  $model
     * @return mixed
     */
    public function delete(User $user, Professor $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Professor  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the professor can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Professor  $model
     * @return mixed
     */
    public function restore(User $user, Professor $model)
    {
        return false;
    }

    /**
     * Determine whether the professor can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Professor  $model
     * @return mixed
     */
    public function forceDelete(User $user, Professor $model)
    {
        return false;
    }
}
