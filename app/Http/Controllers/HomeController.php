<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\WeatherApi;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')->sold(false)->recent()->limit(4)->get();

        return view('home', [
            'properties' => $properties
        ]);
    }
}
