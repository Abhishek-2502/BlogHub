<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Apply auth middleware to every method
     * except index and show (public pages)
     */
    public function __construct()
    {
        $this->middleware('auth')
             ->except(['index', 'show']);
    }

    /* ------------------------------
     |  PUBLIC PAGES
     |------------------------------*/
    public function index(Request $request)
    {
        $query = Post::with('author');

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

$posts = $query->latest()->paginate(9)->appends(request()->query());

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /* ------------------------------
     |  CREATE / STORE
     |------------------------------*/
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ✅ Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        // ✅ Explicitly assign the user_id
        $validated['user_id'] = auth()->id();

        // ✅ Create the post
        Post::create($validated);


        return redirect()
            ->route('posts.index')
            ->with('status', 'Post created!');
    }

    

    /* ------------------------------
     |  EDIT / UPDATE / DELETE
     |------------------------------*/
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ✅ Handle new image upload and remove old one
        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()
            ->route('posts.index')
            ->with('status', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('status', 'Post deleted!');
    }

    /* ------------------------------
     |  USER DASHBOARD (/dashboard)
     |------------------------------*/
    
public function dashboard()
{
    //  dd(auth()->id());

    $posts = Post::where('user_id', auth()->id())
                 ->latest()
                 ->paginate(10);

    return view('dashboard', compact('posts'));
}


}
