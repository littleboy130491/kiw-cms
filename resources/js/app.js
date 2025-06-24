// Core dependencies
import './bootstrap.js';

// Utility modules
import './utils/accessibility.js';
import './utils/phone-separator.js';
import './utils/counter.js';
import './utils/fallback-video-image.js';

// UI Components
import './components/modal.js';
import './components/video.js';
import './components/swiper.js';
import './components/accordion.js';
import './components/tooltip.js';

// Interactive features
import './features/comments.js';
import './features/forms.js';
import './features/social.js';

// Page-specific modules (lazy loaded)
import './pages/home.js';

// Initialize splash screen
import './components/splash-screen.js';

// Initialize theme switcher
import './components/bg-switcher.js';

// Initialize AOS animations
import './components/aos-animate.js';

import {Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm'

Livewire.start()