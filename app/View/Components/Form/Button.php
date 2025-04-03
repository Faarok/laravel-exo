<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Button extends Component
{

    public string $customClass;
    public string $type;
    public string $color;
    public string|null $alpineFunc;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'submit', string $color = 'primary', ?string $customClass = '', ?string $alpineFunc = null)
    {
        $this->customClass = $customClass;
        $this->type = $type;
        $this->color = $color;
        $this->alpineFunc = $this->decodeAlpineFunc($alpineFunc);
    }

    private function decodeAlpineFunc(?string $alpineFunc):?string
    {
        $decodedAlpine = json_decode($alpineFunc, true);

        if(empty($decodedAlpine) || (isset($decodedAlpine['route']) && !Route::has($decodedAlpine['route'])))
            return null;

        if(isset($decodedAlpine['params']) && !empty($decodedAlpine['params']))
            return $decodedAlpine['function'] . '("' . route($decodedAlpine['route'], $decodedAlpine['params']) . '")';

        return $decodedAlpine['function'] . '("' . route($decodedAlpine['route']) . '")';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.button');
    }
}