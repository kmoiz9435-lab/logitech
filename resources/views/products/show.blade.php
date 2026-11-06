@extends('layouts.frontend')

@section('content')
    <section class="relative overflow-hidden bg-[#101D2D] pt-24 lg:pt-28 pb-12">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover opacity-[0.08] scale-105">
        <div class="absolute inset-0 bg-gradient-to-b from-[#101D2D]/70 via-[#101D2D]/90 to-[#101D2D]"></div>
        <div class="relative container mx-auto px-6 lg:px-16 pt-8">
            <nav aria-label="Breadcrumb" class="text-xs font-medium text-[#F4F6F8]/40 mb-4">
                <ol class="flex items-center gap-2"><li><a href="{{ route('home') }}" class="hover:text-[#D6A84B]">{{ setting('nav_home_label', 'Home') }}</a></li><li>/</li><li><a href="{{ route('products.index') }}" class="hover:text-[#D6A84B]">{{ setting('product_breadcrumb_label', 'Products') }}</a></li><li>/</li><li class="text-[#D6A84B]">{{ $product->name }}</li></ol>
            </nav>
            <h1 class="text-gradient-gold text-3xl md:text-5xl lg:text-[3.2rem] font-extrabold leading-[1.1] tracking-[-0.03em]">{{ $product->name }}</h1>
            <p class="text-[#F4F6F8]/55 text-sm md:text-base mt-4 max-w-2xl leading-[1.8] border-l-2 border-[#D6A84B]/40 pl-4">{{ $product->short_description }}</p>
        </div>
    </section>

    <section class="bg-[#101D2D] py-8 lg:py-12">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid lg:grid-cols-5 gap-6 lg:gap-8">
                <div class="lg:col-span-3">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-2xl shadow-[0_20px_60px_rgba(16,29,45,0.8)]" loading="lazy">
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-3 mt-4">
                        @forelse($product->images as $img)
                            <img src="{{ $img->url }}" alt="{{ $img->alt_text ?? $product->name }}" class="w-full rounded-xl aspect-[4/3] object-cover shadow-md hover:opacity-90 transition-opacity" loading="lazy">
                        @empty
                            <span class="text-xs text-[#F4F6F8]/30">{{ setting('product_no_images_label', 'No additional images.') }}</span>
                        @endforelse
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <h2 class="text-gradient-gold text-2xl font-extrabold mb-4 tracking-tight">{{ setting('product_overview_heading', 'Overview') }}</h2>
                    <div id="product-description" class="read-more-content is-collapsed text-[#F4F6F8]/70 text-base leading-[1.8] whitespace-pre-line">{{ $product->description }}</div>
                    <button type="button" id="product-desc-toggle" class="read-more-toggle mt-3 inline-flex items-center gap-1.5 text-[#D6A84B] text-sm font-semibold hover:text-[#E8BC56] transition-colors lg:hidden" aria-expanded="false" aria-controls="product-description">
                        <span>Read More</span>
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>

                    @if($product->specifications->count())
                        <h3 class="text-xl font-extrabold mt-6 mb-3 tracking-tight pl-3 border-l-2 border-[#D6A84B]/60">{{ setting('product_specs_heading', 'Technical Specifications') }}</h3>
                        <table class="w-full text-sm border-collapse">
                            @foreach($product->specifications as $spec)
                                <tr class="border-b border-[#183B56]/30">
                                    <th class="text-left text-[#F4F6F8]/50 font-semibold py-3 pr-4 w-1/3">{{ $spec->label }}</th>
                                    <td class="text-[#F4F6F8]/90 font-medium py-3">{{ $spec->value }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    @if($product->features->count())
                        <h3 class="text-xl font-extrabold mt-6 mb-3 tracking-tight pl-3 border-l-2 border-[#D6A84B]/60">{{ setting('product_features_heading', 'Features') }}</h3>
                        <ul class="space-y-2">
                            @foreach($product->features as $feature)
                                <li class="flex items-start gap-3 text-sm text-[#F4F6F8]/70"><i class="fa-solid fa-check text-[#D6A84B] text-xs mt-0.5 shrink-0"></i><span>{{ $feature->title }}</span></li>
                            @endforeach
                        </ul>
                    @endif

                    @if($product->applications->count())
                        <h3 class="text-xl font-extrabold mt-6 mb-3 tracking-tight pl-3 border-l-2 border-[#D6A84B]/60">{{ setting('product_applications_heading', 'Applications') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->applications as $app)
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-[#183B56]/50 border border-[#183B56]/40 text-[#F4F6F8]/80">{{ $app->title }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#101D2D] pb-24 lg:pb-36">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="bg-[#0F1928] rounded-3xl border border-[#183B56]/30 p-8 md:p-10 shadow-[0_8px_30px_rgba(16,29,45,0.4)]">
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <div>
                        <h3 class="text-gradient-gold text-2xl md:text-3xl font-extrabold tracking-tight mb-4">{{ setting('product_custom_heading', 'Need a Custom Heating Solution?') }}</h3>
                        <p class="text-[#F4F6F8]/60 mb-4">{{ setting('product_custom_text', 'Share your part details, production target and material. Our engineers will recommend the right machine, coil and process settings for your operation.') }}</p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-6 py-3.5 bg-[#D6A84B] text-[#101D2D] rounded-full font-extrabold hover:bg-[#E8BC56] transition-all shadow-[0_8px_30px_rgb(214,168,75,0.25)]">{{ setting('product_quote_btn', 'Request a Quote') }} <i class="fa-solid fa-arrow-right-long"></i></a>
                            <a href="{{ whatsapp_link($product->whatsapp_message ?? '') }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3.5 border border-[#F07632]/40 text-[#F07632] rounded-full font-semibold hover:bg-[#F07632]/10 hover:border-[#F07632]/60 transition-all">{{ setting('product_whatsapp_btn', 'WhatsApp Inquiry') }} <i class="fa-brands fa-whatsapp text-base"></i></a>
                        </div>
                    </div>
                    <div class="bg-[#183B56]/20 rounded-2xl p-6 border border-[#183B56]/30">
                        <h4 class="font-extrabold mb-4 pl-3 border-l-2 border-[#D6A84B]/60">{{ setting('product_related_heading', 'Related Machinery') }}</h4>
                        <div class="space-y-3">
                            @forelse($relatedProducts as $related)
                                <a href="{{ route('products.show', $related->slug) }}" class="flex items-center gap-4 group p-2 rounded-xl hover:bg-[#183B56]/20 transition-colors">
                                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-14 h-14 rounded-lg object-cover shadow-md shrink-0" loading="lazy">
                                    <div>
                                        <div class="font-bold text-sm leading-tight group-hover:text-[#D6A84B] transition-colors">{{ $related->name }}</div>
                                        <div class="text-[11px] text-[#F4F6F8]/40">{{ $related->category?->name }}</div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-[#F4F6F8]/40">{{ setting('product_related_empty', 'No related machinery found.') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
