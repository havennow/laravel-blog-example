@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="{{route('posts.create')}}" class="btn btn-info mb-1">
                    @lang('Add new post')
                </a>
                @include('layouts._message')
            </div>
        </div>

        <div class="row" id="posts-list">
            <posts :posts="{{ json_encode($posts) }}"></posts>

            @if ($posts->hasPages())
                <div class="col-xs-12 col-md-12">
                    {!! $posts->render() !!}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('page-scripts')

    {!! Html::script('js/posts.js') !!}

@endpush