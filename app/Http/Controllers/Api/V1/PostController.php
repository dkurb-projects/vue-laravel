<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

use function App\Helpers\ApiResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Post::latest()->paginate(2);
            return response()->json($posts, 200);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), 400);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $post = Post::create($request->except(['_token']));
            return response()->json($post, 200);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $post = Post::create($request->except(['_token']));
            return response()->json($post, 200);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            $posts = Post::paginate(10);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), $ex->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        try {
            $post = Post::find($post->id);
            return response()->json($post, 200);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            $post = Post::where('id', $post->id)->update($request->all());
            return response()->json($post, 200);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post = Post::where('id', $post->id)->delete();
            return response()->json($post, 200);
        } catch (Exception $ex) {
            return response()->json(ApiResponse($ex->getCode(), [], $ex->getMessage()), $ex->getCode());
        }
    }
}
