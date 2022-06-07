<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CompraPedidoStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompraPedidoStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the compraPedidoStatus can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoStatus can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoStatus  $model
     * @return mixed
     */
    public function view(User $user, CompraPedidoStatus $model)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoStatus can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoStatus can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoStatus  $model
     * @return mixed
     */
    public function update(User $user, CompraPedidoStatus $model)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoStatus can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoStatus  $model
     * @return mixed
     */
    public function delete(User $user, CompraPedidoStatus $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoStatus  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoStatus can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoStatus  $model
     * @return mixed
     */
    public function restore(User $user, CompraPedidoStatus $model)
    {
        return false;
    }

    /**
     * Determine whether the compraPedidoStatus can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoStatus  $model
     * @return mixed
     */
    public function forceDelete(User $user, CompraPedidoStatus $model)
    {
        return false;
    }
}
