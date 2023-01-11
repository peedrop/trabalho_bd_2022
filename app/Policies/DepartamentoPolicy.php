<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Departamento;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the departamento can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the departamento can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Departamento  $model
     * @return mixed
     */
    public function view(User $user, Departamento $model)
    {
        return true;
    }

    /**
     * Determine whether the departamento can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the departamento can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Departamento  $model
     * @return mixed
     */
    public function update(User $user, Departamento $model)
    {
        return true;
    }

    /**
     * Determine whether the departamento can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Departamento  $model
     * @return mixed
     */
    public function delete(User $user, Departamento $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Departamento  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the departamento can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Departamento  $model
     * @return mixed
     */
    public function restore(User $user, Departamento $model)
    {
        return false;
    }

    /**
     * Determine whether the departamento can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Departamento  $model
     * @return mixed
     */
    public function forceDelete(User $user, Departamento $model)
    {
        return false;
    }
}
