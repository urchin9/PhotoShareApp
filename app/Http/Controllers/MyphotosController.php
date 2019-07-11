<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MyPhotosController extends Controller
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
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(30);
        // dd($posts);
        return view('mypage.myphotos', ['posts' => $posts]);
    }

}
