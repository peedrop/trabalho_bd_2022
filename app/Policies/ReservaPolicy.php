<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reserva;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reserva can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reserva can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserva  $model
     * @return mixed
     */
    public function view(User $user, Reserva $model)
    {
        return true;
    }

    /**
     * Determine whether the reserva can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reserva can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserva  $model
     * @return mixed
     */
    public function update(User $user, Reserva $model)
    {
        return true;
    }

    /**
     * Determine whether the reserva can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserva  $model
     * @return mixed
     */
    public function delete(User $user, Reserva $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserva  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reserva can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserva  $model
     * @return mixed
     */
    public function restore(User $user, Reserva $model)
    {
        return false;
    }

    /**
     * Determine whether the reserva can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserva  $model
     * @return mixed
     */
    public function forceDelete(User $user, Reserva $model)
    {
        return false;
    }
}
