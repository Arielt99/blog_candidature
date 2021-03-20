<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostValidatedRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the Posts.
     *
     * @return Inertia
     */
    public function index()
    {
        $posts = Post::with('user')->list();
        return Inertia::render('PostsList', ['posts' => $posts]);
    }

    /**
     * Display the specified Post.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::with('user')->where('id', $id)->first();

        return Inertia::render('Post', ['post' => $post]);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('PostAdding');
    }

    /**
     * Store a newly created Post in storage.
     *
     * @return Response
     */
    public function store(PostValidatedRequest $request)
    {
        $post = $request->user()->posts()->create($request->validated());

        return Redirect::route('PostDisplay', ['id' => $post->id]);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (Auth::user()->can('update', $post)) {
            return Inertia::render('PostEditing', ['post'=>$post]);
        }

        return Redirect::route('PostDisplay', ['id' => $id]);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PostValidatedRequest $request, $id)
    {
        $post = Post::find($id);

        if (Auth::user()->can('update', $post)) {
            $post->update($request->all());
            return Redirect::route('PostEdition', ['id' => $id]);
        }

        return Redirect::route('PostDisplay', ['id' => $id]);
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (Auth::user()->can('destroy', $post)) {
            $post->delete();
            return Redirect::route('PostsList');
        }

        return Redirect::route('PostDisplay', ['id' => $id]);
    }
}
