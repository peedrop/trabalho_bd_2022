<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the classroom can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the classroom can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classroom  $model
     * @return mixed
     */
    public function view(User $user, Classroom $model)
    {
        return true;
    }

    /**
     * Determine whether the classroom can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the classroom can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classroom  $model
     * @return mixed
     */
    public function update(User $user, Classroom $model)
    {
        return true;
    }

    /**
     * Determine whether the classroom can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classroom  $model
     * @return mixed
     */
    public function delete(User $user, Classroom $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classroom  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the classroom can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classroom  $model
     * @return mixed
     */
    public function restore(User $user, Classroom $model)
    {
        return false;
    }

    /**
     * Determine whether the classroom can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classroom  $model
     * @return mixed
     */
    public function forceDelete(User $user, Classroom $model)
    {
        return false;
    }
}
