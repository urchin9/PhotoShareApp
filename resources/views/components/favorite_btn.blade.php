@if (Auth::user()->is_favorite($post->id))
    <form action="{{ url('/posts/' . $post->id . '/unfavorite') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="p-0 btn btn-link">{{ $post->favorite_users()->count() }}<i class="fas fa-heart heart"></i></button>
    </form>
@else
    <form action="{{ url('/posts/' . $post->id . '/favorite') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" class="p-0 btn btn-link">{{ $post->favorite_users()->count() }}<i class="far fa-heart heart"></i></button>
    </form>
@endif