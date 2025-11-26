<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    {{-- Theme color для мобильных браузеров --}}
    <meta name="theme-color" content="#D4AF37">

    {{-- 🔥 ВАЖНО: добавляем атрибут "inertia" чтобы теги заменялись --}}
    <title inertia>{{ $page['props']['meta']['title'] ?? 'Sushiko - Доставка суши в Кишинёве' }}</title>

    <meta name="description" inertia
        content="{{ $page['props']['meta']['description'] ?? 'Закажите свежие суши и роллы с доставкой в Кишинёве' }}">

    {{-- Open Graph --}}
    <meta property="og:title" inertia content="{{ $page['props']['meta']['title'] ?? 'Sushiko' }}">
    <meta property="og:description" inertia content="{{ $page['props']['meta']['description'] ?? 'Доставка суши' }}">
    <meta property="og:image" inertia content="{{ $page['props']['meta']['image'] ?? asset('images/og-default.jpg') }}">
    <meta property="og:url" inertia content="{{ url()->current() }}">
    <meta property="og:type" inertia content="{{ $page['props']['meta']['og_type'] ?? 'website' }}">
    <meta property="og:site_name" content="Sushiko">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" inertia content="{{ $page['props']['meta']['title'] ?? 'Sushiko' }}">
    <meta name="twitter:description" inertia content="{{ $page['props']['meta']['description'] ?? 'Доставка суши' }}">
    <meta name="twitter:image" inertia
        content="{{ $page['props']['meta']['image'] ?? asset('images/og-default.jpg') }}">

    {{-- Canonical --}}
    <link rel="canonical" inertia href="{{ url()->current() }}">

    {{-- Hreflang --}}
    @php
        $currentPath = request()->path();
        $pathWithoutLocale = preg_replace('/^(ru|ro|en)/', '', $currentPath);
        $pathWithoutLocale = $pathWithoutLocale ?: '/';
    @endphp
    <link rel="alternate" hreflang="ru" inertia href="{{ url('/ru' . $pathWithoutLocale) }}">
    <link rel="alternate" hreflang="ro" inertia href="{{ url('/ro' . $pathWithoutLocale) }}">
    <link rel="alternate" hreflang="en" inertia href="{{ url('/en' . $pathWithoutLocale) }}">
    <link rel="alternate" hreflang="x-default" inertia href="{{ url('/ru' . $pathWithoutLocale) }}">

    <!-- Fonts: Bunny Figtree -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap">
    </noscript>

    <!-- Font Awesome CDN (неблокирующая загрузка) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </noscript>

    <!-- Google Fonts: Inter, Playfair, Noto Sans JP -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700;800&family=Noto+Sans+JP:wght@400;500;700&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700;800&family=Noto+Sans+JP:wght@400;500;700&display=swap">
    </noscript>


    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
