@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h1 class="text-xl font-bold mb-4">Blog Posts</h1>
    <hr>
    @foreach ($blogs as $blog)
        <div class="mb-6 border-b pb-4">
            <!-- Flexbox untuk menata judul & tombol edit/delete -->
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">{{ $blog->title }}</h2>
                <div class="flex gap-2">
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Konten Blog -->
            <div class="prose max-w-none mt-4">{!! $blog->content !!}</div>
        </div>
    @endforeach
</div>
@endsection
