<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $favorites = $user->favorite_posts()->paginate(30);
        return view('mypage.favorites', ['user' => $user,'posts' => $favorites]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        $post = Post::find($id);
        $fv_cnt = $post->favorite_users()->count();
        return  response()->json(['fv_cnt'=>$fv_cnt]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        $post = Post::find($id);
        $fv_cnt = $post->favorite_users()->count();
        return  response()->json(['fv_cnt'=>$fv_cnt]);
    }
}
