<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    public function store(InquiryRequest $request): RedirectResponse
    {
        $formTime = (int) $request->input('form_time');
        $elapsed = time() - $formTime;

        if ($elapsed < 2 || $elapsed > 7200) {
            return back()
                ->withInput($request->except('form_time'))
                ->withErrors(['form_time' => 'Your session expired. Please submit the form again.']);
        }

        $inquiry = Inquiry::create([
            'product_id' => $request->input('product_id'),
            'name' => $request->string('name')->toString(),
            'company_name' => $request->input('company_name'),
            'email' => $request->string('email')->toString(),
            'phone' => $request->string('phone')->toString(),
            'message' => $request->input('message'),
            'status' => 'new',
            'source' => $request->input('source', 'contact'),
            'ip_address' => $request->ip(),
        ]);

        $message = 'Thank you, '.$inquiry->name.'. Your inquiry has been received — our team will contact you shortly.';

        if ($inquiry->product_id) {
            return redirect()
                ->route('products.show', $inquiry->product->slug)
                ->with('success', $message)
                ->withFragment('quote');
        }

        return redirect()
            ->route('home')
            ->with('success', $message)
            ->withFragment('contact');
    }
}
