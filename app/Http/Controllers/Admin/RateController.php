<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoldRate;
use App\Services\MetalRateSyncService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RateController extends Controller
{
    public function index(): View
    {
        $rates = GoldRate::where('is_active', true)->get()->keyBy('karat');
        return view('admin.rates', compact('rates'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'karat' => 'required|string|max:20',
            'rate_per_tola' => 'required|numeric|min:100',
        ]);

        $tola = (float) $validated['rate_per_tola'];
        $gram = round($tola / 11.6638, 2);

        GoldRate::updateOrCreate(
            ['karat' => $validated['karat']],
            [
                'rate_per_gram' => $gram,
                'rate_per_tola' => $tola,
                'effective_date' => now(),
                'is_active' => true,
            ]
        );

        return back()->with('status', "{$validated['karat']} rate updated to Rs. " . number_format($tola) . "/tola.");
    }

    public function sync(MetalRateSyncService $service): RedirectResponse
    {
        $service->sync();
        return back()->with('status', 'Live Karachi Sarafa market rates synchronized successfully via GoldAPI.');
    }
}
