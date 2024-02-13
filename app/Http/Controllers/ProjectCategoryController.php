<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectCategoryRequest;
use App\Http\Requests\UpdateProjectCategoryRequest;
use App\Http\Resources\ProjectCategoryCollection;
use App\Http\Resources\ProjectCategoryResource;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectCategoryController extends Controller
{
    /**
     * Get a paginated list of project categories.
     *
     * @param Request $request
     * @return ProjectCategoryCollection
     */
    public function index(Request $request)
    {
        $categories = QueryBuilder::for(ProjectCategory::class)
            ->allowedFilters('name', 'description')
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->paginate();

        return new ProjectCategoryCollection($categories);
    }

    /**
     * Store a newly created project category in storage.
     *
     * @param StoreProjectCategoryRequest $request
     * @return ProjectCategoryResource
     */
    public function store(StoreProjectCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = ProjectCategory::create($validated);
        return new ProjectCategoryResource($category);
    }

    /**
     * Display the specified project category.
     *
     * @param ProjectCategory $category
     * @return ProjectCategoryResource
     */
    public function show(ProjectCategory $category)
    {
        return new ProjectCategoryResource($category);
    }

    /**
     * Update the specified project category in storage.
     *
     * @param UpdateProjectCategoryRequest $request
     * @param ProjectCategory $category
     * @return ProjectCategoryResource
     */
    public function update(UpdateProjectCategoryRequest $request, ProjectCategory $category)
    {
        $validated = $request->validated();

        $category->update($validated);
        return new ProjectCategoryResource($category);
    }

    /**
     * Remove the specified project category from storage.
     *
     * @param Request $request
     * @param ProjectCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProjectCategory $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
