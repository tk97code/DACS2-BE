<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cloudinary\Api\Admin\AdminApi;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;

class ProfileController extends Controller
{
    public function updateProfile() {

        $user = User::find(Auth::user()->id);

        $user->name = request()->input('name');
        $user->email = request()->input('email');
        $user->dob = request()->input('dob');
        $user->phone_number = request()->input('phone_number');
        $user->address = request()->input('address');

        $user->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'User information updated successfully',
        ]);
    }

    public function updateAvatar(Request $request) {
        $user = User::find(Auth::user()->id);

        // if ($request->hasFile('avatar')) {
            // $cloudinaryImage = $request->file('avatar')->storeOnCloudinary();
            // $url = $cloudinaryImage->getSecurePath();
        //     $filePath =Storage::put(path: 'avatars', new File($file)); // Lưu trong thư mục public/avatars

        //     // Xóa ảnh cũ nếu có
        //     if ($user->avatar) {
        //         Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar));
        //     }

        //     // Lưu đường dẫn mới vào cơ sở dữ liệu
        //     $user->avatar = '/storage/' . $filePath;
        //     $user->save();
        // }

        $publicId = Auth::user()->email.'_'.Auth::user()->id;

        $upload = new UploadApi();
        $upload->upload($request->file('avatar')->getRealPath(), [
            'public_id' => $publicId
        ]);


        $url = new AdminApi();

        $user->avatar = $url->asset($publicId)['url'];
        $user->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'User information updated successfully',
        ]);
    }

    public function showProfile() {
        
    }

}
