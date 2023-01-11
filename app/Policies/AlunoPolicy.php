<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Aluno;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlunoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the aluno can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the aluno can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Aluno  $model
     * @return mixed
     */
    public function view(User $user, Aluno $model)
    {
        return true;
    }

    /**
     * Determine whether the aluno can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the aluno can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Aluno  $model
     * @return mixed
     */
    public function update(User $user, Aluno $model)
    {
        return true;
    }

    /**
     * Determine whether the aluno can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Aluno  $model
     * @return mixed
     */
    public function delete(User $user, Aluno $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Aluno  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the aluno can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Aluno  $model
     * @return mixed
     */
    public function restore(User $user, Aluno $model)
    {
        return false;
    }

    /**
     * Determine whether the aluno can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Aluno  $model
     * @return mixed
     */
    public function forceDelete(User $user, Aluno $model)
    {
        return false;
    }
}
