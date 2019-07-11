@extends('layouts.app')

@section('title', 'MyPhotos')

@section('content')
<div class="container">
    <h2 class="pt-4 section-title">MyPage</h2>
    @include('components.navtab')
    @include('components.photos')
</div>

@endsection