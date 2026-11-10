@extends('admin.layouts.admin')
@section('content')
<!-- Product Edit Form -->
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white">{{ $product->exists ? 'Edit Product' : 'Add New Product' }}</h2>
            <p class="text-[#9CA3AF] mt-1">
                {{ $product->exists ? 'Update product information and settings' : 'Create a new induction heating product' }}
            </p>
        </div>
        @if($product->exists)
            <div class="flex gap-3">
                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn-secondary px-4 py-2 rounded-lg font-medium text-sm inline-flex items-center gap-2">
                    <i class="fa-solid fa-eye"></i>
                    View
                </a>
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 text-[#9CA3AF] hover:text-white transition-colors">
                    Cancel
                </a>
            </div>
        @endif
    </div>

    <form id="admin-form" method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Basic Information -->
            <div class="lg:col-span-2 admin-card rounded-xl p-6">
                <h3 class="text-lg font-bold text-white mb-6">Basic Information</h3>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Product Name <span class="text-red-400">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="e.g., IH-15 High-Frequency Induction Heating Machine">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Product Slug <span class="text-red-400">*</span></label>
                        <div class="flex gap-2">
                            <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required class="form-input rounded-lg px-4 py-3 flex-1 focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="ih-15-high-frequency-induction-heating-machine">
                            <button type="button" onclick="generateSlug()" class="px-4 py-3 bg-[#183B56] text-[#D6A84B] rounded-lg hover:bg-[#183B56]/80 transition-colors">
                                <i class="fa-solid fa-magic"></i>
                            </button>
                        </div>
                        <p class="text-xs text-[#9CA3AF] mt-1">Used in URL: /products/your-product-slug</p>
                        @error('slug')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Category <span class="text-red-400">*</span></label>
                        <select name="product_category_id" required class="form-input rounded-lg px-4 py-3 w-full">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Short Description <span class="text-red-400">*</span></label>
                        <textarea name="short_description" rows="2" required class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="Brief description for product listings (max 500 characters)">{{ old('short_description', $product->short_description) }}</textarea>
                        <div class="text-xs text-[#9CA3AF] mt-1">Maximum 500 characters</div>
                        @error('short_description')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Full Description <span class="text-red-400">*</span></label>
                        <textarea name="description" rows="6" required class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="Detailed product description">{{ old('description', $product->description) }}</textarea>
                        <div class="text-xs text-[#9CA3AF] mt-1">Rich description with features and specifications</div>
                        @error('description')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#9CA3AF] mb-2">SEO Meta Title</label>
                            <input type="text" name="seo_meta_title" value="{{ old('seo_meta_title', $product->seo_meta_title) }}" class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="Page title for SEO">
                            <p class="text-xs text-[#9CA3AF] mt-1">If empty, will use product name</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#9CA3AF] mb-2">SEO Meta Description</label>
                            <textarea name="seo_meta_description" rows="2" class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="Brief description for search engines">{{ old('seo_meta_description', $product->seo_meta_description) }}</textarea>
                            <p class="text-xs text-[#9CA3AF] mt-1">Maximum 500 characters</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Media & Settings -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Main Image -->
                <div class="admin-card rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-white">Main Product Image</h3>
                        <span class="text-xs text-[#9CA3AF]">Max 6MB</span>
                    </div>

                    <div class="space-y-4">
                        {{-- Hidden real file input --}}
                        <input type="file" name="main_image" id="main_image_input" accept="image/jpeg,image/png,image/webp,image/jpg" class="hidden">
                        <input type="hidden" name="remove_main_image" id="remove_main_image_input" value="0">

                        {{-- Current Image Display (if exists) --}}
                        @if($product->main_image)
                            <div id="current_main_image_container" class="space-y-3">
                                <div class="relative group rounded-xl overflow-hidden border border-[#183B56]/60 bg-[#0B1521]">
                                    <img id="current_main_img_el" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <span class="absolute top-2 left-2 px-2.5 py-1 rounded bg-[#D6A84B] text-[#101D2D] text-xs font-bold shadow-md">Current Image</span>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" onclick="document.getElementById('main_image_input').click()" class="flex-1 py-2 px-3 bg-[#183B56] hover:bg-[#204a6e] text-[#D6A84B] rounded-lg text-xs font-semibold transition flex items-center justify-center gap-1.5">
                                        <i class="fa-solid fa-arrows-rotate"></i> Change Image
                                    </button>
                                    <button type="button" onclick="markMainImageRemoval()" id="btn_remove_main_img" class="py-2 px-3 bg-red-500/10 hover:bg-red-500/25 border border-red-500/30 text-red-400 rounded-lg text-xs font-semibold transition flex items-center justify-center gap-1.5">
                                        <i class="fa-solid fa-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        @endif

                        {{-- Removal notice when user clicks Remove on current image --}}
                        <div id="main_image_removed_box" class="hidden p-3 rounded-lg bg-red-500/15 border border-red-500/30 text-xs text-red-300 flex items-center justify-between">
                            <span><i class="fa-solid fa-triangle-exclamation mr-1 text-red-400"></i> Main image will be removed on save</span>
                            <button type="button" onclick="cancelMainImageRemoval()" class="text-[#D6A84B] hover:underline font-semibold">Undo</button>
                        </div>

                        {{-- Live Preview of NEWLY selected replacement image --}}
                        <div id="new_main_image_preview_box" class="hidden space-y-3 p-3 rounded-xl border-2 border-[#D6A84B] bg-[#0B1521]">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[#D6A84B] flex items-center gap-1.5">
                                    <i class="fa-solid fa-sparkles"></i> New Image Selected
                                </span>
                                <button type="button" onclick="cancelNewMainImage()" class="text-xs text-red-400 hover:text-red-300 flex items-center gap-1">
                                    <i class="fa-solid fa-xmark"></i> Cancel
                                </button>
                            </div>
                            <img id="new_main_image_preview" class="w-full h-48 object-cover rounded-lg border border-[#183B56]/50" alt="New main preview">
                            <div class="text-[11px] text-[#9CA3AF] flex items-center justify-between" id="new_main_image_meta"></div>
                        </div>

                        {{-- Drag & Drop Upload Zone (visible when no image or clicked) --}}
                        <div id="main_image_upload_zone" class="{{ $product->main_image ? 'hidden' : '' }} border-2 border-dashed border-[#183B56]/60 hover:border-[#D6A84B] rounded-xl p-6 text-center cursor-pointer transition-colors bg-[#0B1521]/40" onclick="document.getElementById('main_image_input').click()">
                            <i class="fa-solid fa-cloud-arrow-up text-3xl text-[#D6A84B] mb-2 block"></i>
                            <span class="text-sm text-white font-medium block mb-1">Click to upload Main Image</span>
                            <span class="text-xs text-[#9CA3AF] block">JPG, PNG, WebP (max 6MB)</span>
                        </div>

                        @error('main_image')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="admin-card rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-white">Additional Images</h3>
                        <span class="text-xs text-[#9CA3AF]">Max 10 images</span>
                    </div>

                    <div class="space-y-4">
                        {{-- Existing Gallery Images --}}
                        @if($product->exists && $product->images->count() > 0)
                            <div>
                                <span class="text-xs font-semibold text-[#9CA3AF] uppercase tracking-wider block mb-2">Saved Gallery Images ({{ $product->images->count() }})</span>
                                <div class="grid grid-cols-3 gap-2.5" id="existing_gallery_grid">
                                    @foreach($product->images as $image)
                                        <div class="relative group rounded-lg overflow-hidden border border-[#183B56]/50 bg-[#0B1521] gallery-image-card transition-all duration-200" id="gallery_card_{{ $image->id }}">
                                            <img src="{{ $image->url }}" alt="Product gallery" class="w-full h-20 object-cover">
                                            <button type="button" onclick="removeAdditionalImage({{ $product->id }}, {{ $image->id }}, this)" class="absolute top-1 right-1 w-6 h-6 bg-red-600 hover:bg-red-500 rounded-full flex items-center justify-center text-white shadow-md transition-transform hover:scale-110" title="Delete this image">
                                                <i class="fa-solid fa-trash text-[10px]"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Hidden File Input for Multiple Gallery Uploads --}}
                        <input type="file" name="additional_images[]" id="additional_images_input" accept="image/jpeg,image/png,image/webp,image/jpg" multiple class="hidden">

                        {{-- Upload trigger button --}}
                        <button type="button" onclick="document.getElementById('additional_images_input').click()" class="w-full border-2 border-dashed border-[#183B56]/60 hover:border-[#D6A84B] rounded-xl p-4 text-center cursor-pointer transition-colors bg-[#0B1521]/40">
                            <i class="fa-solid fa-images text-2xl text-[#D6A84B] mb-1.5 block"></i>
                            <span class="text-sm text-white font-medium block">Add Gallery Images</span>
                            <span class="text-xs text-[#9CA3AF] block mt-0.5">Select multiple images (max 6MB each)</span>
                        </button>

                        {{-- Live Preview for NEWLY Selected Gallery Files --}}
                        <div id="new_gallery_preview_container" class="hidden space-y-2 p-3 rounded-xl border border-[#D6A84B]/40 bg-[#0B1521]">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-[#D6A84B]" id="new_gallery_count_label">New Images Selected</span>
                                <button type="button" onclick="clearNewGallerySelection()" class="text-xs text-red-400 hover:text-red-300">
                                    <i class="fa-solid fa-xmark"></i> Clear All
                                </button>
                            </div>
                            <div class="grid grid-cols-3 gap-2" id="new_gallery_previews"></div>
                            <p class="text-[11px] text-[#9CA3AF]">These images will be uploaded when you click "Update Product".</p>
                        </div>

                        @error('additional_images')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('additional_images.*')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Product Settings -->
                <div class="admin-card rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Product Settings</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-[#F4F6F8]">Featured Product</label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="custom-checkbox">
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-[#F4F6F8]">Active Status <span class="text-[11px] text-[#9CA3AF] font-normal">(site pe dikhane ke liye ON karein)</span></label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="custom-checkbox">
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}" min="0" class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Specifications -->
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Technical Specifications</h3>
            <p class="text-sm text-[#9CA3AF] mb-4">Add product specifications (power, frequency, voltage, etc.)</p>
            <div id="specifications-container" class="space-y-3">
                @if(old('spec_labels'))
                    @foreach(old('spec_labels') as $index => $label)
                        <div class="spec-item flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="spec_labels[]" value="{{ $label }}" placeholder="Specification (e.g., Power)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <div class="flex-1">
                                <input type="text" name="spec_values[]" value="{{ old('spec_values')[$index] ?? '' }}" placeholder="Value (e.g., 15 kW)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <button type="button" onclick="removeSpecification(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    @foreach($product->specifications as $spec)
                        <div class="spec-item flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="spec_labels[]" value="{{ $spec->label }}" placeholder="Specification (e.g., Power)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <div class="flex-1">
                                <input type="text" name="spec_values[]" value="{{ $spec->value }}" placeholder="Value (e.g., 15 kW)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <button type="button" onclick="removeSpecification(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" onclick="addSpecification()" class="mt-4 text-sm text-[#D6A84B] hover:text-[#E8BC56] font-medium inline-flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Add Specification
            </button>
            <div class="text-xs text-red-400 mt-2 hidden" id="spec-error">Each specification needs both a label and a value.</div>
        </div>

        <!-- Product Features -->
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Product Features</h3>
            <p class="text-sm text-[#9CA3AF] mb-4">List key features of this product</p>
            <div id="features-container" class="space-y-3">
                @if(old('features'))
                    @foreach(old('features') as $feature)
                        <div class="feature-item flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="features[]" value="{{ $feature }}" placeholder="Feature (e.g., Fast heating with minimal distortion)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <button type="button" onclick="removeFeature(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    @foreach($product->features as $feature)
                        <div class="feature-item flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="features[]" value="{{ $feature->title }}" placeholder="Feature (e.g., Fast heating with minimal distortion)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <button type="button" onclick="removeFeature(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" onclick="addFeature()" class="mt-4 text-sm text-[#D6A84B] hover:text-[#E8BC56] font-medium inline-flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Add Feature
            </button>
        </div>

        <!-- Applications -->
        <div class="admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Applications</h3>
            <p class="text-sm text-[#9CA3AF] mb-4">Industries and applications where this product is used</p>
            <div id="applications-container" class="space-y-3">
                @if(old('applications'))
                    @foreach(old('applications') as $application)
                        <div class="application-item flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="applications[]" value="{{ $application }}" placeholder="Application (e.g., Brazing and soldering)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <button type="button" onclick="removeApplication(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    @foreach($product->applications as $application)
                        <div class="application-item flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="applications[]" value="{{ $application->title }}" placeholder="Application (e.g., Brazing and soldering)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                            </div>
                            <button type="button" onclick="removeApplication(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" onclick="addApplication()" class="mt-4 text-sm text-[#D6A84B] hover:text-[#E8BC56] font-medium inline-flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Add Application
            </button>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 pt-6 border-t border-[#183B56]/30">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2">
                <i class="fa-solid fa-save"></i>
                {{ $product->exists ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </form>
</div>

<script>
    // Generate slug from product name
    function generateSlug() {
        const nameInput = document.querySelector('input[name="name"]');
        if (nameInput && nameInput.value) {
            const slug = nameInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.querySelector('input[name="slug"]').value = slug;
        }
    }

    // Add specification row
    function addSpecification() {
        const container = document.getElementById('specifications-container');
        const index = container.children.length;

        const html = `
            <div class="spec-item flex gap-3 items-start">
                <div class="flex-1">
                    <input type="text" name="spec_labels[]" placeholder="Specification (e.g., Power)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                </div>
                <div class="flex-1">
                    <input type="text" name="spec_values[]" placeholder="Value (e.g., 15 kW)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                </div>
                <button type="button" onclick="removeSpecification(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
    }

    // Remove specification row
    function removeSpecification(button) {
        button.closest('.spec-item').remove();
        validateSpecifications();
    }

    // Add feature row
    function addFeature() {
        const container = document.getElementById('features-container');

        const html = `
            <div class="feature-item flex gap-3 items-start">
                <div class="flex-1">
                    <input type="text" name="features[]" placeholder="Feature (e.g., Fast heating with minimal distortion)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                </div>
                <button type="button" onclick="removeFeature(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
    }

    // Remove feature row
    function removeFeature(button) {
        button.closest('.feature-item').remove();
    }

    // Add application row
    function addApplication() {
        const container = document.getElementById('applications-container');

        const html = `
            <div class="application-item flex gap-3 items-start">
                <div class="flex-1">
                    <input type="text" name="applications[]" placeholder="Application (e.g., Brazing and soldering)" class="form-input rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                </div>
                <button type="button" onclick="removeApplication(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
    }

    // Remove application row
    function removeApplication(button) {
        button.closest('.application-item').remove();
    }

    // Validate specifications
    function validateSpecifications() {
        const labels = document.querySelectorAll('input[name="spec_labels[]"]');
        const values = document.querySelectorAll('input[name="spec_values[]"]');

        if (labels.length !== values.length) {
            document.getElementById('spec-error').classList.remove('hidden');
            return false;
        }

        let hasEmpty = false;
        labels.forEach((label, index) => {
            if (!label.value.trim() || !values[index].value.trim()) {
                hasEmpty = true;
                label.classList.add('border-red-500');
                values[index].classList.add('border-red-500');
            } else {
                label.classList.remove('border-red-500');
                values[index].classList.remove('border-red-500');
            }
        });

        if (hasEmpty) {
            document.getElementById('spec-error').classList.remove('hidden');
            return false;
        } else {
            document.getElementById('spec-error').classList.add('hidden');
            return true;
        }
    }

    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('admin-form');

        // Real-time validation for specifications
        document.querySelectorAll('input[name="spec_labels[]"], input[name="spec_values[]"]').forEach(input => {
            input.addEventListener('input', validateSpecifications);
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            if (!validateSpecifications()) {
                e.preventDefault();
                return;
            }
        });

        // Main Image live preview handler
        const mainInput = document.getElementById('main_image_input');
        const newPreviewBox = document.getElementById('new_main_image_preview_box');
        const newPreviewImg = document.getElementById('new_main_image_preview');
        const newPreviewMeta = document.getElementById('new_main_image_meta');
        const currentContainer = document.getElementById('current_main_image_container');
        const uploadZone = document.getElementById('main_image_upload_zone');

        mainInput?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 6 * 1024 * 1024) {
                    alert('Main image size exceeds 6MB. Please choose a smaller image.');
                    e.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(evt) {
                    newPreviewImg.src = evt.target.result;
                    const sizeKb = (file.size / 1024).toFixed(1);
                    newPreviewMeta.innerHTML = `<span><i class="fa-solid fa-file-image mr-1"></i> ${file.name}</span><span>${sizeKb} KB</span>`;
                    newPreviewBox.classList.remove('hidden');
                    if (currentContainer) currentContainer.classList.add('hidden');
                    if (uploadZone) uploadZone.classList.add('hidden');
                    document.getElementById('remove_main_image_input').value = '0';
                    document.getElementById('main_image_removed_box')?.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Additional Images multi-file live preview handler
        const additionalInput = document.getElementById('additional_images_input');
        const newGalleryContainer = document.getElementById('new_gallery_preview_container');
        const newGalleryGrid = document.getElementById('new_gallery_previews');
        const newGalleryCountLabel = document.getElementById('new_gallery_count_label');

        additionalInput?.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            if (files.length > 10) {
                alert('Maximum 10 additional images allowed.');
                e.target.value = '';
                newGalleryContainer.classList.add('hidden');
                newGalleryGrid.innerHTML = '';
                return;
            }

            if (files.length === 0) {
                newGalleryContainer.classList.add('hidden');
                newGalleryGrid.innerHTML = '';
                return;
            }

            newGalleryGrid.innerHTML = '';
            newGalleryCountLabel.textContent = `${files.length} New Image${files.length > 1 ? 's' : ''} Ready to Upload`;
            newGalleryContainer.classList.remove('hidden');

            files.forEach((file, idx) => {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    const div = document.createElement('div');
                    div.className = 'relative rounded-lg overflow-hidden border border-[#D6A84B]/60 bg-[#0B1521]';
                    div.innerHTML = `
                        <img src="${evt.target.result}" class="w-full h-20 object-cover">
                        <span class="absolute bottom-1 left-1 bg-black/70 text-[9px] text-[#D6A84B] px-1.5 py-0.5 rounded truncate max-w-[90%]">
                            ${file.name}
                        </span>
                    `;
                    newGalleryGrid.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    });

    // Helper functions for Main Image
    function cancelNewMainImage() {
        const mainInput = document.getElementById('main_image_input');
        if (mainInput) mainInput.value = '';
        document.getElementById('new_main_image_preview_box')?.classList.add('hidden');
        const currentContainer = document.getElementById('current_main_image_container');
        const uploadZone = document.getElementById('main_image_upload_zone');

        if (currentContainer && document.getElementById('remove_main_image_input').value === '0') {
            currentContainer.classList.remove('hidden');
        } else if (uploadZone) {
            uploadZone.classList.remove('hidden');
        }
    }

    function markMainImageRemoval() {
        document.getElementById('remove_main_image_input').value = '1';
        document.getElementById('current_main_image_container')?.classList.add('hidden');
        document.getElementById('main_image_removed_box')?.classList.remove('hidden');
        document.getElementById('main_image_upload_zone')?.classList.remove('hidden');
    }

    function cancelMainImageRemoval() {
        document.getElementById('remove_main_image_input').value = '0';
        document.getElementById('main_image_removed_box')?.classList.add('hidden');
        document.getElementById('current_main_image_container')?.classList.remove('hidden');
        document.getElementById('main_image_upload_zone')?.classList.add('hidden');
    }

    // Clear newly selected gallery images
    function clearNewGallerySelection() {
        const additionalInput = document.getElementById('additional_images_input');
        if (additionalInput) additionalInput.value = '';
        document.getElementById('new_gallery_preview_container')?.classList.add('hidden');
        const grid = document.getElementById('new_gallery_previews');
        if (grid) grid.innerHTML = '';
    }

    // Function to remove additional image via AJAX
    function removeAdditionalImage(productId, imageId, buttonElement) {
        if (!confirm('Are you sure you want to remove this image from the gallery?')) {
            return;
        }

        const card = buttonElement ? buttonElement.closest('.gallery-image-card') : document.getElementById(`gallery_card_${imageId}`);
        if (card) {
            card.style.opacity = '0.4';
            card.style.pointerEvents = 'none';
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const targetUrl = productId 
            ? `/admin/products/${productId}/images/${imageId}` 
            : `/admin/products/images/${imageId}`;

        fetch(targetUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(async response => {
            if (!response.ok) {
                const text = await response.text();
                throw new Error('Server responded with ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (card) {
                    card.style.transform = 'scale(0.8)';
                    card.style.opacity = '0';
                    setTimeout(() => card.remove(), 250);
                }
                showAdminToast(data.message || 'Gallery image removed.');
            } else {
                alert(data.message || 'Failed to remove image');
                if (card) {
                    card.style.opacity = '1';
                    card.style.pointerEvents = 'auto';
                }
            }
        })
        .catch(error => {
            console.error('Error removing image:', error);
            alert('An error occurred while removing the image. Please try again.');
            if (card) {
                card.style.opacity = '1';
                card.style.pointerEvents = 'auto';
            }
        });
    }

    // Toast Notification helper
    function showAdminToast(msg) {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-5 right-5 z-50 bg-[#183B56] border border-[#D6A84B] text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-2.5 transition-all duration-300';
        toast.innerHTML = '<i class="fa-solid fa-circle-check text-[#D6A84B]"></i> <span class="text-sm font-medium">' + msg + '</span>';
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(10px)';
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }
</script>
@endsection
