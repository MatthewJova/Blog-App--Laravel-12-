@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Blog</h1>
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
        </div>

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
            
            @if($blog->image)
                <div class="mt-2">
                    <img src="{{ asset($blog->image) }}" width="100px" alt="Current Image">
                </div>
            @endif
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="content">Content:</label>
            <div id="editor" class="border p-2 min-h-[150px] bg-white"></div> 
            <textarea id="content" name="content" class="d-none" required>{{ $blog->content }}</textarea> 
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
    </form>

    <!-- Toolbar -->
    <div class="mt-3">
        <button data-action="bold" class="btn btn-outline-secondary">Bold</button>
        <button data-action="italic" class="btn btn-outline-secondary">Italic</button>
        <button data-action="heading1" class="btn btn-outline-secondary">H1</button>
        <button data-action="heading2" class="btn btn-outline-secondary">H2</button>
        <button data-action="bulletList" class="btn btn-outline-secondary">Bullet List</button>
        <button data-action="orderedList" class="btn btn-outline-secondary">Ordered List</button>
        <button data-action="alignLeft" class="btn btn-outline-secondary">Left Align</button>
        <button data-action="alignCenter" class="btn btn-outline-secondary">Center Align</button>
        <button data-action="alignRight" class="btn btn-outline-secondary">Right Align</button>
        <button data-action="link" class="btn btn-outline-secondary">Add Link</button>
    </div>
</div>
@endsection
