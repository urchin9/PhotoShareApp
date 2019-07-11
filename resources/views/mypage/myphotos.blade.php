@extends('layouts.app')

@section('title', 'MyPhotos')

@section('content')
<div class="container mt-5">
    @include('components.navtab')
    @include('components.photos')
</div>

@endsection