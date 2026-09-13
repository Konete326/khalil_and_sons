<!DOCTYPE html>
<html lang="en" class="h-full overflow-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patron Sign In | Khalil & Sons Jewellers</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen w-screen overflow-hidden flex items-center justify-center bg-[#0d0202] text-ivory-base p-4 font-sans select-none">
    <div class="w-full max-w-md bg-[#160303]/95 border border-gold-antique/40 p-8 sm:p-10 shadow-2xl rounded-lg backdrop-blur-md">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-block group">
                <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons" class="h-12 w-12 mx-auto object-contain mb-2 transition-transform group-hover:scale-105" />
            </a>
            <span class="text-[9px] font-mono tracking-[0.25em] text-gold-antique uppercase block">Private Salon Access</span>
            <h1 class="font-serif text-2xl text-gold-light mt-0.5 tracking-wider uppercase">Patron Sign In</h1>
        </div>

        @if(session('status'))
            <div class="mb-4 border border-gold-antique/40 bg-gold-antique/10 p-2.5 text-xs text-gold-light text-center font-mono rounded">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 border border-red-500/40 bg-red-950/60 p-2.5 text-xs text-red-200 rounded">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-gold-antique/30 bg-black/50 px-3.5 py-2.5 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none rounded" placeholder="patron@example.com" />
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Password</label>
                <input type="password" name="password" required class="w-full border border-gold-antique/30 bg-black/50 px-3.5 py-2.5 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none rounded" placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between text-xs pt-0.5">
                <label class="flex items-center space-x-2 text-ivory-base/70 cursor-pointer">
                    <input type="checkbox" name="remember" class="border-gold-antique/40 bg-black/40 text-gold-antique rounded-sm" />
                    <span class="text-[11px]">Remember me</span>
                </label>
                <a href="{{ route('home') }}" class="text-[11px] text-gold-antique hover:text-gold-light underline">Back to Store</a>
            </div>

            <button type="submit" class="w-full bg-gold-antique py-2.5 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl rounded mt-2">
                Sign In to Salon
            </button>
        </form>

        <div class="mt-6 border-t border-gold-antique/20 pt-4 text-center text-xs">
            <span class="text-ivory-base/60">New to our atelier?</span>
            <a href="{{ route('register') }}" class="text-gold-light hover:underline font-semibold ml-1">Create Account &rarr;</a>
        </div>
    </div>
</body>
</html>
