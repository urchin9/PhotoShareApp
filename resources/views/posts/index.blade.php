@extends('layouts.app')

@section('content')

    <div class="container">
        @include('components.uploader')
        @include('components.photos')
    </div>
@endsection