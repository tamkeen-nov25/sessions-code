<?php

use App\Events\UserRegistered;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\TestMiddleware;
use App\Http\Resources\UserResource;
use App\Jobs\Test;
use App\Mail\WelcomeMailMarkdown;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Models\Video;
use App\Notifications\InvoiceCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('users', [UserController::class, 'store']);
Route::get('users', [UserController::class, 'index'])->middleware(TestMiddleware::class . ':alissar');
Route::get('users/{user}', [UserController::class, 'show']);

Route::post('users/{user}/attach-user-with-posts', [UserController::class, 'attachUserWithPosts']);

Route::get('users/{user}/posts', [UserController::class, 'getUserPosts']);

Route::post('users/{user}/detach-posts', [UserController::class, 'detachUserWithPosts']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::delete('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::put('posts/{post}', function () {


    Gate::authorize('viewAny', Post::class);
    // $allows = Gate::allows('view-dashboard');

    // if (!$allows) {
    //     return failedResponse(statusCode: 403);
    // }

    // return successResponse();
    //     abort(400,"sadad");
    //  return   successResponse("asfda");
    // ;    // $user = User::find(1);
    // $user->uploadImage("adfas");
})->middleware(['auth:api', 'can:update,post']);


Route::get('test', function () {

    return Post::simplePaginate(10);
    // $country = Country::create();
    // $user = $country->users()->create([
    //     'name' => "DAfa",
    //     "email" => "Assdfsfd@dfa",
    //     "password" => "dfga"
    // ]);
    // $user->posts()->create([
    //     'name' => "dsfa",
    //     "is_active" => true
    // ]);

    // return Country::whereDoesntHave('posts')->get();
    // return User::whereHas('posts',function(){$query->where})->get();




    // $post = Post::create(
    //     [
    //         'name' => "dsfa",
    //         "is_active" => true,
    //         'user_id' => 1
    //     ]
    // );

    // $post->comments()->create();

    // return $post->load('comments');

    // return Comment::whereHas('commentable',function($query){
    //     $query->
    // })
    // return Comment::whereHasMorph(
    //     'commentable',
    //     [Post::class, Video::class],
    //     function ($query, $type) {
    //         if ($type == Post::class) {
    //             $query->where('name', "dsfa");
    //         }
    //         // if ($type == Video::class) {
    //         //     $query->where('title', "test");
    //         // }
    //     }
    // )->get();
});


Route::post('posts', function (Request $request) {
    // $request->validate([
    //     'name' =>[ 'required']
    // ]);

    return __("messages.created");

    Post::create([
        'name' => $request->name,
        'user_id' => 1
    ]);
});

Route::get('ali', function () {
    $user = auth()->user();

    $roles = $user->roles->pluck('name');

    return $roles;
})->middleware('auth:api');

Route::post('posts', function (Request $request) {
    $request->validate([
        'name' => ['required'],
        'name.en' => ['required', 'string'],
        'name.ar' => ['required', 'string']
    ]);
    return Product::create([
        'name' => $request->name
    ]);


    // return Product::create([
    //     'name' => [
    //         'en' => $request->name_en,
    //         'ar' => $request->name_ar
    //     ]
    // ]);
})->middleware(['auth:api', 'role:manage-poss']);

Route::post('testc', [UserController::class, 'storeComment']);

Route::post('roles', [RoleController::class, 'store']);
Route::post('employees', [RoleController::class, 'storeEmployee']);


Route::get('test/resource', function () {
    //    $user =  User::create([
    //         'name' =>"test",
    //         "email" => "asdf@da",
    //         "password" => "asdfas",
    //         "phone" => "asdfas"
    //     ]);
    // $user->profile()->create([
    //     'address' => "adsfa"
    // ]);

    $users =  User::get();
    // $user =  User::find(1);
    return response()->json([
        'message' => "user created succes",
        'data' => UserResource::make($users)
    ]);
});


Route::post('avatar', function (Request $request) {
    $file = $request->file('avatar');
    $path = "images/" . $file->getClientOriginalName();


    $user = User::create([
        'name' => "test",
        "email" => "asdf@da",
        "password" => "asdfas",
        "phone" => "asdfas",
        'avatar' => $path
    ]);

    Storage::disk('local')
        ->put(
            $path,
            file_get_contents($file)
        );

    return UserResource::make($user);
});

Route::get('private/{user}', function (User $user) {
    return Storage::download($user->avatar);
})->name('api.private');


Route::get('a/users', function (Request $request) {
    $users = User::where(function ($query) use ($request) {
        $query->where('phone', 'LIKE', "%" . $request->phone . "%")
            ->orWhere('name', "LIKE", '%' . $request->name . "%");
    })
        ->where("active", $request->active)->get();
    return UserResource::collection($users);
});


Route::get('event', function () {
    // User::create();
    // throw new Exception("sdfas");
    // Log::info("afsdf");
    // Admin::query()->update([
    //     'email' => "alsisssssar"
    // ]);
    Post::create([
        'name' => "dss",
        "is_active" => 1,
        "user_id" => 3
    ]);
    $post = Post::find(1);
    $post->name = "Asdfas";
    $post->save();
    // return User::where('id',3)->update([
    //     'name'=>"tesxxkmmmmkkjjjmmmlllmmxxxxxxxxxxxxxtuioo"
    // ]);
    // return User::create([
    //     'name'=>"ASDf",
    //     'phone'=>"ASDf",
    //     'password'=>"ASDf",
    //     'active' =>1
    // ]);
    // UserRegistered::dispatch();
});


Route::get('job', function () {
    Test::dispatch()->onQueue('high');
    Test::dispatch()->onQueue('default');
    Test::dispatch()->onQueue('low');
});

Route::get('mail', function () {
    Mail::to("alissarkousa@gmail.com")->send(new WelcomeMailMarkdown("hi"));
    // return new WelcomeMailMarkdown();
})->name('mail');

Route::get('soft', function () {
    return User::query()->onlyTrashed()->restore();
});

Route::get('send', function () {
    $instanceId = 'instance160821';
    $token = 'de1scxp1knylce6f';
    $response =
        Http::post("https://api.ultramsg.com/{$instanceId}/messages/chat", [
            'token' => $token,
            'to' => '+963939614142', // International format
            'body' => 'Hello from Laravel via UltraMsg!'
        ]);
    return $response->json();
});


Route::get('t/users',function(){
    Test::dispatch($file);
    return User::active("Sad")->all();
});

Route::get('notificaiton',function(){
    $user = User::find(5);
    $user->notify(new InvoiceCreated());

    // $user->profile;

    return $user->unreadNotifications->markAsRead();
});