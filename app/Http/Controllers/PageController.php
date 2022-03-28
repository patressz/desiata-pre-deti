<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Allergen;
use App\Models\School;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::where('archived', 0)->where('deleted', 0)->limit(4)->get();
        $schools = School::all();

        return view('home', compact('products', 'schools') );
    }

    public function allergens()
    {
        $allergens = Allergen::all();

        return view('allergens', compact('allergens') );
    }

    public function products()
    {
        $bread_rolls = Product::where('archived', 0)->where('deleted', 0)->where('category', "bread-rolls")->get();
        $wholemeal_sandwiches = Product::where('archived', 0)->where('deleted', 0)->where('category', "wholemeal-sandwiches")->get();

        return view('products', compact('bread_rolls', 'wholemeal_sandwiches') );
    }

    public function general_terms_and_conditions()
    {
        return view('general_terms_and_conditions');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function cookies()
    {
        return view('cookies');
    }
}
