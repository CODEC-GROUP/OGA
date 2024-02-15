<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UploadImage;
use Exception;

class AuthController extends Controller
{
    /**
     * Authenticate a user and return the access token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'message' => ['Login credentials invalid'],
            ])->status(401);
        }

        $user = User::where('email', $credentials['email'])->first();

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * Register a new user and return the access token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {


        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);



        $validated['password'] = Hash::make($validated['password']);

        $dataWithImage = new UploadImage();
        $userImage = new User();
        $finalDataUser = $dataWithImage->storeAndUpdateImageUser($validated, $userImage, $folderNameUserImage = "user");
        //   dd($finalDataUser);
        $user = User::create($finalDataUser);

        return response()->json([
            'status' => 1,
            'status_message' => 'Successfully registered user',
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }



    /**
     * Modification of the user informations and return the access token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {


        if ($user->id != auth()->user()->id) {
            return response()->json([
                'status_code' => 0,
                'message' => 'Permission Denied',
            ], 403);
        }


        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        $validated['password'] = Hash::make($validated['password']);


        $dataWithImage = new UploadImage();

        $finalDataUser = $dataWithImage->storeAndUpdateImageUser($validated, $user, $folderNameUserImage = "user");

        $user->update($finalDataUser);

        return response()->json([
            'status_message' => 'Successfully updated user',
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 201);
    }












    /**
     * Logout the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'message' => 'User successfully logged out.',
        ]);
    }
}
