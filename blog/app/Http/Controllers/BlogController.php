<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function about()
    {
        return view('about', ['name' => 'John Doe']);
    }
}
