<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable= [
        'title',
        'surface',
        'price',
        'description',
        'room',
        'bedroom',
        'floor',
        'address',
        'town',
        'zip',
        'sell'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'sell' => 'boolean'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function options():BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    // Accessors
    public function getFirstImageAttribute():string
    {
        if($this->images->isEmpty())
            return Storage::url('default.jpg');

        return Storage::url($this->images->first()->path);
    }

    public function getFormattedPriceAttribute():string
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function getMainImagesAttribute():Collection|string
    {
        if($this->images->isEmpty())
            $this->first_image;

        return $this->images()->orderBy('created_at', 'DESC')->limit(6)->get();
    }

    // Scopes
    public function scopeSold(Builder $builder, bool $sold):Builder
    {
        return $builder->where('sell', $sold);
    }

    public function scopeRecent(Builder $builder):Builder
    {
        return $builder->orderBy('created_at', 'DESC');
    }
}
