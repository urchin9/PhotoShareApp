@extends('layouts.app')

@section('title', 'MyPhotos')

@section('content')
    @foreach ($posts as $post)
        <div class="card" style="width: 24%">
        {{ $post->created_at->format('Y-m-d') }}
            <img class="card-img-top" src="{{ url('/posts/' . $post->img_filename) }}">
            <div class="card-body">
                @if (Auth::id() == $post->user_id)
                    <form action="{{ url('/posts/' . $post->img_filename) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">DELETE</button>
                    </form>
                @endif
            </div>
        </div>

    @endforeach


@endsection