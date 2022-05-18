<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ArticleView;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleViewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the articleView can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the articleView can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleView  $model
     * @return mixed
     */
    public function view(User $user, ArticleView $model)
    {
        return true;
    }

    /**
     * Determine whether the articleView can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the articleView can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleView  $model
     * @return mixed
     */
    public function update(User $user, ArticleView $model)
    {
        return true;
    }

    /**
     * Determine whether the articleView can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleView  $model
     * @return mixed
     */
    public function delete(User $user, ArticleView $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleView  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the articleView can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleView  $model
     * @return mixed
     */
    public function restore(User $user, ArticleView $model)
    {
        return false;
    }

    /**
     * Determine whether the articleView can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ArticleView  $model
     * @return mixed
     */
    public function forceDelete(User $user, ArticleView $model)
    {
        return false;
    }
}
