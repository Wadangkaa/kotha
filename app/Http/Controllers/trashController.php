<?php

namespace App\Http\Controllers;

use App\Models\Kotha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class trashController extends Controller
{
    public function index(){
        Session::PUT('active', 'trash');
        $myKothas = Kotha::onlyTrashed()->where('user_id', auth()->user()->id)->get();

        return view('trash', compact('myKothas'));
    }

    public function restore($id){
        $status = (Kotha::onlyTrashed()->find($id))->restore();

        if($status){
            Session::put('success', 'Post restored');
        }else{
            Session::put('error', 'Failed to restored post');
        }

        return redirect()->route('trash');
    }

    public function delete($id){
        $status = (Kotha::onlyTrashed()->find($id))->forcedelete();

        if($status){
            Session::put('success', 'Post deleted');
        }else{
            Session::put('error', 'Failed to delete post');
        }

        return redirect()->route('trash');
    }
}
