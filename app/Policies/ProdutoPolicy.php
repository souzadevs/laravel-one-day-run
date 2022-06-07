<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdutoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the produto can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the produto can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produto  $model
     * @return mixed
     */
    public function view(User $user, Produto $model)
    {
        return true;
    }

    /**
     * Determine whether the produto can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the produto can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produto  $model
     * @return mixed
     */
    public function update(User $user, Produto $model)
    {
        return true;
    }

    /**
     * Determine whether the produto can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produto  $model
     * @return mixed
     */
    public function delete(User $user, Produto $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produto  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the produto can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produto  $model
     * @return mixed
     */
    public function restore(User $user, Produto $model)
    {
        return false;
    }

    /**
     * Determine whether the produto can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produto  $model
     * @return mixed
     */
    public function forceDelete(User $user, Produto $model)
    {
        return false;
    }
}
