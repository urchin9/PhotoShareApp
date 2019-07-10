 @if (count($posts) > 0)
    <div class="d-flex flex-wrap mt-4">
        @foreach ($posts as $post)
            <div class="card col-12 col-sm-6 col-lg-4 pt-1 photo-container">
                {{ $post->user->name }}
                {{ $post->created_at->format('Y-m-d') }}
                <a href="{{ url('/posts/' . $post->img_filename) }}" data-lightbox="{{ $post->id }}">
                    <img class="card-img-top photo-item mt-1" src="{{ url('/posts/' . $post->img_filename) }}" alt="photo">
                </a>
                <div class="card-body p-2 pl-0">
                    @if (Auth::id() == $post->user_id)
                        <form action="{{ url('/posts/' . $post->id) }}" method="POST" id="submit">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-outline-danger" onClick="del_alert(event);return false;">DELETE</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No Photos Yet</p>
@endif