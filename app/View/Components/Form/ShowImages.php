<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ShowImages extends Component
{

    public null|array|Collection $images;
    public bool $deletable;

    /**
     * Create a new component instance.
     */
    public function __construct(array|Collection $images, bool $deletable)
    {
        if((is_array($images) && empty($images)) || ($images instanceof Collection && $images->isEmpty()))
            $this->images = null;
        else
            $this->images = $images;

        $this->deletable = $deletable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return $this->images ? view('components.form.deletable-images') : '';
    }
}