<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index (Request $request, Apartment $apartment) {

        $userId = Auth::id();
        $user = Auth::user();

        // $apartments = $user->apartments()->get();
        
        
        return view ("admin.home",[
            
        ]);
    }
}

// public function index(Request $request) {
//     $statistics = [
//         "posts" => Post::count(),
//         "categories" =>Category::count(),
//     ];

//     return view("admin.home", [
//         "statistics" => $statistics,
//         "user" => $request->user(),
//         "userDetails" => $request->user()->detail
//         //"user" => Auth::user()
//     ]);
// }
