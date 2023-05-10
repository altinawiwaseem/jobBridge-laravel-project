<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    public function index(){
        return view('listings.index', [
            "heading" => " Latest Listings ", 
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->get()
            
    
        ]);
    }

       // show create form
       public function create(){
        return view ("listings.create");
}

// Store Listing Data

public function store(Request $request){
    $formField = $request->validate([
        "title" => "required ",
        "company" => ["required", Rule::unique("listings", "company")],
        "location" => "required",
        "email" => ["required", "email"],
        "website" => "required",
        "tags" => "required",
        "description" => "required"
    ]);

    Listing::create($formField);
    return redirect("/");
}



    // show single listing
    public function show(Listing $listing){
        return view("listings.show", [
            "listing" => $listing
        ]);
    }

 
}


