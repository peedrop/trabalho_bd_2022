<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the room can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the room can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Room  $model
     * @return mixed
     */
    public function view(User $user, Room $model)
    {
        return true;
    }

    /**
     * Determine whether the room can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the room can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Room  $model
     * @return mixed
     */
    public function update(User $user, Room $model)
    {
        return true;
    }

    /**
     * Determine whether the room can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Room  $model
     * @return mixed
     */
    public function delete(User $user, Room $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Room  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the room can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Room  $model
     * @return mixed
     */
    public function restore(User $user, Room $model)
    {
        return false;
    }

    /**
     * Determine whether the room can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Room  $model
     * @return mixed
     */
    public function forceDelete(User $user, Room $model)
    {
        return false;
    }
}
