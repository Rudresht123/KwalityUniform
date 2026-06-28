@extends('layouts.common')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $pageData['title'] }}</h1>
            <p class="text-gray-600">Discover and approve high-quality products for your school.</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Filters Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
            <form action="{{ route('school.products.index') }}" method="GET" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ti ti-filter text-indigo-600"></i> Filters
                </h3>

                <div class="space-y-6">
                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" onchange="this.form.submit()" class="w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gender Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                        <select name="gender_type" onchange="this.form.submit()" class="w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Genders</option>
                            <option value="boys" {{ request('gender_type') == 'boys' ? 'selected' : '' }}>Boys</option>
                            <option value="girls" {{ request('gender_type') == 'girls' ? 'selected' : '' }}>Girls</option>
                            <option value="unisex" {{ request('gender_type') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                        </select>
                    </div>

                    <!-- Vendor Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Vendor</label>
                        <select name="vendor_id" onchange="this.form.submit()" class="w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Vendors</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->vendor_id }}" {{ request('vendor_id') == $vendor->vendor_id ? 'selected' : '' }}>
                                    {{ $vendor->business_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <a href="{{ route('school.products.index') }}" class="block text-center text-sm text-indigo-600 hover:text-indigo-800 font-medium mt-4">
                        Clear All Filters
                    </a>
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden cursor-pointer" 
                         onclick="openProductDetails('{{ $product->product_id }}')">
                        <!-- Product Image -->
                        <div class="relative h-64 overflow-hidden bg-gray-200">
                            <img src="{{ $product->firstImage() }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-3 right-3 flex flex-col gap-2">
                                <span class="bg-white/90 backdrop-blur-sm text-indigo-600 text-xs font-bold px-2 py-1 rounded-full shadow-sm">
                                    {{ $product->category->category_name ?? 'General' }}
                                </span>
                                @if($product->is_school_approved)
                                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-sm flex items-center gap-1">
                                        <i class="ti ti-check"></i> Approved
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                {{ $product->product_name }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium text-gray-400">
                                    Vendor: {{ $product->vendor->business_name ?? 'N/A' }}
                                </span>
                                <span class="text-indigo-600 text-sm font-bold group-hover:translate-x-1 transition-transform">
                                    View Details &rarr;
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Product Detail Modal -->
<div id="product-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto relative">
        <!-- Close Button -->
        <button onclick="closeProductDetails()" class="absolute top-4 right-4 z-10 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 md:p-10">
            <!-- Left Side: Image Slider -->
            <div class="space-y-4">
                <div class="relative group aspect-square bg-gray-100 rounded-xl overflow-hidden">
                    <img id="modal-main-image" src="" alt="Product" class="w-full h-full object-contain">
                    
                    <!-- Slider Navigation -->
                    <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white transition hidden" id="prev-btn">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white transition hidden" id="next-btn">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19l7-7-7-7"></path></svg>
                    </button>
                </div>
                
                <!-- Thumbnails -->
                <div id="modal-thumbnails" class="flex gap-2 overflow-x-auto pb-2">
                    <!-- Thumbnails injected here -->
                </div>
            </div>

            <!-- Right Side: Product Details -->
            <div class="flex flex-col justify-center">
                <div id="modal-details" class="space-y-6">
                    <div>
                        <span id="modal-category" class="text-indigo-600 text-xs font-bold uppercase tracking-wider"></span>
                        <h2 id="modal-name" class="text-3xl font-bold text-gray-900 mt-1"></h2>
                        <p id="modal-vendor" class="text-gray-500 italic"></p>
                    </div>
                    
                    <div class="border-t border-b py-4 border-gray-100">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Description</h4>
                        <p id="modal-description" class="text-gray-600 leading-relaxed"></p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="block text-xs text-gray-400 uppercase">Gender</span>
                            <span id="modal-gender" class="font-medium text-gray-800"></span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <span class="block text-xs text-gray-400 uppercase">Fabric</span>
                            <span id="modal-fabric" class="font-medium text-gray-800"></span>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button id="approve-btn" onclick="approveProduct()" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                            <i class="ti ti-check"></i> <span id="approve-btn-text">Approve for my School</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentImages = [];
    let currentImageIndex = 0;
    let currentProductId = null;

    async function openProductDetails(productId) {
        currentProductId = productId;
        const modal = document.getElementById('product-modal');
        const mainImg = document.getElementById('modal-main-image');
        const thumbContainer = document.getElementById('modal-thumbnails');
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        try {
            const response = await fetch(`/school-products/${productId}`);
            const data = await response.json();
            
            if (data.success) {
                const p = data.product;
                currentImages = data.images;
                currentImageIndex = 0;

                // Update Text
                document.getElementById('modal-name').innerText = p.product_name;
                document.getElementById('modal-category').innerText = p.category?.category_name || 'General';
                document.getElementById('modal-vendor').innerText = 'By ' + (p.vendor?.business_name || 'Unknown Vendor');
                document.getElementById('modal-description').innerText = p.description || 'No description available.';
                document.getElementById('modal-gender').innerText = p.gender_type;
                document.getElementById('modal-fabric').innerText = p.fabric_composition || 'Not specified';

                // Update Approval Button
                const approveBtn = document.getElementById('approve-btn');
                const approveBtnText = document.getElementById('approve-btn-text');
                
                if (data.is_school_approved) {
                    approveBtn.className = "w-full bg-green-500 text-white font-bold py-3 rounded-xl cursor-default transition shadow-lg shadow-green-200 flex items-center justify-center gap-2";
                    approveBtnText.innerText = "Approved for School";
                    approveBtn.onclick = null;
                } else {
                    approveBtn.className = "w-full bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2";
                    approveBtnText.innerText = "Approve for my School";
                    approveBtn.onclick = approveProduct;
                }

                // Update Image
                updateSlider();
                
                // Render Thumbnails
                thumbContainer.innerHTML = '';
                currentImages.forEach((img, idx) => {
                    const thumb = document.createElement('img');
                    thumb.src = img;
                    thumb.className = `w-16 h-16 object-cover rounded-lg cursor-pointer border-2 transition ${idx === 0 ? 'border-indigo-600' : 'border-transparent hover:border-gray-300'}`;
                    thumb.onclick = () => setIndex(idx);
                    thumbContainer.appendChild(thumb);
                });

                // Toggle Nav Buttons
                document.getElementById('prev-btn').classList.toggle('hidden', currentImages.length <= 1);
                document.getElementById('next-btn').classList.toggle('hidden', currentImages.length <= 1);
            }
        } catch (error) {
            console.error('Error fetching product details:', error);
        }
    }

    async function approveProduct() {
        if (!currentProductId) return;
        
        const btn = document.getElementById('approve-btn');
        const btnText = document.getElementById('approve-btn-text');
        
        btn.disabled = true;
        btn.classList.add('opacity-50');
        btnText.innerText = "Processing...";

        try {
            const response = await fetch(`/school-products/${currentProductId}/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            
            if (data.success) {
                btn.className = "w-full bg-green-500 text-white font-bold py-3 rounded-xl cursor-default transition shadow-lg shadow-green-200 flex items-center justify-center gap-2";
                btnText.innerText = "Approved for School";
                btn.onclick = null;
            } else {
                alert(data.message || 'Error approving product');
            }
        } catch (error) {
            alert('Something went wrong. Please try again.');
        } finally {
            btn.disabled = false;
            btn.classList.remove('opacity-50');
        }
    }

    function setIndex(index) {
        currentImageIndex = index;
        updateSlider();
        
        // Update thumbnail borders
        const thumbs = document.getElementById('modal-thumbnails').children;
        for (let i = 0; i < thumbs.length; i++) {
            thumbs[i].className = `w-16 h-16 object-cover rounded-lg cursor-pointer border-2 transition ${i === currentImageIndex ? 'border-indigo-600' : 'border-transparent ' + (i === currentImageIndex ? '' : 'hover:border-gray-300')}`;
        }
    }

    function updateSlider() {
        document.getElementById('modal-main-image').src = currentImages[currentImageIndex] || '';
    }

    function prevImage() {
        if (currentImageIndex > 0) setIndex(currentImageIndex - 1);
    }

    function nextImage() {
        if (currentImageIndex < currentImages.length - 1) setIndex(currentImageIndex + 1);
    }

    function closeProductDetails() {
        document.getElementById('product-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection
