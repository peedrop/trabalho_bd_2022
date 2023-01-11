<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reserve;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reserve can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reserve can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserve  $model
     * @return mixed
     */
    public function view(User $user, Reserve $model)
    {
        return true;
    }

    /**
     * Determine whether the reserve can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reserve can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserve  $model
     * @return mixed
     */
    public function update(User $user, Reserve $model)
    {
        return true;
    }

    /**
     * Determine whether the reserve can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserve  $model
     * @return mixed
     */
    public function delete(User $user, Reserve $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserve  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reserve can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserve  $model
     * @return mixed
     */
    public function restore(User $user, Reserve $model)
    {
        return false;
    }

    /**
     * Determine whether the reserve can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Reserve  $model
     * @return mixed
     */
    public function forceDelete(User $user, Reserve $model)
    {
        return false;
    }
}
