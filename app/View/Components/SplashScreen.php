<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class SplashScreen extends Component
{
    public bool $setOnce;
    public string $backgroundImage;
    public string $logoImage;
    public string $year;
    public array $logoSequence;
    public bool $shouldShow;

    public function __construct(
        bool $setOnce = true,
        string $backgroundImage = 'media/background-splash.jpg',
        string $logoImage = 'media/kiw-old.png',
        string $year = '1988',
        array $logoSequence = []
    ) {
        $this->setOnce = $setOnce;
        $this->backgroundImage = $backgroundImage;
        $this->logoImage = $logoImage;
        $this->year = $year;
        $this->logoSequence = $logoSequence ?: [
            ['year' => '1998', 'src' => 'media/kiw.png', 'alt' => 'Logo tahun 1998'],
            ['year' => '2018', 'src' => 'media/pws-logo.png', 'alt' => 'Logo tahun 2018'],
            ['year' => '2020', 'src' => 'media/gbc-logo.png', 'alt' => 'Logo tahun 2020'],
            ['year' => '2022', 'src' => 'media/Danareksa.png', 'alt' => 'Logo tahun 2022'],
            ['year' => '2024', 'src' => 'media/Danareksa.png', 'alt' => 'Logo tahun 2024'],
        ];

        // Check if splash screen should show based on session
        if ($this->setOnce) {
            $this->shouldShow = !Session::has('splash_screen_shown');
            // Set session if we're showing the splash screen
            if ($this->shouldShow) {
                Session::put('splash_screen_shown', true);
            }
        } else {
            $this->shouldShow = true;
        }
    }

    public function render()
    {
        return view('components.splash-screen');
    }
}