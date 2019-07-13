@if (Auth::user()->is_favorite($post->id))
    <!-- <form action="{{ url('/posts/' . $post->id . '/unfavorite') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="p-0 btn btn-link">{{ $post->favorite_users()->count() }}<i class="fas fa-heart heart" data-postid="{{ $post->id }}"></i></button>
    </form> -->
    <div class="d-flex">
        <p class="fvbtn" id="{{ 'cnt' . $post->id }}">{{ $post->favorite_users()->count() }}</p>
        <p class="p-0 btn btn-link fvbtn unfavorite" data-postid="{{ $post->id }}"><i class="fas fa-heart heart" id="{{ $post->id }}"></i></p>
    </div>
@else
    <!-- <form action="{{ url('/posts/' . $post->id . '/favorite') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" class="p-0 btn btn-link">{{ $post->favorite_users()->count() }}<i class="far fa-heart heart" data-postid="{{ $post->id }}"></i></button>
    </form> -->
    <div class="d-flex">
        <p class="fvbtn" id="{{ 'cnt' . $post->id }}">{{ $post->favorite_users()->count() }}</p>
        <p class="p-0 btn btn-link fvbtn favorite" data-postid="{{ $post->id }}"><i class="far fa-heart heart" id="{{ $post->id }}"></i></p>
    </div>
@endif