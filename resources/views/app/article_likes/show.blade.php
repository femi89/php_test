@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('article-likes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.article_likes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.article_likes.inputs.like')</h5>
                    <span>{{ $articleLike->like ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.article_likes.inputs.dis_like')</h5>
                    <span>{{ $articleLike->dis_like ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.article_likes.inputs.article_id')</h5>
                    <span
                        >{{ optional($articleLike->article)->subject ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.article_likes.inputs.user_id')</h5>
                    <span>{{ optional($articleLike->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('article-likes.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ArticleLike::class)
                <a
                    href="{{ route('article-likes.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
