<?php

namespace App\Http\Controllers;

use App\Model\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Providers\PostsHelperServiceProvider;

class VerifiedUserController extends Controller
{
    public function index(Request $request)
    {
        Cookie::queue(Cookie::forget('app_feed_prev_page'));
        Cookie::queue(Cookie::forget('app_prev_post'));
        $verifiedUsers = UserVerify::with(['user' => function( $user){
                                    /** has post > MIN_NB_POST_TO_BE_VISIBLE */
                                        $user->withCount('posts')->having('posts_count', '>', UserVerify::MIN_NB_POST_TO_BE_VISIBLE);
                                    }])
                                   ->where('status', 'verified')
                                   ->orderBy('id', 'DESC')
                                   ->paginate(10); // Pagination avec 10 éléments par page
                                   dd();
        return view('verified_user', compact('verifiedUsers'));
    }
}
