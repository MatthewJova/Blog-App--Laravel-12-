<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function create(){
        return view('blogs.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Blog::create($validated);
        return redirect('/blogs')->with('success', 'Blog created successfully');
    }

    public function edit(Blog $blog){
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog){
        $request -> validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog->update($request->all());
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog){
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
