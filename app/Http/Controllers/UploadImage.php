<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;

class UploadImage extends Controller
{

    /*this function can store or update a picture
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

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image_url'] = $data['image_url']->store('images/' . $folderNameUserImage, 'public');
            $data['image_url'] = "storage/" . $data['image_url'];
            //  dd($data['image_url']);
            return $data;
        }
    }
}
