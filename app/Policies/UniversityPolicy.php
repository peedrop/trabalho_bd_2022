<?php

namespace App\Policies;

use App\Models\User;
use App\Models\University;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the university can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the university can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\University  $model
     * @return mixed
     */
    public function view(User $user, University $model)
    {
        return true;
    }

    /**
     * Determine whether the university can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the university can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\University  $model
     * @return mixed
     */
    public function update(User $user, University $model)
    {
        return true;
    }

    /**
     * Determine whether the university can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\University  $model
     * @return mixed
     */
    public function delete(User $user, University $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\University  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the university can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\University  $model
     * @return mixed
     */
    public function restore(User $user, University $model)
    {
        return false;
    }

    /**
     * Determine whether the university can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\University  $model
     * @return mixed
     */
    public function forceDelete(User $user, University $model)
    {
        return false;
    }
}
