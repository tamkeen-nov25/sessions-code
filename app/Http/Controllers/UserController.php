<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Models\Video;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(protected UserService $service) {}
    public function index()
    {
        $users =  User::get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(StoreUserRequest $request)
    {

        User::create([
            'title' => $request->title
        ]);
        return redirect()->route('users.index');
    }

    public function storeComment(Request $request, Post $post)
    {

        //way 1
        $post->comments()->create([]);




        //way 2

        //    $request->validate([
        //     [
        //         'commentable_id' => ['nullable'],
        //         'commentable_type' => ['nullable'],

        //     ]
        // ]);
        // Comment::create([
        //     'commentable_id' => $request->commentable_id,
        //     'commentable_type' => $request->commentable_type == 'video' ? Video::class : Post::class
        // ]);

        //way 3
        Comment::create([
            'commentable_id' => $request->has('post_id') ? $request->post_id : $request->video_id,
            'commentable_type' => $request->has('video_id') ? Video::class : Post::class
        ]);



        return response()->json([
            'messge' => "success"
        ]);
    }



    public function createCommentOnPost(Request $request, Post $post)
    {
        $this->service->createComment($post, $request->all());
    }

    public function createCommentOnVideo(Request $request, Video $video)
    {
        $this->service->createComment($video, $request->all());
    }

    public function edit($user)
    {
        $user = User::find($user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        User::find($user)
            ->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($user)
    {
        User::find($user)->delete();
        // $user->delete();
        return redirect()->route('users.index');
    }

    public function home()
    {
        $products = Product::get();
        // $users = User::simplePaginate(3);
        return view('home', compact('products'));
    }
}
