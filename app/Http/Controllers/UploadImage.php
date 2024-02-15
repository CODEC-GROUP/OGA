<?php

namespace App\Http\Controllers;

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


    public function storeAndUpdateProjectCategoriesImages(array $data, ProjectCategory $projectCategory, string $folderNameProjectCategoriesImage = "projectCategories")
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
}
