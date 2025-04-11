<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Institutions;
use App\Models\Scholarships;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function index(){

        $categories = Category::get();
        $scholarships = Scholarships::get();
        return view('welcome',compact('scholarships','categories'));

    }

    public function view($id){
        $scholar = Scholarships::where('id', $id)->first();

        $institutionId = $scholar->institution_id;

        $institutionData = Institutions::where('id', $institutionId)->first();

        return view('details', compact('scholar','institutionData'));
    }

    public function terms(){

        return view('terms');
    }
}
