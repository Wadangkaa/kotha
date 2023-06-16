<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(){
        $message = 'this is second comment';
        $edit = false;
        $user_id = 1;
        $kotha_id = 1;

        $comment = new Comment();

        $comment->message = $message;
        $comment->edit = $edit;
        $comment->user_id = $user_id;
        $comment->kotha_id = $kotha_id;

        $comment->save();

    }
}
