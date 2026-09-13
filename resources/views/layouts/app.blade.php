<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? "Khalil & Sons Jewellers | Luxury Heritage Jewellery Saddar Karachi" }}</title>
    <meta name="description" content="Handcrafted bridal heirlooms, polki, certified solitaires, and bespoke 22K/24K gold jewellery crafted by master artisans in Murshid Bazaar, Saddar, Karachi since 1991.">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-ivory-base text-charcoal antialiased selection:bg-oxblood selection:text-gold-light">
    <x-layouts.header />
    
    <main id="main-content" class="flex-grow">
        {{ $slot }}
    </main>

    <x-layouts.footer />

    <x-ui.notifications />
    <x-ui.modal />
</body>
</html>
