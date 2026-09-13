<!DOCTYPE html>
<html lang="en" class="h-full overflow-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Patron Account | Khalil & Sons Jewellers</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen w-screen overflow-hidden flex items-center justify-center bg-[#0d0202] text-ivory-base p-4 font-sans select-none">
    <div class="w-full max-w-lg bg-[#160303]/95 border border-gold-antique/40 p-7 sm:p-9 shadow-2xl rounded-lg backdrop-blur-md">
        <div class="text-center mb-5">
            <a href="{{ route('home') }}" class="inline-block group">
                <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons" class="h-11 w-11 mx-auto object-contain mb-1.5 transition-transform group-hover:scale-105" />
            </a>
            <span class="text-[9px] font-mono tracking-[0.25em] text-gold-antique uppercase block">Private Salon Access</span>
            <h1 class="font-serif text-2xl text-gold-light mt-0.5 tracking-wider uppercase">Patron Registration</h1>
        </div>

        @if($errors->any())
            <div class="mb-3 border border-red-500/40 bg-red-950/60 p-2 text-xs text-red-200 rounded">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full border border-gold-antique/30 bg-black/50 px-3 py-2 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none rounded" placeholder="Begum / Sahib" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gold-antique/30 bg-black/50 px-3 py-2 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none rounded" placeholder="patron@example.com" />
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border border-gold-antique/30 bg-black/50 px-3 py-2 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none font-mono rounded" placeholder="03001234567" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gold-antique/30 bg-black/50 px-3 py-2 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none rounded" placeholder="Min 8 characters" />
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="w-full border border-gold-antique/30 bg-black/50 px-3 py-2 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none rounded" placeholder="Repeat password" />
                </div>
            </div>

            <button type="submit" class="w-full bg-gold-antique py-2.5 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl rounded mt-2">
                Establish Patron Account
            </button>
        </form>

        <div class="mt-5 border-t border-gold-antique/20 pt-3 text-center text-xs">
            <span class="text-ivory-base/60">Already registered?</span>
            <a href="{{ route('login') }}" class="text-gold-light hover:underline font-semibold ml-1">Sign In to Salon &rarr;</a>
        </div>
    </div>
</body>
</html>
