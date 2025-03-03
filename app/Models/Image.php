<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'path',
        'property_id'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    protected function eraseImage():bool
    {
        if(!Storage::disk('public')->delete($this->path))
            return false;

        $this->delete();
        return true;
    }
}