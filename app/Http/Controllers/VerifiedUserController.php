<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserVerify;

class VerifiedUserController extends Controller
{
    public function index()
    {
        $verifiedUsers = UserVerify::with('user')
                                   ->where('status', 'verified')
                                   ->paginate(8); // Pagination avec 10 éléments par page
        return view('verified_user', compact('verifiedUsers'));
    }
}
