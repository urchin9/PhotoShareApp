@extends('layouts.app')

@section('content')
<div class="bg">
    <div class="container">
        <!-- <div class="row"> -->
            <div class="main-title text-center pt-5">
                <h1>Share your life!</h1>
                <h3>What you can do is ...</h3>
                <ul class="top-list">
                    <li>upload photos</li>
                    <li>see all photos the others uploaded</li>
                    <li>create a favorite photo list</li>
                </ul>
                @guest
                <div class="center-block">
                    <a class="btn-lg mt-3 btn btn-outline-light" href="{{ route('register') }}">SignUp Now</a>
                </div>
                @endguest
            </div>
        <!-- </div> -->
    </div>
    
</div>
@endsection