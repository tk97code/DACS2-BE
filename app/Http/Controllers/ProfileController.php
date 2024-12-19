<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
