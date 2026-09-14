<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use App\Models\PaymentMethod;
use App\Services\GeminiAtelierService;
use App\Services\Tripo3DService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CustomOrderController extends Controller
{
    public function chat(Request $request, GeminiAtelierService $service): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'history' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);
        $imagePath = $request->hasFile('image') ? $request->file('image')->getRealPath() : null;
        $result = $service->chat($validated['message'], $validated['history'] ?? [], $imagePath);
        return response()->json($result);
    }

    public function generate3D(Request $request, Tripo3DService $service): JsonResponse
    {
        $prompt = $request->input('prompt', '22k gold bridal jewellery');
        $imagePublicUrl = $request->input('image_url');
        return response()->json($service->createDraftModel($prompt, $imagePublicUrl));
    }

    public function poll3D(string $taskId, Tripo3DService $service): JsonResponse
    {
        return response()->json($service->pollTaskStatus($taskId));
    }

    public function storeOrder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_email' => 'nullable|email|max:255',
            'karat' => 'required|string|max:20',
            'target_weight_grams' => 'nullable|numeric|min:0.1',
            'estimated_budget' => 'required|numeric|min:0',
            'provides_own_gold' => 'nullable|boolean',
            'customer_gold_weight' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'model_3d_url' => 'nullable|string',
            'original_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $imagePath = '/assets/products/choker-ruby-01.jpg';
        if ($request->hasFile('original_image')) {
            $file = $request->file('original_image');
            $filename = 'custom_' . Str::random(32) . '.' . $file->extension();
            $file->move(public_path('assets/products'), $filename);
            $imagePath = "/assets/products/{$filename}";
        }

        $code = 'KS-ORD-' . strtoupper(Str::random(8));
        $order = CustomOrder::create([
            'tracking_code' => $code,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'original_image_path' => $imagePath,
            'model_3d_url' => $validated['model_3d_url'] ?? null,
            'karat' => $validated['karat'],
            'target_weight_grams' => $validated['target_weight_grams'] ?? 20,
            'estimated_budget' => $validated['estimated_budget'],
            'provides_own_gold' => (bool) ($validated['provides_own_gold'] ?? false),
            'customer_gold_weight' => $validated['customer_gold_weight'] ?? 0,
            'notes' => $validated['notes'] ?? null,
            'payment_status' => 'pending',
            'manufacturing_status' => 'inquiry',
        ]);

        return response()->json(['success' => true, 'tracking_code' => $code, 'order' => $order, 'track_url' => route('track', ['code' => $code])]);
    }

    public function uploadSlip(Request $request, string $code): JsonResponse
    {
        $request->validate(['slip' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240']);
        $order = CustomOrder::where('tracking_code', $code)->firstOrFail();

        if (in_array($order->payment_status, ['verified'], true) || in_array($order->manufacturing_status, ['in_workshop', 'ready_for_dispatch', 'completed'], true)) {
            return response()->json(['success' => false, 'message' => 'Payment slip cannot be updated for an active or verified commission.'], 403);
        }

        $file = $request->file('slip');
        $filename = 'slip_' . Str::random(32) . '.' . $file->extension();
        $path = $file->storeAs('slips', $filename, 'local');
        $order->update(['payment_slip_path' => $path, 'payment_status' => 'slip_uploaded']);
        return response()->json(['success' => true, 'message' => 'Payment slip uploaded securely to atelier vault.', 'order' => $order]);
    }

    public function track(?string $code = null): View
    {
        $searchCode = $code ?: request('code');
        $order = !empty($searchCode) ? CustomOrder::where('tracking_code', trim($searchCode))->first() : null;
        $paymentMethods = PaymentMethod::where('is_active', true)->get();
        return view('track', compact('order', 'searchCode', 'paymentMethods'));
    }
}
