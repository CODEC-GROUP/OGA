<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PostResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PostCollection;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostCollection
     */
    public function index(): PostCollection
    {
        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters('title', 'type')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new PostCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return PostResource
     */
    public function store(StorePostRequest $request): PostResource
    {
        $validatedData = $request->validated();
        $dataWithImage = new UploadImage();
        $PostImage = new Post();
        $finalDataUser = $dataWithImage->storeAndUpdatePosts($validatedData, $PostImage, $folderNamePost = "posts");
        $post = Post::create($finalDataUser);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Post $post
     * @return PostResource
     */
    public function show(Request $request, Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $validatedData = $request->validated();
        $dataWithImage = new UploadImage();
        $finalDataUser = $dataWithImage->storeAndUpdatePosts($validatedData, $post, $folderNameUserImage = "posts");

        $post->update($finalDataUser);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function destroy(Request $request, Post $post): Response
    {
        if ($post->image_url) {
            $finalUrlImage = Str::replace('storage/', '', $post->image_url);
            $post->image_url = $finalUrlImage;
            Storage::disk('public')->delete($post->image_url);
        }
        $post->delete();
        return response()->noContent();
    }
}
