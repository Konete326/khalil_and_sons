<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function viewSlip(CustomOrder $order): Response
    {
        $path = $order->slip_url ?: $order->payment_slip_path;
        if (!$path) {
            abort(404, 'No slip recorded for this order.');
        }
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->response($path);
        }
        $publicPath = public_path(ltrim($path, '/'));
        if (file_exists($publicPath)) {
            return response()->file($publicPath);
        }
        abort(404, 'Payment slip file not found.');
    }
    public function index(Request $request): View
    {
        $filter = $request->input('status', 'all');
        $query = CustomOrder::latest();

        if ($filter === 'pending_slip') {
            $query->where('payment_status', 'slip_uploaded');
        } elseif ($filter === 'in_workshop') {
            $query->where('manufacturing_status', 'in_workshop');
        } elseif ($filter === 'ready_for_dispatch') {
            $query->where('manufacturing_status', 'ready_for_dispatch');
        } elseif ($filter === 'completed') {
            $query->where('manufacturing_status', 'completed');
        }

        $orders = $query->paginate(15)->withQueryString();
        return view('admin.orders.index', compact('orders', 'filter'));
    }

    public function show(CustomOrder $order): View
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updatePayment(Request $request, CustomOrder $order): RedirectResponse
    {
        $validated = $request->validate([
            'action' => 'required|in:verify,reject',
            'reason' => 'nullable|string|max:500',
        ]);

        if ($validated['action'] === 'verify') {
            $stage = $order->manufacturing_status === 'inquiry' ? 'in_workshop' : $order->manufacturing_status;
            $order->update([
                'payment_status' => 'verified',
                'manufacturing_status' => $stage,
            ]);
            return back()->with('status', 'Payment verified. Order advanced to Saddar workshop casting.');
        }

        $notes = trim(($order->notes ? $order->notes . ' | ' : '') . 'Rejected Slip: ' . ($validated['reason'] ?? 'Inconclusive transfer'));
        $order->update([
            'payment_status' => 'rejected',
            'notes' => $notes,
        ]);

        return back()->with('status', 'Payment slip marked as rejected. Patron notified.');
    }

    public function updateStage(Request $request, CustomOrder $order): RedirectResponse
    {
        $validated = $request->validate([
            'manufacturing_status' => 'required|in:inquiry,in_workshop,ready_for_dispatch,completed',
        ]);

        $order->update(['manufacturing_status' => $validated['manufacturing_status']]);
        return back()->with('status', 'Manufacturing stage updated to ' . ucfirst(str_replace('_', ' ', $validated['manufacturing_status'])) . '.');
    }
}
