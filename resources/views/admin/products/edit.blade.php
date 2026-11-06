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
                    <h3 class="text-lg font-bold text-white mb-4">Main Product Image</h3>
                    <div class="space-y-4">
                        @if($product->main_image)
                            <div class="relative">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-lg mb-3">
                                <button type="button" onclick="document.getElementById('main_image_input').click()" class="text-sm text-[#D6A84B] hover:text-[#E8BC56]">
                                    Change Image
                                </button>
                            </div>
                        @endif
                        <input type="file" name="main_image" id="main_image_input" accept="image/*" class="hidden" {{ $product->exists ? '' : 'required' }}>
                        <button type="button" onclick="document.getElementById('main_image_input').click()" class="w-full border-2 border-dashed border-[#183B56]/40 rounded-lg p-6 hover:border-[#D6A84B]/60 transition-colors">
                            <i class="fa-solid fa-plus text-2xl text-[#9CA3AF] mb-2 block"></i>
                            <span class="text-sm text-[#9CA3AF] block mb-1">Add Main Image</span>
                            <span class="text-xs text-[#9CA3AF]">JPG, PNG, WebP (max 6MB)</span>
                        </button>
                        @error('main_image')
                            <p class="text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="admin-card rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Additional Images</h3>
                    <div class="space-y-3">
                        @if($product->exists)
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($product->images as $image)
                                    <div class="relative group">
                                        <img src="{{ $image->url }}" alt="Additional product image" class="w-full rounded-lg">
                                        <button type="button" onclick="removeAdditionalImage({{ $image->id }})" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                            <i class="fa-solid fa-xmark text-xs"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="additional_images[]" id="additional_images_input" accept="image/*" multiple class="hidden">
                        <button type="button" onclick="document.getElementById('additional_images_input').click()" class="w-full border-2 border-dashed border-[#183B56]/40 rounded-lg p-4 hover:border-[#D6A84B]/60 transition-colors">
                            <i class="fa-solid fa-images text-xl text-[#9CA3AF] mb-2 block"></i>
                            <span class="text-sm text-[#9CA3AF] block">Add Additional Images</span>
                        </button>
                        <p class="text-xs text-[#9CA3AF]">Maximum 10 images, each max 6MB</p>
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

        // Image preview handlers
        document.getElementById('main_image_input')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can add image preview logic here
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('additional_images_input')?.addEventListener('change', function(e) {
            if (e.target.files.length > 10) {
                alert('Maximum 10 additional images allowed.');
                e.target.value = '';
            }
        });
    });

    // Function to remove additional image via AJAX
    function removeAdditionalImage(imageId) {
        if (confirm('Are you sure you want to remove this image?')) {
            fetch(`/admin/products/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to remove image');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while removing the image');
            });
        }
    }
</script>
@endsection
