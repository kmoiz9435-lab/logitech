<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhyChooseRequest;
use App\Models\WhyChooseItem;

class WhyChooseController extends Controller
{
    public function index()
    {
        $items = WhyChooseItem::ordered()->paginate(12);

        return view('admin.why-choose.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why-choose.create', ['item' => new WhyChooseItem]);
    }

    public function store(WhyChooseRequest $request)
    {
        WhyChooseItem::create($request->validated());

        return redirect()->route('admin.why-choose.index')->with('success', 'Why Choose Us item created successfully.');
    }

    public function edit(WhyChooseItem $whyChoose)
    {
        return view('admin.why-choose.edit', ['item' => $whyChoose]);
    }

    public function update(WhyChooseRequest $request, WhyChooseItem $whyChoose)
    {
        $whyChoose->update($request->validated());

        return redirect()->route('admin.why-choose.index')->with('success', 'Why Choose Us item updated successfully.');
    }

    public function destroy(WhyChooseItem $whyChoose)
    {
        $whyChoose->delete();

        return redirect()->route('admin.why-choose.index')->with('success', 'Why Choose Us item deleted successfully.');
    }
}
