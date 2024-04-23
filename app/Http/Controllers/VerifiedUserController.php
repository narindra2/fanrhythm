<?php

namespace App\Http\Controllers;

use App\Model\UserVerify;
use Illuminate\Http\Request;
use App\Providers\PostsHelperServiceProvider;

class VerifiedUserController extends Controller
{
    public function index(Request $request)
    {

        $verifiedUsers = UserVerify::with(['user' => function( $users){
                                    /** has post > MIN_NB_POST_TO_BE_VISIBLE */
                                    $users->withCount('posts') ->having('posts_count', '>', UserVerify::MIN_NB_POST_TO_BE_VISIBLE);
                                    }])
                                   ->where('status', 'verified')
                                   ->orderBy('id', 'DESC')
                                   ->paginate(10); // Pagination avec 10 éléments par page
        PostsHelperServiceProvider::shouldDeletePaginationCookie($request);
        return view('verified_user', compact('verifiedUsers'));
    }
}
