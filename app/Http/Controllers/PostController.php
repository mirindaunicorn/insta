<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class PostController
 *
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts . create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePost $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePost $request)
    {
        $post = new Post();
        $post->photo = $request->file('photo')->store('public');
        $post->author()->associate(Auth::user());
        $post->save();

        return redirect()->route('posts . show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts . show', ['post' => $post]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->author->id && !Auth::user()->isAdmin()) {
            throw new UnauthorizedException('Unauthorized', 401);
        }

        $this->validate($request, [
            'photo' => 'required | image'
        ]);

        Storage::delete($post->photo);

        $post->photo = $request->file('photo')->store('public');
        $post->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id === $post->author->id || Auth::user()->isAdmin()) {
            $post->delete();
        }

        if (RequestFacade::has('back')) {
            return back();
        }

        return redirect()->route('users . show', ['user' => $post->author]);
    }

    /**
     * @param Post $post
     *
     * @return JsonResponse
     */
    public function like(Post $post): JsonResponse
    {
        if ($post->liked()) {
            $post->unlike();

            return new JsonResponse(['status' => 'unliked']);
        }

        $post->like();

        return new JsonResponse(['status' => 'liked']);
    }
}
