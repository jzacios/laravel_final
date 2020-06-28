@extends('layouts.app')

@section('content')
    @if (auth::check() AND auth::user()->type == 'admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edytuj post</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Tytuł</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{$post->title}}" required autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right" >Treść posta</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" id="body" name="body" rows="4" required>{{$post->body}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        Edytuj post
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <script>window.location = "/";</script>
    @endif
@endsection
