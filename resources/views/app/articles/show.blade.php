@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('articles.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.articles.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.articles.inputs.subject')</h5>
                    <span>{{ $article->subject ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.articles.inputs.slug')</h5>
                    <span>{{ $article->slug ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.articles.inputs.body')</h5>
                    <span>{{ $article->body ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('articles.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Article::class)
                <a href="{{ route('articles.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
