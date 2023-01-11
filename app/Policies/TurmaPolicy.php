<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Turma;
use Illuminate\Auth\Access\HandlesAuthorization;

class TurmaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the turma can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the turma can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Turma  $model
     * @return mixed
     */
    public function view(User $user, Turma $model)
    {
        return true;
    }

    /**
     * Determine whether the turma can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the turma can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Turma  $model
     * @return mixed
     */
    public function update(User $user, Turma $model)
    {
        return true;
    }

    /**
     * Determine whether the turma can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Turma  $model
     * @return mixed
     */
    public function delete(User $user, Turma $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Turma  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the turma can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Turma  $model
     * @return mixed
     */
    public function restore(User $user, Turma $model)
    {
        return false;
    }

    /**
     * Determine whether the turma can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Turma  $model
     * @return mixed
     */
    public function forceDelete(User $user, Turma $model)
    {
        return false;
    }
}
