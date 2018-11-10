<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    //
    public function index(){
        $sort = new Category();
        $sort = Category::getCategory();
       
        return view('home.index.index',[
            'sort'=>$sort
        ]);
    }
}
