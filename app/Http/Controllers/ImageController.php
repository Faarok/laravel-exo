<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Property;
use Illuminate\Support\Str;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image as InterventionImage;

class ImageController extends Controller
{
    public static function imagesHandler(PropertyRequest $request, Property $property)
    {
        /**
         * @var UploadedFile|null
         */
        $images = $request->validated('images');

        if(!$property->images->isEmpty())
        {
            foreach($property->images as $imageToDelete)
                $imageToDelete->eraseImage();
        }

        foreach($images as $image)
        {
            $imageName = Str::uuid()->toString() . '.' . $image->extension();

            $resizedImage = InterventionImage::read($image->path());
            $imgData = $resizedImage->cover(800, 600, 'center')->toJpeg(80);

            Storage::disk('public')->put('property/' . $property->id . '/' . $imageName, $imgData);
            Image::create([
                'path' => 'property/' . $property->id . '/' . $imageName,
                'property_id' => $property->id
            ]);
        }
    }

    public function destroy(Image $image)
    {
        if(!$image->eraseImage())
            return response()->json(['message' => 'Image introuvable', 404]);

        return response()->json(['message' => 'Image supprimée avec succès', 200]);
    }
}