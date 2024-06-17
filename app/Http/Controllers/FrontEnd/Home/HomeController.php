<?php

namespace App\Http\Controllers\FrontEnd\Home;

use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    public function index()
    {
        return view('super-admin.login.login');
    }
}
