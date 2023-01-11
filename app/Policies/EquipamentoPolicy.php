<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Equipamento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the equipamento can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the equipamento can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Equipamento  $model
     * @return mixed
     */
    public function view(User $user, Equipamento $model)
    {
        return true;
    }

    /**
     * Determine whether the equipamento can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the equipamento can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Equipamento  $model
     * @return mixed
     */
    public function update(User $user, Equipamento $model)
    {
        return true;
    }

    /**
     * Determine whether the equipamento can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Equipamento  $model
     * @return mixed
     */
    public function delete(User $user, Equipamento $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Equipamento  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the equipamento can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Equipamento  $model
     * @return mixed
     */
    public function restore(User $user, Equipamento $model)
    {
        return false;
    }

    /**
     * Determine whether the equipamento can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Equipamento  $model
     * @return mixed
     */
    public function forceDelete(User $user, Equipamento $model)
    {
        return false;
    }
}
