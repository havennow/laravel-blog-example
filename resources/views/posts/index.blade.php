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

        <div class="row">
            @if ($posts->count())
                @foreach($posts as $post)
                    <div class="col-xs-12 col-md-12 my-2">
                        <div class="card">
                            <div class="card-header clearfix">
                                <a href="{{route('posts.edit', $post)}}" class="float-right">{{__('Edit')}}</a>
                                <a href="{{route('posts.destroy', $post)}}" class="float-right mr-1">{{__('Delete')}}</a>
                                {{$post->title}} -
                                <small>{{$post->created_at->diffForHumans()}}</small>
                                <div>Por <span class="muted">{{$post->author->name}}</span></div>
                            </div>
                            <div class="card-body">
                                {!!  $post->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-xs-12 col-md-12">
                    {!! $posts->render() !!}
                </div>
            @else
                <div class="col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            Não tem posts
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection