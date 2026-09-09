<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function index()
    {
        return view('pages.user-data');
    }
}