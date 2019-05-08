<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StorePostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostComment $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostComment $request)
    {
        if ($request->validated()) {
            $comment = new Comment();
            $comment->body = $request->get('body');
            $comment->post()->associate($request->get('post_id'));
            $comment->author()->associate(Auth::user());
            $comment->save();
        }

        return back();
    }

    /**
     * @param Request $request
     * @param Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Comment $comment)
    {
        if (Auth::user()->id !== $comment->author->id && !Auth::user()->isAdmin()) {
            throw new UnauthorizedException('Unauthorized', 401);
        }

        $this->validate($request, [
            'body' => 'required||max:255'
        ]);

        $comment->body = $request->get('body');
        $comment->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        if (Auth::user()->id === $comment->author->id || Auth::user()->isAdmin()) {
            $comment->delete();
        }

        if (RequestFacade::has('back')) {
            return back();
        }

        return redirect()->route('posts.show', ['post' => $comment->post]);
    }
}
