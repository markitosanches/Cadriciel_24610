<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function index($locale){

    if(! in_array($locale, ['en', 'fr'])){
        return back();
    }
       session()->put('locale', $locale);
       return back();
    }
}
