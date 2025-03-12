@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control">
        </div>

        <div>
            <label for="content">Content:</label>
            <div id="editor"></div>
            <textarea id="content" name="content" class="d-none"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    <!-- Toolbar -->
    <div class="mt-3">
        <button data-action="bold">Bold</button>
        <button data-action="italic">Italic</button>
        <button data-action="heading1">H1</button>
        <button data-action="heading2">H2</button>
        <button data-action="bulletList">Bullet List</button>
        <button data-action="orderedList">Ordered List</button>
        <button data-action="alignLeft">Left Align</button>
        <button data-action="alignCenter">Center Align</button>
        <button data-action="alignRight">Right Align</button>
        <button data-action="link">Add Link</button>
    </div>
</div>

@endsection
