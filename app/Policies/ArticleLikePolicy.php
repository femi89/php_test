<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ArticleLike;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleLikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the articleLike can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the articleLike can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleLike  $model
     * @return mixed
     */
    public function view(User $user, ArticleLike $model)
    {
        return true;
    }

    /**
     * Determine whether the articleLike can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the articleLike can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleLike  $model
     * @return mixed
     */
    public function update(User $user, ArticleLike $model)
    {
        return true;
    }

    /**
     * Determine whether the articleLike can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleLike  $model
     * @return mixed
     */
    public function delete(User $user, ArticleLike $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleLike  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the articleLike can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleLike  $model
     * @return mixed
     */
    public function restore(User $user, ArticleLike $model)
    {
        return false;
    }

    /**
     * Determine whether the articleLike can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleLike  $model
     * @return mixed
     */
    public function forceDelete(User $user, ArticleLike $model)
    {
        return false;
    }
}
