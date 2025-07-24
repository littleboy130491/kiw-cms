<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class PopupHome extends Component
{
    public bool $setOnce;
    public string $image;
    public string $alt;
    public bool $shouldShow;

    public function __construct(
        bool $setOnce = true,
        string $image = 'media/bulan-K3.jpg',
        string $alt = 'Popup Image'
    ) {
        $this->setOnce = $setOnce;
        $this->image = $image;
        $this->alt = $alt;

        // Check if popup should show based on session
        if ($this->setOnce) {
            $this->shouldShow = !Session::has('popup_home_shown');
            // Set session if we're showing the popup
            if ($this->shouldShow) {
                Session::put('popup_home_shown', true);
            }
        } else {
            $this->shouldShow = true;
        }
    }

    public function render()
    {
        return view('components.popup-home');
    }
}