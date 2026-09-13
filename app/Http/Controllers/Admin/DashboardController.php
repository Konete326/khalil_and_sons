<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Models\GoldRate;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $activeOrdersCount = CustomOrder::whereNotIn('manufacturing_status', ['completed'])->count();
        $pendingSlipsCount = CustomOrder::where('payment_status', 'slip_uploaded')->count();
        $rates = GoldRate::where('is_active', true)->get()->keyBy('karat');
        $pipelineRevenue = CustomOrder::whereIn('payment_status', ['verified', 'slip_uploaded'])->sum('estimated_budget');
        $recentOrders = CustomOrder::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'activeOrdersCount',
            'pendingSlipsCount',
            'rates',
            'pipelineRevenue',
            'recentOrders'
        ));
    }
}
