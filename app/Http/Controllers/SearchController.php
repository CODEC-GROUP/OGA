<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function searchpost(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|string'
        ]);

        $query = Post::where('title', 'like', '%' . $validated['keyword'] . '%')->orWhere('content', 'like', '%' . $validated['keyword'] . '%')->orWhere('type', 'like', '%' . $validated['keyword'] . '%');
        $postQuery = QueryBuilder::for($query)
            ->allowedFilters('content', 'type')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new SearchCollection($postQuery);
    }
}
