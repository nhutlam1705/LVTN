<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class NewController extends Controller
{
    
    public function index() {
        $informations = Information::Where('type','Tin tức')->orderBy('created_at', 'desc')->take(12)->get();
       
        return view('pages.News.New',compact('informations')); 
    }
    public function show($id)
    {
        $news = Information::findOrFail($id);
        $informations = Information::Where('type','Tin tức')->orderBy('created_at', 'desc')->take(12)->get();
        return view('pages.News.NewDetail', compact('news','informations'));
    }
}
