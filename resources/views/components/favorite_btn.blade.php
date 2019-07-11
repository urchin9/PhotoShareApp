@if (Auth::user()->is_favorite($post->id))
    <form action="{{ url('/posts/' . $post->id . '/unfavorite') }}" method="POST" class="like-btn">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="p-0 btn btn-link"><i class="fas fa-heart"></i></button>
    </form>
@else
    <form action="{{ url('/posts/' . $post->id . '/favorite') }}" method="POST" class="like-btn">
        {{ csrf_field() }}
        <button type="submit" class="p-0 btn btn-link"><i class="far fa-heart"></i></button>
    </form>
@endif