<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->get('search') . '%')->paginate();
        } else {
            $users = User::paginate();
        }

        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user): View
    {
        $posts = Post::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->paginate();

        return view('users.show', ['user' => $user, 'posts' => $posts]);
    }

    public function showByName(string $name): View
    {
        $user = User::where('name', '=', $name)->firstOrFail();

        return $this->show($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id !== $user->id && !Auth::user()->isAdmin()) {
            throw new UnauthorizedException('Unauthorized', 401);
        }

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        if (Auth::user()->id !== $user->id && !Auth::user()->isAdmin()) {
            throw new UnauthorizedException('Unauthorized', 401);
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->bio = $request->get('bio');

        if ($request->has('password') && null !== $request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('public');
        }

        $user->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {

        if (Auth::user()->isAdmin()) {
            $user->delete();
        }

        return back();
    }

    public function subscribe(User $user)
    {
        /** @var User $iam */
        $iam = Auth::user();

        try {
            $iam->toggleSubscribe($user);
        } catch (\Exception $e) {

        }

        return back();
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribers(User $user)
    {
        $users = $user->subscribers()->paginate();

        return view('users.list', ['users' => $users]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscriptions(User $user)
    {
        $users = $user->subscriptions()->paginate();

        return view('users.list', ['users' => $users]);
    }
}
