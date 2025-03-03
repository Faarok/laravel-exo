<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')->sold(false)->recent()->limit(4)->get();

        foreach($properties as $property)
            $property->price = number_format($property->price, 0, '', ' ');

        return view('home', [
            'properties' => $properties
        ]);
    }
}
