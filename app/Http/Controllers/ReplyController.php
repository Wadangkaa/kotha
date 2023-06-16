<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    public function store(){
        $message = 'this is reply of the comment';
        $user_id = 1;
        $comment_id = 1;


        DB::table('replys')->insert([
            'message' => $message,
            'user_id' => $user_id,
            'edit' => false,
            'comment_id' => $comment_id
        ]);

    }
}
