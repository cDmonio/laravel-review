<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function storeApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $validator->validated();
    }

    public function storeForm(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        $validated = $request->validated();

        dd($validated);

        // Retrieve a portion of the validated input data...
        $validated = $request->safe()->only(['name', 'email']);
        $validated = $request->safe()->except(['name', 'email']);

        return redirect('/posts');
    }
}
