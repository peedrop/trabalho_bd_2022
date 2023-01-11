<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Curso;
use Illuminate\Auth\Access\HandlesAuthorization;

class CursoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the curso can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the curso can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Curso  $model
     * @return mixed
     */
    public function view(User $user, Curso $model)
    {
        return true;
    }

    /**
     * Determine whether the curso can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the curso can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Curso  $model
     * @return mixed
     */
    public function update(User $user, Curso $model)
    {
        return true;
    }

    /**
     * Determine whether the curso can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Curso  $model
     * @return mixed
     */
    public function delete(User $user, Curso $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Curso  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the curso can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Curso  $model
     * @return mixed
     */
    public function restore(User $user, Curso $model)
    {
        return false;
    }

    /**
     * Determine whether the curso can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Curso  $model
     * @return mixed
     */
    public function forceDelete(User $user, Curso $model)
    {
        return false;
    }
}
