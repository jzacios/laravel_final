@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Komentarze</div>
                    @foreach($comments as $comment)
                    <div class="card-body">
                        <h5 class="card-title">{{$title = App\Post::select('title')->where('id',$comment->post_id)->first()->title}}: {{$name = App\user::select('name')->where('id',$comment->owner_id)->first()->name}}
                            @auth @if(auth::user()->type == 'admin')<a href="/delete_comment/{{{$comment->id}}}"><span style="float:right;">Usuń</span></a>@endif @endauth
                        </h5>

                        <p class="post_body">
                            {{$comment->body}}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
