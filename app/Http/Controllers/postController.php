<?php

namespace App\Http\Controllers;

use App\Models\Kotha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::PUT('active', 'mypost');
        $myKothas = Kotha::with([
            'location',
            'contact',
            'map',
            'additionalInfo',
            'images',
            'payment'
        ])->where('user_id', auth()->user()->id)->get();

        return view('mypost', compact('myKothas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kotha  $kotha
     * @return \Illuminate\Http\Response
     */
    public function show(Kotha $post)
    {

        $kotha = $post;
        return view('detail', compact('kotha'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kotha  $kotha
     * @return \Illuminate\Http\Response
     */
    public function edit(Kotha $post)
    {
        $kotha = $post;
        return view('editKothaform', compact('kotha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kotha  $kotha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kotha $post)
    {
        if ((new KothaController)->update($request, $post)) {
            return  redirect()->route('post.index');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kotha  $kotha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kotha $post)
    {
        $status = (new KothaController)->destroy($post);
        
        if($status){
            Session::put('success', 'Post Deleted Successfully');
        }else{
            Session::put('error', 'Failed to Delete Post');
        }

        return redirect()->route('post.index');
    }
}
