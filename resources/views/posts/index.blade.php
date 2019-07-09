<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

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
                    @foreach ($files as $file)
                        <div class="card" style="width: 24%">
                            <img class="card-img-top" src="{{ url('/posts/' . $file) }}">

                            <div class="card-body">
                                <form action="{{ url('/posts/' . $file) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger">DELETE</button>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
