@extends('layouts.app')

@section('title', 'TOP')

@section('content')

    <div class="container">
        <h2 class="pt-4 section-title">All Photos</h2>
        @include('components.uploader')
        @include('components.photos')
    </div>
@endsection