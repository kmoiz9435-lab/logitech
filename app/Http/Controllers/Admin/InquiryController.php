<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InquiryStatusRequest;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->string('q')->toString());
        $status = $request->string('status')->toString();
        $productId = $request->integer('product');

        $inquiries = Inquiry::with('product')
            ->search($search)
            ->when(array_key_exists($status, Inquiry::STATUSES), fn ($query) => $query->where('status', $status))
            ->when($productId, fn ($query) => $query->where('product_id', $productId))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statusCounts = Inquiry::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $products = Product::ordered()->get(['id', 'name']);

        return view('admin.inquiries.index', compact(
            'inquiries',
            'statusCounts',
            'products',
            'search',
            'status',
            'productId'
        ));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load('product');

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(InquiryStatusRequest $request, Inquiry $inquiry)
    {
        $inquiry->update(['status' => $request->validated('status')]);

        return back()->with('success', 'Inquiry status updated to '.$inquiry->status_label.'.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
