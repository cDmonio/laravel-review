<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StorePostRequestApi;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function storeApi(StorePostRequestApi $request)
    {
        //$validated = $request->validated();

        //Create post
        $newPost = new Post();
        $newPost->title = $request->title;
        $newPost->body = $request->body;
        $newPost->save();

        return $newPost;
    }

    public function storeForm(StorePostRequest $request) : RedirectResponse
    {
        $validated = $request->validated();

        //Create post
        $newPost = new Post();
        $newPost->title = $request->title;
        $newPost->body = $request->body;
        $newPost->save();

        return redirect(route('blog.post', ['post' => $newPost->id]));
    }

    public function show(Post $post)
    {
        return view('post', ['post' => $post]);
    }
}
