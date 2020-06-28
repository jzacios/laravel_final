@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
            <div class="card">
                <div class="card-header"><a href="{{$post->id}}">{{$post->title}}</a></div>

                <div class="card-body">
                    <p class="post_body">
                        {{$post->body}}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
