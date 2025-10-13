<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use Littleboy130491\Sumimasen\Models\Component as ComponentModel;
use Awcodes\Curator\Models\Media;

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
        array $logoSequence = [
            ['year' => '1998', 'src' => 'media/kiw.png', 'alt' => 'Logo tahun 1998'],
            ['year' => '2018', 'src' => 'media/pws-logo.png', 'alt' => 'Logo tahun 2018'],
            ['year' => '2020', 'src' => 'media/gbc-logo.png', 'alt' => 'Logo tahun 2020'],
            ['year' => '2022', 'src' => 'media/Danareksa.png', 'alt' => 'Logo tahun 2022'],
        ]
    ) {
        // Get the component record
        $componentRecord = ComponentModel::where('title', 'splash-screen')
            ->first();

        // Default values
        $this->setOnce = $setOnce;
        $this->backgroundImage = $backgroundImage;
        $this->logoImage = $logoImage;
        $this->year = $year;
        $this->logoSequence = $logoSequence;

         // Fetch the component record from CMS
        $componentRecord = ComponentModel::where('title', 'splash-screen')->first();
       
        if ($componentRecord) {
            $sections = $componentRecord->block;

            // Use Laravel collection for easier manipulation
            $items = collect($sections);
            
            $background = $items->firstWhere('data.block_id', 'background-image');
            $initial = $items->firstWhere('data.block_id', 'initial');
            $sequences = $items->where('data.block_id', 'sequence');

            // Background image
            if ($background && isset($background['data']['image'])) {
                $media = Media::find($background['data']['image']);
                if ($media) {
                    $this->backgroundImage = $media->path;
                }
            }

            // Initial logo and year
            if ($initial) {
                if (isset($initial['data']['title'])) {
                    $this->year = $initial['data']['title'];
                }
                if (isset($initial['data']['image'])) {
                    $media = Media::find($initial['data']['image']);
                    if ($media) {
                        $this->logoImage = $media->path;
                    }
                }
            }
         
            // Logo sequence (mapped array)
            $this->logoSequence = $sequences->map(function ($item) {
                $mediaPath = null;
                if (isset($item['data']['image'])) {
                    $media = Media::find($item['data']['image']);
                    $mediaPath = $media ? $media->path : null;
                }

                return [
                    'year' => $item['data']['title'] ?? '',
                    'src' => $mediaPath,
                    'alt' => 'Logo tahun ' . ($item['data']['title'] ?? ''),
                ];
            })->filter(fn ($seq) => $seq['src'])->values()->toArray();
        
        }
    

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