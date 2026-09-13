<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? "Khalil & Sons Jewellers | Luxury Heritage Jewellery Saddar Karachi" }}</title>
    <meta name="description" content="Handcrafted bridal heirlooms, polki, certified solitaires, and bespoke 22K/24K gold jewellery crafted by master artisans in Murshid Bazaar, Saddar, Karachi since 1991.">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo.png') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? "Khalil & Sons Jewellers | Luxury Heritage Jewellery Saddar Karachi" }}">
    <meta property="og:description" content="Handcrafted bridal heirlooms, polki, certified solitaires, and bespoke 22K/24K gold jewellery crafted by master artisans in Murshid Bazaar, Saddar, Karachi since 1991.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/logo.png') }}">
    <meta property="og:site_name" content="Khalil & Sons Jewellers">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? "Khalil & Sons Jewellers | Luxury Heritage Jewellery Saddar Karachi" }}">
    <meta name="twitter:description" content="Handcrafted bridal heirlooms, polki, certified solitaires, and bespoke 22K/24K gold jewellery crafted by master artisans in Murshid Bazaar, Saddar, Karachi since 1991.">
    <meta name="twitter:image" content="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "JewelryStore",
        "name": "Khalil & Sons Jewellers",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/logo.png') }}",
        "image": "{{ asset('assets/logo.png') }}",
        "telephone": "+923001234567",
        "priceRange": "$$$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Murshid Bazaar, Saddar",
            "addressLocality": "Karachi",
            "addressRegion": "Sindh",
            "addressCountry": "PK"
        }
    }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-ivory-base text-charcoal antialiased selection:bg-oxblood selection:text-gold-light">
    <x-layouts.metal-rates-bar />
    <x-layouts.header />
    
    <main id="main-content" class="flex-grow w-full">
        {{ $slot }}
    </main>

    <x-layouts.footer />

    <x-ui.notifications />
    <x-ui.modal />
</body>
</html>
