<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $iam */
        $iam = Auth::user();

        $subscriptions = $iam->subscriptions()->select('id')->get()->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $subscriptions)->orderBy('created_at', 'DESC')->paginate();

        return view('home', ['posts' => $posts]);
    }
}
