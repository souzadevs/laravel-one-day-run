<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CompraPedido;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompraPedidoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the compraPedido can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedido can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedido  $model
     * @return mixed
     */
    public function view(User $user, CompraPedido $model)
    {
        return true;
    }

    /**
     * Determine whether the compraPedido can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedido can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedido  $model
     * @return mixed
     */
    public function update(User $user, CompraPedido $model)
    {
        return true;
    }

    /**
     * Determine whether the compraPedido can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedido  $model
     * @return mixed
     */
    public function delete(User $user, CompraPedido $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedido  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedido can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedido  $model
     * @return mixed
     */
    public function restore(User $user, CompraPedido $model)
    {
        return false;
    }

    /**
     * Determine whether the compraPedido can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedido  $model
     * @return mixed
     */
    public function forceDelete(User $user, CompraPedido $model)
    {
        return false;
    }
}
