<?php

namespace App\Http\Controllers;

use App\Model\UserVerify;
use Illuminate\Http\Request;
use App\Providers\PostsHelperServiceProvider;
use App\User;

class VerifiedUserController extends Controller
{
    public function index(Request $request)
    {
        $usersVerified =  User::whereHas('verification' ,function($verification){ $verification->where('status',"=" ,'verified');});
        if (UserVerify::MIN_NB_POST_TO_BE_VISIBLE) {
            $usersVerified->has('posts', '>=', UserVerify::MIN_NB_POST_TO_BE_VISIBLE);
        }
        $usersVerified = $usersVerified->orderBy('id', 'DESC')->paginate(8);
        PostsHelperServiceProvider::shouldDeletePaginationCookie($request);
        return view('verified_user', compact('usersVerified'));
    }
}
