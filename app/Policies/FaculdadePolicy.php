<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Faculdade;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaculdadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the faculdade can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the faculdade can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Faculdade  $model
     * @return mixed
     */
    public function view(User $user, Faculdade $model)
    {
        return true;
    }

    /**
     * Determine whether the faculdade can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the faculdade can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Faculdade  $model
     * @return mixed
     */
    public function update(User $user, Faculdade $model)
    {
        return true;
    }

    /**
     * Determine whether the faculdade can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Faculdade  $model
     * @return mixed
     */
    public function delete(User $user, Faculdade $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Faculdade  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the faculdade can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Faculdade  $model
     * @return mixed
     */
    public function restore(User $user, Faculdade $model)
    {
        return false;
    }

    /**
     * Determine whether the faculdade can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Faculdade  $model
     * @return mixed
     */
    public function forceDelete(User $user, Faculdade $model)
    {
        return false;
    }
}
