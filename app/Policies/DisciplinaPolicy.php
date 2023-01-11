<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Disciplina;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisciplinaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the disciplina can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the disciplina can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Disciplina  $model
     * @return mixed
     */
    public function view(User $user, Disciplina $model)
    {
        return true;
    }

    /**
     * Determine whether the disciplina can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the disciplina can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Disciplina  $model
     * @return mixed
     */
    public function update(User $user, Disciplina $model)
    {
        return true;
    }

    /**
     * Determine whether the disciplina can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Disciplina  $model
     * @return mixed
     */
    public function delete(User $user, Disciplina $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Disciplina  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the disciplina can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Disciplina  $model
     * @return mixed
     */
    public function restore(User $user, Disciplina $model)
    {
        return false;
    }

    /**
     * Determine whether the disciplina can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Disciplina  $model
     * @return mixed
     */
    public function forceDelete(User $user, Disciplina $model)
    {
        return false;
    }
}
