<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ArticleTagsController;
use App\Http\Controllers\Api\ArticleLikeController;
use App\Http\Controllers\Api\TagArticlesController;
use App\Http\Controllers\Api\UserCommentsController;
use App\Http\Controllers\Api\ArticleCommentsController;
use App\Http\Controllers\Api\UserArticleLikesController;
use App\Http\Controllers\Api\ArticleArticleLikesController;
use App\Http\Controllers\Api\ArticleArticleViewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('articles', ArticleController::class);

        // Article Comments
        Route::get('/articles/{article}/comments', [
            ArticleCommentsController::class,
            'index',
        ])->name('articles.comments.index');
        Route::post('/articles/{article}/comments', [
            ArticleCommentsController::class,
            'store',
        ])->name('articles.comments.store');

        // Article Article Likes
        Route::get('/articles/{article}/article-likes', [
            ArticleArticleLikesController::class,
            'index',
        ])->name('articles.article-likes.index');
        Route::post('/articles/{article}/article-likes', [
            ArticleArticleLikesController::class,
            'store',
        ])->name('articles.article-likes.store');

        // Article Article Views
        Route::get('/articles/{article}/article-views', [
            ArticleArticleViewsController::class,
            'index',
        ])->name('articles.article-views.index');
        Route::post('/articles/{article}/article-views', [
            ArticleArticleViewsController::class,
            'store',
        ])->name('articles.article-views.store');

        // Article Tags
        Route::get('/articles/{article}/tags', [
            ArticleTagsController::class,
            'index',
        ])->name('articles.tags.index');
        Route::post('/articles/{article}/tags/{tag}', [
            ArticleTagsController::class,
            'store',
        ])->name('articles.tags.store');
        Route::delete('/articles/{article}/tags/{tag}', [
            ArticleTagsController::class,
            'destroy',
        ])->name('articles.tags.destroy');

        Route::apiResource('article-likes', ArticleLikeController::class);

        Route::apiResource('comments', CommentController::class);

        Route::apiResource('tags', TagController::class);

        // Tag Articles
        Route::get('/tags/{tag}/articles', [
            TagArticlesController::class,
            'index',
        ])->name('tags.articles.index');
        Route::post('/tags/{tag}/articles/{article}', [
            TagArticlesController::class,
            'store',
        ])->name('tags.articles.store');
        Route::delete('/tags/{tag}/articles/{article}', [
            TagArticlesController::class,
            'destroy',
        ])->name('tags.articles.destroy');

        Route::apiResource('users', UserController::class);

        // User Comments
        Route::get('/users/{user}/comments', [
            UserCommentsController::class,
            'index',
        ])->name('users.comments.index');
        Route::post('/users/{user}/comments', [
            UserCommentsController::class,
            'store',
        ])->name('users.comments.store');

        // User Article Likes
        Route::get('/users/{user}/article-likes', [
            UserArticleLikesController::class,
            'index',
        ])->name('users.article-likes.index');
        Route::post('/users/{user}/article-likes', [
            UserArticleLikesController::class,
            'store',
        ])->name('users.article-likes.store');
    });
