<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
