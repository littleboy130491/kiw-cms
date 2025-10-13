<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use Littleboy130491\Sumimasen\Models\Component as ComponentModel;
use Awcodes\Curator\Models\Media;

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
        // Get the component record
        $componentRecord = ComponentModel::where('title', 'popup')
                            ->first(); 
   
        // Default values
        $this->setOnce = $setOnce;
        $this->image = $image;
        $this->alt = $alt;


        // Extract data from the record if it exists
        if ($componentRecord) {
            $sections = $componentRecord->section;

            // get from the main locale if empty
            if (empty($componentRecord->section)) {
                $sections = $componentRecord->getTranslation('section', config('cms.default_language'), true);
            }
       
            if (isset($sections[0])) {
                $data = $sections[0]['data'];

                // Set setOnce based on description field
                if (isset($data['description']) && $data['description'] === 'setOnce') {
                    $this->setOnce = true;
                }

                // Set image from Curator
                if (isset($data['image'])) {
                    $media = Media::find($data['image']);
                    $this->image = $media ? $media->path : $this->image;
                 
                    // Optionally use alt text from media if available
                    if ($media && $media->alt) {
                        $this->alt = $media->alt;
                    }
                }
            }
        }

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