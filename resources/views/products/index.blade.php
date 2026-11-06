@extends('layouts.frontend')

@section('content')
    <section class="relative min-h-[40vh] flex items-end overflow-hidden">
        <img src="{{ media_url(section_value('products', 'image'), 'uploads/seed/machine-line.jpg') }}" alt="Products" class="absolute inset-0 w-full h-full object-cover z-0 opacity-25 scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-[#101D2D] via-[#101D2D]/70 to-[#101D2D]/30 z-10"></div>
        <div class="relative z-20 container mx-auto px-6 lg:px-16 pb-20 pt-36">
            <nav aria-label="Breadcrumb" class="text-xs font-medium text-[#F4F6F8]/40 mb-4">
                <ol class="flex items-center gap-2"><li><a href="{{ route('home') }}" class="hover:text-[#D6A84B]">{{ setting('nav_home_label', 'Home') }}</a></li><li>/</li><li class="text-[#D6A84B]">{{ setting('product_breadcrumb_label', 'Products') }}</li></ol>
            </nav>
            <h1 class="text-gradient-gold text-4xl md:text-6xl font-extrabold tracking-[-0.03em] leading-[1.05]">{{ section_value('products', 'heading') }}</h1>
            <p class="text-[#F4F6F8]/60 text-sm md:text-base mt-4 max-w-2xl leading-[1.8] border-l-2 border-[#D6A84B]/40 pl-4">{{ section_value('products', 'sub_heading') }}</p>
        </div>
    </section>

    <section class="relative bg-[#0F1928] py-10 lg:py-12">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="filter-chips grid grid-cols-2 gap-2 mb-6 sm:flex sm:flex-wrap">
                <a href="{{ route('products.index') }}" class="flex items-center justify-center text-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm leading-tight font-semibold transition-colors {{ $selectedCategory ? 'bg-[#183B56]/30 text-[#F4F6F8]/70 hover:text-white hover:bg-[#183B56]/60 border border-[#183B56]/30' : 'bg-[#D6A84B] text-[#101D2D] shadow-md' }}">{{ setting('products_all_label', 'All Products') }}</a>
                @forelse($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="flex items-center justify-center text-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm leading-tight font-medium transition-colors {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'bg-[#D6A84B] text-[#101D2D] shadow-md' : 'bg-[#183B56]/30 text-[#F4F6F8]/70 hover:text-white hover:bg-[#183B56]/60 border border-[#183B56]/30' }}">{{ $cat->name }}</a>
                @empty
                    <span class="text-sm text-[#F4F6F8]/30 px-2">{{ setting('products_no_categories', 'No categories yet.') }}</span>
                @endforelse
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="flex gap-3 mb-6">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="{{ setting('products_search_placeholder', 'Search products...') }}" class="w-full px-5 py-3 rounded-xl bg-[#101D2D] border border-[#183B56]/40 text-white text-sm focus:outline-none focus:border-[#D6A84B]/60">
                <button type="submit" class="px-6 py-3 bg-[#183B56] text-white rounded-xl font-semibold text-sm hover:bg-[#234B6F] transition-colors">{{ setting('products_search_btn', 'Search') }}</button>
            </form>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($products as $product)
                    <article class="bg-[#101D2D] rounded-2xl overflow-hidden border border-[#183B56]/30 shadow-[0_8px_30px_rgba(16,29,45,0.6)] hover:shadow-[0_20px_60px_rgba(214,168,75,0.12)] transition-all duration-300 hover:-translate-y-1.5 flex flex-col">
                        <a href="{{ route('products.show', $product->slug) }}" class="block overflow-hidden relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-60 object-cover hover:scale-[1.04] transition-transform duration-500" loading="lazy">
                            @if($product->is_featured)
                                <span class="absolute top-3 left-3 bg-[#D6A84B] text-[#101D2D] text-[10px] font-extrabold uppercase tracking-wide px-2.5 py-1 rounded-md shadow-md">{{ setting('products_featured_label', 'Featured') }}</span>
                            @endif
                        </a>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#D6A84B]/90 mb-2">{{ $product->category?->name }}</span>
                            <h3 class="text-xl font-extrabold mb-3 leading-tight tracking-tight"><a href="{{ route('products.show', $product->slug) }}" class="hover:text-[#D6A84B] transition-colors">{{ $product->name }}</a></h3>
                            <p class="text-[#F4F6F8]/60 text-sm leading-relaxed mb-5 flex-grow">{{ $product->short_description }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#D6A84B] hover:text-[#F07832] transition-colors">{{ setting('products_view_details_label', 'View Details') }} <i class="fa-solid fa-arrow-right-long text-xs"></i></a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center text-[#F4F6F8]/40 py-12">{{ setting('products_page_empty_label', 'No products found.') }}</div>
                @endforelse
            </div>

            <div class="mt-6">{{ $products->links() }}</div>
        </div>
    </section>
@endsection
