<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;

class UploadImage extends Controller
{

    /*this function can store or update a user picture
     * 
     * @param array $data
     * @param User $user
     * @param string $folderNameUserImage
    */

    public function storeAndUpdateImageUser(array $data, User $user, string $folderNameUserImage = "user")
    {



        if (!isset($data['image_url'])) {

            $data['image_url'] = "storage/images/user/userDefaultsImage.png";
            return $data;
        } else {

            if ($user->image_url) {

                $finalUrlImage = Str::replace('storage/', '', $user->image_url);
                $user->image_url = $finalUrlImage;
                Storage::disk('public')->delete($user->image_url);
            }

            $data['image_url'] = $data['image_url']->store('images/' . $folderNameUserImage, 'public');
            $data['image_url'] = "storage/" . $data['image_url'];
            //  dd($data['image_url']);
            return $data;
        }
    }


    public function storeAndUpdateProjectCategoriesImages(array $data, ProjectCategory $projectCategory, string $folderNameProjectCategoriesImage = "projectCategories"): array
    {

        if (!isset($data['image_url'])) {

            $data['image_url'] = "storage/images/projectCategories/ProjectCategoriesDefaultsImage.png";
            return $data;
        } else {

            if ($projectCategory->image_url) {

                $finalUrlImage = Str::replace('storage/', '', $projectCategory->image_url);
                $projectCategory->image_url = $finalUrlImage;
                Storage::disk('public')->delete($projectCategory->image_url);
            }

            $data['image_url'] = $data['image_url']->store('images/' . $folderNameProjectCategoriesImage, 'public');
            $data['image_url'] = "storage/" . $data['image_url'];
            //  dd($data['image_url']);
            return $data;
        }
    }







    /**
     * Manage post picture
     * @param array $data 
     * @param Post $post
     * @param string $folderNamePost
     * @return array
     */

    public function storeAndUpdatePosts(array $data, Post $post, string $folderNamePost = "posts")
    {

        if (empty($data['image_url'])) {
            return $data;
        } else {


            if ($post->image_url) {

                $post->image_url = json_decode($post->image_url);
                foreach ($post->image_url as $image_url) {

                    $finalUrlImage = Str::replace('storage/', '', $image_url);
                    Storage::disk('public')->delete($finalUrlImage);
                }
            }


            if (isset($data['image_url']) && !empty($data['image_url'])) {
                $allImages = [];
                foreach ($data['image_url'] as $image_url) {
                    $dataImg = $image_url->store('images/' . $folderNamePost, 'public');
                    $dataImg = "storage/" . $dataImg;
                    array_push($allImages, $dataImg);
                }
                $data['image_url'] = $allImages;
                // dd($data);
                return $data;
            }
        }
    }
}
