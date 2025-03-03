<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class IntroductionController extends Controller
{
    
    public function index() {
        $information = Information::Where('type','Giới thiệu')->take(1)->get();
        $informations = Information::Where('type','Tin tức')->orderBy('created_at', 'desc')->take(3)->get();
       
        return view('pages.Introduction.Introduce',compact('information','informations')); 
    }
}
