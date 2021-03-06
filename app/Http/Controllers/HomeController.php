<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\User;
use App\Inquiry;
use Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        if(Auth::user()->user_type == "SUPER_ADMIN") {
            $userCount = User::count();
            $inquiriesCount = Inquiry::count();
            $myInquiriesCount = Inquiry::where('owner', Auth::id())->count();
            return view('home', [
                "auth" => true,
                "userCount" => $userCount,
                "inquiriesCount" => $inquiriesCount,
                "myInquiriesCount" => $myInquiriesCount
            ]);
        } else {
            $myInquiriesCount = Inquiry::where('owner', Auth::id())->count();
            return view('home', [
                "auth" => false,
                "myInquiriesCount" => $myInquiriesCount
            ]);
        }
    }
}