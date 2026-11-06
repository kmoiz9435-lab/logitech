<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $products = Product::active()->ordered()->get(['slug', 'updated_at']);

        $content = view('sitemap', [
            'products' => $products,
            'homeUpdated' => $products->max('updated_at') ?? now(),
        ])->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
