<?php

namespace App\Http\Controllers;

use Exception;
// use App\Models\Image;
use App\Models\Option;
use App\Models\Property;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PropertyRequest;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use League\Glide\ServerFactory;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('admin.property.index', [
            'properties' => Property::recent()->withTrashed()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View|RedirectResponse
    {
        $property = new Property();

        return view('admin.property.create', [
            'property' => $property,
            'options' => Option::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request):RedirectResponse
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));

        if($request->validated('images') !== null)
            ImageController::imagesHandler($request, $property);

        return to_route('property.show', [
                'property' => $property
            ])
            ->with('success', 'La propriété a bien été créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.property.edit', [
            'property' => $property,
            'options' => Option::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->validated());
        $property->options()->sync($request->validated('options'));

        if($request->validated('images') !== null)
            ImageController::imagesHandler($request, $property);

        return to_route('property.show', [
                'property' => $property
            ])
            ->with('success', 'La propriété a bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        // Si softDeletes, ne supprime pas entièrement la donnée
        // pour supprimer entièrement, utiliser ->forceDelete()
        // Pour récupérer un softDelete, utiliserr ->restore()
        $property->delete();
        return to_route('admin.property.index')
            ->with('success', 'Le bien a été supprimé');
    }
}