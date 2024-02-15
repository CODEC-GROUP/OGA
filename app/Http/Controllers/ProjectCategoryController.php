<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadImage;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProjectCategoryResource;
use App\Http\Resources\ProjectCategoryCollection;
use App\Http\Requests\StoreProjectCategoryRequest;
use App\Http\Requests\UpdateProjectCategoryRequest;

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
        $dataWithImage = new UploadImage();
        $projectCategoryImage = new ProjectCategory();
        $finalDataUser = $dataWithImage->storeAndUpdateProjectCategoriesImages($validated, $projectCategoryImage, $folderNameUserImage = "projectCategories");
        $category = ProjectCategory::create($finalDataUser);
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

        $dataWithImage = new UploadImage();
        $finalDataUser = $dataWithImage->storeAndUpdateProjectCategoriesImages($validated, $category, $folderNameUserImage = "projectCategories");

        $category->update($finalDataUser);
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
        if ($category->image_url) {

            $finalUrlImage = Str::replace('storage/', '', $category->image_url);
            $category->image_url = $finalUrlImage;
            Storage::disk('public')->delete($category->image_url);
        }
        $category->delete();
        return response()->noContent();
    }
}
