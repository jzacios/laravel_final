<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('home',[
            'posts'=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth::check()) {
            if (auth::user()->type == 'admin') {
                request()->validate([
                    'title' => 'required',
                    'body' => 'required'
                ]);
                $post = new Post();
                $post->title = request('title');
                $post->body = request('body');
                $post->save();

                return redirect('/');
            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->latest()->get();
        return view('post',[
            'comments' => $comments,
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth::check()) {
            if(auth::user()->type == 'admin') {
                $post = Post::find($id);
                return view('edit', [
                    'post' => $post
                ]);
            }
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check()) {
            if(Auth::user()->type == 'admin') {
                request()->validate([
                    'title' => 'required',
                    'body' => 'required'
                ]);
                $post = Post::find($id);
                $post->title = request('title');
                $post->body = request('body');
                $post->save();
            }
        }
        return redirect('/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()) {
            if(Auth::user()->type == 'admin') {
                $post = Post::find($id);
                $post->delete();
            }
        }
        return redirect('/');
    }
}
