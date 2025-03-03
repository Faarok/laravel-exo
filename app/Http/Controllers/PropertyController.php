<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;
use App\Mail\PropertyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PropertyContactRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        $properties = Property::with('images');

        if(!empty($request->all()))
        {
            foreach($request->all() as $key => $value)
            {
                if(empty($value))
                    continue;

                switch ($key)
                {
                    case 'surfaceMin':
                        $properties = $properties->where('surface', '>=', $value);
                        break;
                    case 'roomMin':
                        $properties = $properties->where('room', '>=', $value);
                        break;
                    case 'priceMax':
                        $properties = $properties->where('price', '<=', $value);
                        break;
                    case 'keyword':
                        $properties = $properties->where('description', 'like', '%' . $value . '%');
                        break;
                }
            }
        }

        return view('property.index', [
            'properties' => $properties->paginate(20)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->price = number_format($property->price, 0, '', ' ');
        return view('property.show', [
            'property' => $property
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function contact(PropertyContactRequest $request, Property $property)
    {
        $contact = $request->validated();
        // Utiliser ->queue() si on veut une file d'attente et pas un envoi direct
        Mail::to('ssamson@cabinet-bedin-immobilier.com')->send(new PropertyContact($property, $contact));

        return back()->with('success', 'Votre demande de contact a été envoyée');
    }
}
