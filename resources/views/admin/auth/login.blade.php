<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proprietor Login | Khalil & Sons Jewellers</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#140202] text-ivory-base font-sans antialiased flex items-center justify-center p-4">
    <div class="w-full max-w-md border border-gold-antique/40 bg-oxblood-dark/95 p-8 shadow-2xl backdrop-blur-md">
        <div class="text-center mb-8">
            <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons" class="h-14 w-14 mx-auto object-contain mb-3" />
            <h1 class="font-serif text-2xl text-gold-light tracking-wider uppercase">Khalil & Sons</h1>
            <p class="text-[10px] tracking-[0.25em] text-gold-antique uppercase mt-1">Sarafa Proprietor Terminal • Saddar</p>
        </div>

        @if($errors->any())
            <div class="mb-6 border border-red-500/40 bg-red-950/60 p-3.5 text-xs text-red-200">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] uppercase tracking-wider text-gold-antique mb-1">Proprietor Email</label>
                <input type="email" name="email" value="{{ old('email', 'admin@khaliljewellers.pk') }}" required autofocus class="w-full border border-gold-antique/30 bg-black/40 px-3.5 py-2.5 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none" />
            </div>

            <div>
                <label class="block text-[11px] uppercase tracking-wider text-gold-antique mb-1">Secret Access Key</label>
                <input type="password" name="password" required class="w-full border border-gold-antique/30 bg-black/40 px-3.5 py-2.5 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none" />
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center space-x-2 text-ivory-base/70 cursor-pointer">
                    <input type="checkbox" name="remember" class="border-gold-antique/40 bg-black/40 text-gold-antique" />
                    <span class="text-[11px]">Remember terminal</span>
                </label>
                <a href="{{ route('home') }}" class="text-[11px] text-gold-antique hover:text-gold-light underline">Return to Boutique</a>
            </div>

            <button type="submit" class="w-full bg-gold-antique py-3 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl mt-4">
                Authenticate Session
            </button>
        </form>

        <div class="mt-8 border-t border-gold-antique/20 pt-4 text-center text-[10px] text-ivory-base/40 uppercase tracking-widest font-mono">
            Saddar Murshid Bazaar Hallmark Certified Terminal
        </div>
    </div>
</body>
</html>
