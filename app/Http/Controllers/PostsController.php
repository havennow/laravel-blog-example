<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller {

    public function index () {
        $posts = Post::with('author')->latest('id')->paginate();

        return view('posts.index-vue', compact('posts'));
    }

    public function create () {
        return view('posts.create-vue');
    }

    public function store (Request $request) {
        $data = $request->validate([
            'title'   => 'required|min:5|max:100',
            'content' => 'required',
            'thumb'   => 'required|file'
        ]);

        $thumb = array_pull($data, 'thumb');

        $post = auth()->user()->posts()->create($data);

        $post->thumb = Storage::put("posts/{$post->id}", $thumb);
        $post->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Post created successfully')
            ]);
        }

        return back()->with([
            'success' => true,
            'message' => __('Post created successfully')
        ]);
    }

    public function edit (Post $post) {
        return view('posts.edit-vue', compact('post'));
    }

    public function update (Request $request, Post $post) {
        $data = $request->validate([
            'title'   => 'required|min:5|max:100',
            'content' => 'required'
        ]);

        $post->update($data);


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Post updated successfully')
            ]);
        }

        return back()->with([
            'success' => true,
            'message' => __('Post updated successfully')
        ]);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy (Post $post) {
        $post->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Post removed successfully')
            ]);
        }

        return back()->with([
            'success' => true,
            'message' => __('Post removed successfully')
        ]);
    }

}
