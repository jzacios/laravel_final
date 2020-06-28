<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function index(){
        if(Auth::check()) {
            if (Auth::user()->type == 'admin') {
                $comments = Comment::latest()->get();
                return view('comments', [
                    'comments' => $comments
                ]);
            }
        }
        return redirect('/');
    }
    public function destroy($id){
        if(Auth::check()) {
            if(Auth::user()->type == 'admin') {
                $comment = Comment::find($id);
                $comment->delete();
            }
        }
        return redirect()->back();
    }
    public function store($post_id){
        if(Auth::check()) {
            request()->validate([
                'body' => 'required'
            ]);
            $comment = new Comment();
            $comment->body = request('body');
            $comment->post_id = $post_id;
            $comment->owner_id = Auth::user()->id;
            $comment->save();
        }
        return redirect()->back();
    }
}
