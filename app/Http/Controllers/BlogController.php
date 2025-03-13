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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/'; // Pastikan path sesuai dengan folder penyimpanan di public
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage); // Pindahkan file ke public/images
    
            $validated['image'] = $destinationPath . $profileImage; // Simpan path yang benar
        }
    
        Blog::create($validated); // Simpan data ke database
        return redirect('/blogs')->with('success', 'Blog created successfully');
    }
    

    public function edit(Blog $blog){
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog){
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan validasi untuk image
        ]);
    
        // Jika ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            if($blog->image && file_exists(public_path($blog->image))){
                unlink(public_path($blog->image));
            }

            $image = $request->file('image');
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
    
            // Simpan path gambar dalam $validated
            $validated['image'] = $destinationPath . $profileImage;
        }
    
        // Perbarui data blog
        $blog->update($validated);
    
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }
    

    public function destroy(Blog $blog){
        if($blog->image && file_exists(public_path($blog->image))){
            unlink(public_path($blog->image));
        }
        
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
