<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'inactive_products' => Product::where('is_active', false)->count(),
            'categories' => ProductCategory::count(),
            'inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
        ];

        $recentInquiries = Inquiry::with('product')->latest()->take(5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        $activityRaw = Inquiry::where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $activity = collect(range(13, 0))->map(function ($daysAgo) use ($activityRaw) {
            $date = now()->subDays($daysAgo)->startOfDay();

            return [
                'label' => $date->format('D'),
                'date' => $date->format('M j'),
                'count' => (int) ($activityRaw[$date->toDateString()] ?? 0),
            ];
        });

        $maxActivity = max(1, $activity->max('count'));

        return view('admin.dashboard', compact(
            'stats',
            'recentInquiries',
            'recentProducts',
            'activity',
            'maxActivity'
        ));
    }
}
