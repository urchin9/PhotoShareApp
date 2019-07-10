@extends('layouts.app')

@section('content')

            <div class="content">
                <form method="post" action="{{ url('posts') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="file" name="image">

                    @if ($errors->has('image'))
                        {{ $errors->first('image') }}
                    @endif

                    <input type="submit" class="btn btn-secondary" value="upload!">
                </form>
            </div>

            <div class="container">
                <div class="cards">
                    @foreach ($posts as $post)
                        <div class="card" style="width: 24%">
                            <img class="card-img-top" src="{{ url('/posts/' . $post->img_filename) }}">
                            <div class="card-body">
                             @if (Auth::id() == $post->user_id)
                                <form action="{{ url('/posts/' . $post->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger">DELETE</button>
                                </form>
                            @endif
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
@endsection