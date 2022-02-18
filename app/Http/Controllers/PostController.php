<?php

namespace App\Http\Controllers;

use App\Events\PostCreatedEvent;
use App\Models\Post;
use App\Mail\PostStored;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\User;
use App\Notifications\PostCreatedNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{

    public function index()
    {
        // $posts = Post::all();
        // $post = Post::latest()->first();
        // Mail::raw('Hello World', function ($message) {
        //     $message->to("tester@gmail.com")->subject("AP Index Function");
        // });
        // Notification::send( User::find(1) , new PostCreatedNotification());
        // echo "Noti send"; exit();
        $userid = auth()->user()->id;
        $posts = Post::where('user_id', $userid)->orderBy('id', 'desc')->get();
        return view('home', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $posts = Post::with('category')->get();
        return view('create', compact('posts', 'categories'));
    }

    public function store(PostRequest $request)
    {
        // Retrieve the validated input data... return array
        //$validated = $request->validated();
        $post = new Post();
        $post->name = $request->name;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->save();

        PostCreatedEvent::dispatch($post);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function show(Post $post)
    {
        //  $result = Category::find(2)->posts;
        //  dd($result);

        // $result = Category::with('posts')->get();
        // dd($result->toArray());
        // $result = Post::with('category')->get();
        // dd($result->toArray());
        // if($post->user_id !== auth()->user()->id) {
        //     abort(403);
        // }
        $this->authorize('view', $post);
        // $post = Post::with('category')->find($post->id);
        return view('show', compact('post'));

    }

    public function edit(Post $post)
    {
        // if($post->user_id !== auth()->user()->id) {
        //     abort(403);
        // }
        $this->authorize('view', $post);
        $categories = Category::all();
        return view('edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        // Retrieve the validated input data...
        //$validated = $request->validated();
        $validated = $request->validate([
            "name" => "required",
            "description" => "required",
            "category_id" => "required"
        ]);
        if($validated) {
            $post->name = $request->name;
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->update();
            return redirect()->route('posts.index')->with('success', 'Updated successfully');
        }

    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'One Post Deleted');
    }
}
