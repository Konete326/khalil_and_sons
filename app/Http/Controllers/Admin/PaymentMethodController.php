<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PaymentMethodController extends Controller
{
    public function index(): View
    {
        $methods = PaymentMethod::all();
        return view('admin.payments', compact('methods'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:100',
            'iban' => 'nullable|string|max:100',
            'swift_code' => 'nullable|string|max:50',
            'bank_name' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('qr_code')) {
            $file = $request->file('qr_code');
            $filename = 'qr_' . Str::random(32) . '.' . $file->extension();
            $file->move(public_path('assets/payments/qr'), $filename);
            $instructions = trim(($validated['instructions'] ?? '') . "\nQR_IMAGE:/assets/payments/qr/{$filename}");
            $validated['instructions'] = $instructions;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $paymentMethod->update($validated);

        return back()->with('status', "Payment configuration for {$paymentMethod->title} updated.");
    }
}
