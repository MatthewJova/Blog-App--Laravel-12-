@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h1 class="text-xl font-bold mb-4">Blog Posts</h1>
    @foreach ($blogs as $blog)
        <div class="mb-4">
            <h2 class="text-lg font-semibold">{{ $blog->title }}</h2>
            <div class="prose">{!! $blog->content !!}</div>
        </div>
    @endforeach
</div>
@endsection