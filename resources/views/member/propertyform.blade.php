<x-app-layout>
    <!-- Form Container -->
    <div class="w-full max-w-5xl mx-auto p-12 mt-10 mb-16 bg-white rounded-2xl shadow-xl border border-gray-200">
        <h2 class="text-3xl font-extrabold mb-8 text-gray-900 flex items-center gap-3">
            <i class="fas fa-home text-black-500"></i>
            Post Your Property
        </h2>

        <form id="propertyForm" method="POST" action="{{ route('member.properties.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Property Title -->
            <div class="transition hover:scale-[1.01]">
                <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-heading text-black-500"></i> Title
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
            </div>

            <!-- Property Type & Post Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-building text-black-500"></i> Property Type
                    </label>
                    <select name="property_type" required
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                        <option value="">Select Type</option>
                        <option value="House">House</option>
                        <option value="Apartment">Apartment</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Villa">Villa</option>
                        <option value="Bungalow">Bungalow</option>
                        <option value="Land">Land</option>
                    </select>
                </div>

                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-tags text-black-500"></i> Post Type
                    </label>
                    <select name="post_type" required
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                        <option value="">Select Post Type</option>
                        <option value="Sale">Sale</option>
                        <option value="Rent">Rent</option>
                    </select>
                </div>
            </div>

            <!-- Price -->
            <div class="transition hover:scale-[1.01]">
                <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-dollar-sign text-black-500"></i> Price
                </label>
                <input type="number" name="price" value="{{ old('price') }}" required
                    class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
            </div>

            <!-- Location Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt text-black-500"></i> Address
                    </label>
                    <input type="text" name="address" value="{{ old('address') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>

                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-city text-black-500"></i> City
                    </label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map text-black-500"></i> State
                    </label>
                    <input type="text" name="state" value="{{ old('state') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>

                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-mail-bulk text-black-500"></i> Postal Code
                    </label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>
            </div>

            <div class="transition hover:scale-[1.01]">
                <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-flag text-black-500"></i> Country
                </label>
                <input type="text" name="country" value="{{ old('country') }}"
                    class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
            </div>

            <!-- Bedrooms, Bathrooms, Area -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-bed text-black-500"></i> Bedrooms
                    </label>
                    <input type="number" name="bedrooms" min="0" value="{{ old('bedrooms') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>
                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-bath text-black-500"></i> Bathrooms
                    </label>
                    <input type="number" name="bathrooms" min="0" value="{{ old('bathrooms') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>
                <div class="transition hover:scale-[1.01]">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-ruler-combined text-black-500"></i> Area (sq ft)
                    </label>
                    <input type="number" name="area" min="0" value="{{ old('area') }}"
                        class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
                </div>
            </div>

            <!-- Year Built -->
            <div class="transition hover:scale-[1.01]">
                <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-calendar-alt text-black-500"></i> Year Built
                </label>
                <input type="number" name="year_built" min="1800" max="{{ date('Y') }}" value="{{ old('year_built') }}"
                    class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">
            </div>

            <!-- Description -->
            <div class="transition hover:scale-[1.01]">
                <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-align-left text-black-500"></i> Description
                </label>
                <textarea name="description" rows="4"
                    class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:ring-4 focus:ring-black-300 focus:border-black-400 transition">{{ old('description') }}</textarea>
            </div>

            <!-- Publish -->
            <div class="flex items-center space-x-3">
                <input type="checkbox" name="is_published" value="1"
                    {{ old('is_published') ? 'checked' : '' }}
                    class="w-5 h-5 text-black-500 border-gray-300 rounded focus:ring-2 focus:ring-black-400" required>
                <span class="text-gray-700 font-medium">Publish this property</span>
            </div>

            <!-- Images -->
            <div>
                <label class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-images text-black-500"></i> Upload Images
                </label>
                <input type="file" name="images[]" id="imageInput" multiple accept="image/*"
                    class="w-full p-4 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-4 focus:ring-black-300" required>
                <div id="imagePreviewContainer" class="grid grid-cols-3 gap-4 mt-4"></div>
            </div>

            <!-- Submit -->
            <div class="flex justify-center pt-6">
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-black-400 to-black-500 text-black font-bold rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">
                    <i class="fas fa-paper-plane mr-2"></i> Add Property
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
