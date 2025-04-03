<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\DemoJob;
use App\Models\Option;
use App\Models\Property;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Events\ContactRequestEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\PropertyContactRequest;
use App\Notifications\ContactRequestNotification;

class PropertyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View|JsonResponse
    {
        $properties = Property::with('images');

        if(!empty($request->all()))
        {
            foreach($request->all() as $key => $value)
            {
                if(!empty($value))
                {
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
        }

        return view('property.index', [
            'properties' => $properties->paginate(18)
        ]);
    }

    public function adminDashboard():View
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
    public function show(Property $property)
    {
        DemoJob::dispatch($property)->delay(now()->addSeconds(10));

        return view('property.show', [
            'property' => $property,
            'images' => $property->images,
            'mainImages' => $property->main_images
        ]);
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
        /** @var Authenticatable $user */
        $user = Auth::user();
        if(!$user->can('delete', $property))
        {
            return back()->withErrors([
                'image' => 'Vous n\'avez pas les droits pour effectuer cette action.'
            ]);
        }

        // Alternative qui affiche une page 403 si pas les droits
        // $this->authorize('delete', $property);

        // Pour supprimer entièrement, utiliser ->forceDelete()
        // Pour récupérer un softDelete, utiliserr ->restore()
        $property->delete();
        return to_route('admin.property.index')
            ->with('success', 'Le bien a été supprimé');
    }

    public function contact(PropertyContactRequest $request, Property $property)
    {
        // Façade Notification pour spécifier le destinataire avec le canal associé
        Notification::route('mail', 'john@admin.fr')->notify(new ContactRequestNotification($property, $request->validated()));

        // Notification
        // $user = User::first();
        // $user->notify(new ContactRequestNotification($property, $request->validated()));

        // Avec Event
        // ContactRequestEvent::dispatch($property, $request->validated());

        // Sans event
        // Mail::to('ssamson@cabinet-bedin-immobilier.com')->send(new PropertyContact($property, $request->validated()));

        return back()->with('success', 'Votre demande de contact a été envoyée');
    }
}