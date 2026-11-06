@extends('admin.layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Company Settings</h2>
            <p class="text-[#9CA3AF] mt-1">Brand, contact details, social links, SEO aur website ke tamam labels yahan se control karein</p>
        </div>
        <button type="submit" form="settings-form" class="btn-primary px-6 py-3 rounded-xl font-semibold text-sm inline-flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-floppy-disk"></i> Save Settings
        </button>
    </div>

    @if(session('success'))
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="admin-card rounded-xl p-4 text-sm text-red-300 space-y-1">
            @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
        </div>
    @endif

    <form id="settings-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Brand --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-building text-[#D6A84B] mr-2"></i>Brand & Identity</h3>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Company Name *</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" required class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Tagline</label>
                    <input type="text" name="company_tagline" value="{{ old('company_tagline', $settings['company_tagline'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Short Description</label>
                    <textarea name="company_short_description" rows="2" class="form-input rounded-lg px-4 py-3 w-full">{{ old('company_short_description', $settings['company_short_description'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Logo</label>
                    @if(!empty($settings['logo']))
                        <div class="flex items-center gap-4 mb-3">
                            <img src="{{ media_url($settings['logo']) }}" alt="Logo" class="h-12 bg-white/10 rounded-lg p-1">
                            <label class="text-sm text-red-300 flex items-center gap-2"><input type="checkbox" name="remove_logo" value="1" class="custom-checkbox"> Remove logo</label>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="form-input rounded-lg px-4 py-2.5 w-full text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Favicon</label>
                    @if(!empty($settings['favicon']))
                        <div class="flex items-center gap-4 mb-3">
                            <img src="{{ media_url($settings['favicon']) }}" alt="Favicon" class="h-8 w-8 bg-white/10 rounded p-1">
                            <label class="text-sm text-red-300 flex items-center gap-2"><input type="checkbox" name="remove_favicon" value="1" class="custom-checkbox"> Remove</label>
                        </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*" class="form-input rounded-lg px-4 py-2.5 w-full text-sm">
                </div>
            </div>
        </div>

        {{-- Contact --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-address-book text-[#D6A84B] mr-2"></i>Contact Information</h3>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Phone *</label>
                    <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" required class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Secondary Phone</label>
                    <input type="text" name="phone_secondary" value="{{ old('phone_secondary', $settings['phone_secondary'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" required class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Secondary Email</label>
                    <input type="email" name="email_secondary" value="{{ old('email_secondary', $settings['email_secondary'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Business Hours</label>
                    <input type="text" name="business_hours" value="{{ old('business_hours', $settings['business_hours'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Address *</label>
                    <textarea name="address" rows="2" required class="form-input rounded-lg px-4 py-3 w-full">{{ old('address', $settings['address'] ?? '') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Google Map Embed URL</label>
                    <input type="text" name="map_embed_url" value="{{ old('map_embed_url', $settings['map_embed_url'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                    <p class="text-xs text-[#9CA3AF] mt-1">Google Maps &rarr; Share &rarr; Embed a map se src URL paste karein.</p>
                </div>
            </div>
        </div>

        {{-- Social --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-share-nodes text-[#D6A84B] mr-2"></i>Social Links</h3>
            <div class="grid md:grid-cols-2 gap-5">
                @foreach(['social_facebook' => 'Facebook', 'social_instagram' => 'Instagram', 'social_linkedin' => 'LinkedIn', 'social_youtube' => 'YouTube', 'social_x' => 'X (Twitter)'] as $key => $label)
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full" placeholder="https://...">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Navbar --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-bars text-[#D6A84B] mr-2"></i>Navigation Labels</h3>
            <div class="grid md:grid-cols-4 gap-5">
                @foreach(['nav_home_label' => 'Home', 'nav_about_label' => 'About', 'nav_industries_label' => 'Industries', 'nav_products_label' => 'Products', 'nav_why_label' => 'Why Choose Us', 'nav_contact_label' => 'Contact', 'nav_gallery_label' => 'Gallery', 'nav_cta_label' => 'Nav Button (CTA)'] as $key => $label)
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Buttons & labels --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-tag text-[#D6A84B] mr-2"></i>Buttons & Section Labels</h3>
            <div class="grid md:grid-cols-3 gap-5">
                @foreach([
                    'hero_primary_btn' => 'Hero Primary Button',
                    'hero_secondary_btn' => 'Hero Secondary Button',
                    'about_learn_more' => 'About "Learn More"',
                    'about_stat_value' => 'About Stat Value',
                    'about_stat_label' => 'About Stat Label',
                    'products_all_label' => 'Products "All"',
                    'products_view_all_label' => 'View All Products',
                    'products_view_details_label' => 'View Details',
                    'products_featured_label' => 'Featured Badge',
                    'products_search_placeholder' => 'Search Placeholder',
                    'products_search_btn' => 'Search Button',
                    'products_empty_label' => 'Empty (Home)',
                    'products_page_empty_label' => 'Empty (Products Page)',
                    'products_no_categories' => 'No Categories Text',
                    'industries_empty_label' => 'Industries Empty Text',
                    'why_empty_label' => 'Why Choose Empty Text',
                    'gallery_empty_label' => 'Gallery Empty Text',
                    'cta_btn_label' => 'CTA Button',
                ] as $key => $label)
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Contact form --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-envelope-open-text text-[#D6A84B] mr-2"></i>Contact Form & Info Labels</h3>
            <div class="grid md:grid-cols-3 gap-5">
                @foreach([
                    'contact_name_label' => 'Name Placeholder',
                    'contact_company_label' => 'Company Placeholder',
                    'contact_email_label' => 'Email Placeholder',
                    'contact_phone_label' => 'Phone Placeholder',
                    'contact_product_label' => 'Product Select Placeholder',
                    'contact_message_label' => 'Message Placeholder',
                    'contact_submit_label' => 'Submit Button',
                    'contact_info_heading' => 'Info Box Heading',
                    'contact_address_label' => 'Address Label',
                    'contact_phone_info_label' => 'Phone Label',
                    'contact_email_info_label' => 'Email Label',
                    'contact_whatsapp_info_label' => 'WhatsApp Label',
                    'contact_map_title' => 'Map Title',
                ] as $key => $label)
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Footer --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-shoe-prints text-[#D6A84B] mr-2"></i>Footer</h3>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Footer About Text</label>
                    <textarea name="footer_about" rows="3" class="form-input rounded-lg px-4 py-3 w-full">{{ old('footer_about', $settings['footer_about'] ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['footer_about_heading' => 'About Heading', 'footer_quick_links_heading' => 'Quick Links Heading', 'footer_products_heading' => 'Products Heading', 'footer_contact_heading' => 'Contact Heading', 'footer_social_heading' => 'Social Heading', 'footer_copyright' => 'Copyright Text'] as $key => $label)
                        <div>
                            <label class="block text-sm font-medium text-[#9CA3AF] mb-2">{{ $label }}</label>
                            <input type="text" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Product detail labels --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-box-open text-[#D6A84B] mr-2"></i>Product Page Labels</h3>
            <div class="grid md:grid-cols-3 gap-5">
                @foreach([
                    'product_overview_heading' => 'Overview Heading',
                    'product_specs_heading' => 'Specifications Heading',
                    'product_features_heading' => 'Features Heading',
                    'product_applications_heading' => 'Applications Heading',
                    'product_no_images_label' => 'No Images Text',
                    'product_custom_heading' => 'Custom CTA Heading',
                    'product_quote_btn' => 'Quote Button',
                    'product_whatsapp_btn' => 'WhatsApp Button',
                    'product_related_heading' => 'Related Heading',
                    'product_related_empty' => 'Related Empty Text',
                    'product_breadcrumb_label' => 'Breadcrumb Label',
                ] as $key => $label)
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                @endforeach
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Custom CTA Text</label>
                    <textarea name="product_custom_text" rows="2" class="form-input rounded-lg px-4 py-3 w-full">{{ old('product_custom_text', $settings['product_custom_text'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-magnifying-glass text-[#D6A84B] mr-2"></i>SEO</h3>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $settings['seo_title'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">SEO Keywords</label>
                    <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $settings['seo_keywords'] ?? '') }}" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">SEO Description</label>
                    <textarea name="seo_description" rows="2" class="form-input rounded-lg px-4 py-3 w-full">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- About points --}}
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-5"><i class="fa-solid fa-list-check text-[#D6A84B] mr-2"></i>About Points</h3>
            <label class="block text-sm font-medium text-[#9CA3AF] mb-2">One point per line</label>
            <textarea name="about_points" rows="4" class="form-input rounded-lg px-4 py-3 w-full">{{ old('about_points', $settings['about_points'] ?? '') }}</textarea>
        </div>

        <div class="flex justify-end gap-4 pb-6">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
