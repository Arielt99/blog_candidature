<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleUpdateValidatedRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the Users.
     *
     * @return Inertia
     */
    public function index()
    {
        $users = User::with('role')->get();
        return Inertia::render('Auth/UserRoleManager', ['users' => $users]);
    }

    /**
     * Display the specified User and his Posts.
     *
     * @param  int  $id
     * @return Inertia
     */
    public function show($id)
    {
        $author = User::with('role')->search($id);
        $posts = $author->posts()->list();
        return Inertia::render('AuthorProfile', ['author' => $author, 'posts' => $posts]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UserRoleUpdateValidatedRequest $request, $id)
    {
        $user = User::find($id);

        if (Auth::user()->can('update', $user)) {
            $user->update($request->all());
        }
        return Redirect::route('RoleManager');
    }
}
