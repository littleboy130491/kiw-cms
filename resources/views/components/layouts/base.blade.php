@props([
    'title' => config('app.name'),
    'description' => null,
    'keywords' => null,
    'bodyClasses' => '',
    'noIndex' => false,
    'canonicalUrl' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- SEO Meta Tags --}}
    @if($noIndex)
        <meta name="robots" content="noindex, nofollow">
    @endif
    
    @if($canonicalUrl)
        <link rel="canonical" href="{{ $canonicalUrl }}">
    @endif
    
    {{-- Dynamic SEO Generation --}}
    {!! SEO::generate() !!}
    
    {{-- Preload Critical Resources --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    {{-- Google Fonts --}}
    <link 
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" 
        rel="stylesheet"
    >
    
    {{-- Core Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Page-specific head content --}}
    @stack('head')
    
    {{-- Legacy stack for backward compatibility --}}
    @stack('after_head_open')
    @stack('before_head_close')
</head>

<body class="{{ $bodyClasses }}">
    {{-- Page content --}}
    @stack('after_body_open')
    
    {{ $slot }}
    
    {{-- Page-specific scripts --}}
    @stack('scripts')
    
    {{-- Legacy stack for backward compatibility --}}
    @stack('before_body_close')
</body>
</html>