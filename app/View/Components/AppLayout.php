<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Ubah dari 'layouts.app' menjadi 'layouts.dashboard'
        return view('layouts.dashboard');
    }
}