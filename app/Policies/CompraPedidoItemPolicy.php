<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CompraPedidoItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompraPedidoItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the compraPedidoItem can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoItem can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoItem  $model
     * @return mixed
     */
    public function view(User $user, CompraPedidoItem $model)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoItem can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoItem can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoItem  $model
     * @return mixed
     */
    public function update(User $user, CompraPedidoItem $model)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoItem can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoItem  $model
     * @return mixed
     */
    public function delete(User $user, CompraPedidoItem $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoItem  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the compraPedidoItem can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoItem  $model
     * @return mixed
     */
    public function restore(User $user, CompraPedidoItem $model)
    {
        return false;
    }

    /**
     * Determine whether the compraPedidoItem can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CompraPedidoItem  $model
     * @return mixed
     */
    public function forceDelete(User $user, CompraPedidoItem $model)
    {
        return false;
    }
}
