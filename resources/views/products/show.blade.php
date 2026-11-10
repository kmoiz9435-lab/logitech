@extends('layouts.frontend')

@section('content')
    <section class="relative overflow-hidden bg-[#263746] pt-24 lg:pt-28 pb-12">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover opacity-[0.08] scale-105">
        <div class="absolute inset-0 bg-gradient-to-b from-[#263746]/70 via-[#263746]/90 to-[#263746]"></div>
        <div class="relative container mx-auto px-6 lg:px-16 pt-8">
            <nav aria-label="Breadcrumb" class="text-xs font-medium text-[#AEB6BB] mb-4">
                <ol class="flex items-center gap-2"><li><a href="{{ route('home') }}" class="hover:text-white">{{ setting('nav_home_label', 'Home') }}</a></li><li>/</li><li><a href="{{ route('products.index') }}" class="hover:text-white">{{ setting('product_breadcrumb_label', 'Products') }}</a></li><li>/</li><li class="text-white font-semibold">{{ $product->name }}</li></ol>
            </nav>
            <h1 class="text-white text-3xl md:text-5xl lg:text-[3.2rem] font-extrabold leading-[1.1] tracking-[-0.03em]">{{ $product->name }}</h1>
            <p class="text-[#F5F5F5]/85 text-sm md:text-base mt-4 max-w-2xl leading-[1.8] border-l-2 border-[#477694] pl-4">{{ $product->short_description }}</p>
        </div>
    </section>

    <section class="bg-[#FFFFFF] py-8 lg:py-12">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid lg:grid-cols-5 gap-6 lg:gap-8">
                <div class="lg:col-span-3">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-2xl shadow-lg border border-[#AEB6BB]/30" loading="lazy">
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-3 mt-4">
                        @forelse($product->images as $img)
                            <img src="{{ $img->url }}" alt="{{ $img->alt_text ?? $product->name }}" class="w-full rounded-xl aspect-[4/3] object-cover shadow-sm border border-[#AEB6BB]/30 hover:opacity-90 hover:border-[#477694] transition-all" loading="lazy">
                        @empty
                            <span class="text-xs text-[#64748B]">{{ setting('product_no_images_label', 'No additional images.') }}</span>
                        @endforelse
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <h2 class="text-[#263746] text-2xl font-extrabold mb-4 tracking-tight">{{ setting('product_overview_heading', 'Overview') }}</h2>
                    <div id="product-description" class="read-more-content is-collapsed text-[#475569] text-base leading-[1.8] whitespace-pre-line">{{ $product->description }}</div>
                    <button type="button" id="product-desc-toggle" class="read-more-toggle mt-3 inline-flex items-center gap-1.5 text-[#477694] text-sm font-semibold hover:text-[#263746] transition-colors lg:hidden" aria-expanded="false" aria-controls="product-description">
                        <span>Read More</span>
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>

                    @if($product->specifications->count())
                        <h3 class="text-xl font-extrabold mt-6 mb-3 tracking-tight pl-3 border-l-2 border-[#477694] text-[#263746]">{{ setting('product_specs_heading', 'Technical Specifications') }}</h3>
                        <table class="w-full text-sm border-collapse">
                            @foreach($product->specifications as $spec)
                                <tr class="border-b border-[#AEB6BB]/30">
                                    <th class="text-left text-[#64748B] font-semibold py-3 pr-4 w-1/3">{{ $spec->label }}</th>
                                    <td class="text-[#263746] font-medium py-3">{{ $spec->value }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    @if($product->features->count())
                        <h3 class="text-xl font-extrabold mt-6 mb-3 tracking-tight pl-3 border-l-2 border-[#477694] text-[#263746]">{{ setting('product_features_heading', 'Features') }}</h3>
                        <ul class="space-y-2">
                            @foreach($product->features as $feature)
                                <li class="flex items-start gap-3 text-sm text-[#334155]"><i class="fa-solid fa-check text-[#477694] text-xs mt-0.5 shrink-0"></i><span>{{ $feature->title }}</span></li>
                            @endforeach
                        </ul>
                    @endif

                    @if($product->applications->count())
                        <h3 class="text-xl font-extrabold mt-6 mb-3 tracking-tight pl-3 border-l-2 border-[#477694] text-[#263746]">{{ setting('product_applications_heading', 'Applications') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->applications as $app)
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-[#F5F5F5] border border-[#AEB6BB]/40 text-[#263746]">{{ $app->title }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#F5F5F5] pb-24 lg:pb-36">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="bg-[#FFFFFF] rounded-3xl border border-[#AEB6BB]/40 p-8 md:p-10 shadow-sm">
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <div>
                        <h3 class="text-[#263746] text-2xl md:text-3xl font-extrabold tracking-tight mb-4">{{ setting('product_custom_heading', 'Need a Custom Heating Solution?') }}</h3>
                        <p class="text-[#64748B] mb-4">{{ setting('product_custom_text', 'Share your part details, production target and material. Our engineers will recommend the right machine, coil and process settings for your operation.') }}</p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-6 py-3.5 bg-[#477694] text-white rounded-full font-extrabold hover:bg-[#38607a] transition-all shadow-md">{{ setting('product_quote_btn', 'Request a Quote') }} <i class="fa-solid fa-arrow-right-long"></i></a>
                            <a href="{{ whatsapp_link($product->whatsapp_message ?? '') }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3.5 border border-[#477694] text-[#477694] rounded-full font-semibold hover:bg-[#477694] hover:text-white transition-all">{{ setting('product_whatsapp_btn', 'WhatsApp Inquiry') }} <i class="fa-brands fa-whatsapp text-base"></i></a>
                        </div>
                    </div>
                    <div class="bg-[#F5F5F5] rounded-2xl p-6 border border-[#AEB6BB]/35">
                        <h4 class="font-extrabold mb-4 pl-3 border-l-2 border-[#477694] text-[#263746]">{{ setting('product_related_heading', 'Related Machinery') }}</h4>
                        <div class="space-y-3">
                            @forelse($relatedProducts as $related)
                                <a href="{{ route('products.show', $related->slug) }}" class="flex items-center gap-4 group p-2 rounded-xl hover:bg-white transition-colors">
                                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-14 h-14 rounded-lg object-cover shadow-sm shrink-0" loading="lazy">
                                    <div>
                                        <div class="font-bold text-sm leading-tight text-[#263746] group-hover:text-[#477694] transition-colors">{{ $related->name }}</div>
                                        <div class="text-[11px] text-[#64748B]">{{ $related->category?->name }}</div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-[#64748B]">{{ setting('product_related_empty', 'No related machinery found.') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
