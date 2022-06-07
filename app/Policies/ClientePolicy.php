<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the cliente can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the cliente can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cliente  $model
     * @return mixed
     */
    public function view(User $user, Cliente $model)
    {
        return true;
    }

    /**
     * Determine whether the cliente can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the cliente can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cliente  $model
     * @return mixed
     */
    public function update(User $user, Cliente $model)
    {
        return true;
    }

    /**
     * Determine whether the cliente can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cliente  $model
     * @return mixed
     */
    public function delete(User $user, Cliente $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cliente  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the cliente can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cliente  $model
     * @return mixed
     */
    public function restore(User $user, Cliente $model)
    {
        return false;
    }

    /**
     * Determine whether the cliente can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cliente  $model
     * @return mixed
     */
    public function forceDelete(User $user, Cliente $model)
    {
        return false;
    }
}
