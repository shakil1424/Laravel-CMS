<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2);
        return view('admin.posts.index', ['posts' => $posts]);

    }

    public function show(Post $post)
    {
        return view('blog-post', ['post' => $post]);
    }

    public function create()
    {
        //incase of authorizing the create
        //$this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store()
    {
        //dd(\request()->all());
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')
                ->storeAs('images', request('post_image')->getClientOriginalName());
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message', 'New post is created');
        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        $this->authorize('view',$post);
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        //dd(\request()->all());
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')
                ->storeAs('images', request('post_image')->getClientOriginalName());
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $this->authorize('update',$post);
        auth()->user()->posts()->save($post);
        session()->flash('post-updated-message', 'post is updated');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }
}
