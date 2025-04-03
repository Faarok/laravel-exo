<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;

class PropertyController extends Controller
{
    public function index()
    {
        return PropertyResource::collection(Property::limit(4)->get());
    }
}
