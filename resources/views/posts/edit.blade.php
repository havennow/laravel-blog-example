@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a href="{{route('posts.index')}}">{{__('See all posts')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts._message')
                        {!! Form::model($post, ['route' => ['posts.update', $post]]) !!}
                        @include('posts._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection