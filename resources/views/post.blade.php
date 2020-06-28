@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{$post->title}}@auth @if(auth::user()->type == 'admin')<a class="post_nav" href="{{$post->id}}/edit">Edytuj</a> <a class="post_nav" href="{{$post->id}}/delete">Usuń</a>@endif @endauth </div>

                        <div class="card-body">
                            <p class="post_body">
                                {{$post->body}}
                            </p>
                        </div>
                        @auth
                        <div class="card-header">Dodaj Komentarz</div>
                        <div class="card-body">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="body">Treść komentarza</label>
                                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Dodaj</button>
                            </form>
                        </div>
                        @endauth
                        <div class="card-header">Komentarze</div>
                        @foreach($comments as $comment)

                            <div class="card-body">
                                <h5 class="card-title">{{$name = App\user::select('name')->where('id',$comment->owner_id)->first()->name}}
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
