<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\View\View;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Dashboard
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $usersCount = User::all()->count();
        $postsCount = Post::all()->count();
        $commentsCount = Comment::all()->count();

        $lastComments = Comment::orderBy('created_at', 'DESC')->limit(5)->get();

        return view('admin.index', [
            'users' => $usersCount,
            'posts' => $postsCount,
            'comments' => $commentsCount,
            'lastComments' => $lastComments
        ]);
    }

    /**
     * @return View
     */
    public function users(): View
    {
        $users = User::withCount('posts', 'comments')->orderBy('created_at', 'DESC')->paginate();

        return view('admin.users', ['users' => $users]);
    }

    /**
     * @return View
     */
    public function comments(): View
    {
        $comments = Comment::orderBy('created_at', 'DESC')->paginate();

        return view('admin.comments', ['comments' => $comments]);
    }

    /**
     * @return View
     */
    public function posts(): View
    {
        $posts = Post::withCount('comments')->orderBy('created_at', 'DESC')->paginate();

        return view('admin.posts', ['posts' => $posts]);
    }

    /**
     * @param User $user
     * @return View
     */
    public function editUser(User $user): View
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * @param Comment $comment
     * @return View
     */
    public function editComment(Comment $comment): View
    {
        return view('admin.comment.edit', ['comment' => $comment]);
    }

    /**
     * @param Post $post
     * @return View
     */
    public function editPost(Post $post): View
    {
        return view('admin.post.edit', ['post' => $post]);
    }
}
