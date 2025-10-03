<x-guest-layout>
    @section('title', 'Browse Properties')

    <!-- Hero Section -->
    <section class="py-24 bg-gradient-to-b from-yellow-100 to-white-200 relative overflow-hidden">
        <div class="relative max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 px-6">

            <!-- Text -->
            <div class="flex-1 text-left animate-fadeIn">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Explore Your Perfect Property
                </h1>
                <h2 class="text-xl md:text-2xl font-semibold text-gray-700 mb-4">
                    Discover listings that match your lifestyle and needs
                </h2>
                <p class="text-gray-600 mb-8 text-base md:text-lg max-w-lg">
                    From cozy apartments to spacious villas, explore a wide range of property types tailored just for you.
                    Find your next home with ease.
                </p>
            </div>

            <!-- Images -->
            <div class="flex-1 relative flex gap-6">
                <img src="{{ asset('img/buil1.png') }}" alt="City Sketch" class="rounded-2xl shadow-lg w-1/2 object-cover">
                <img src="{{ asset('img/villa-removebg-preview.png') }}" alt="House Sketch" class="rounded-2xl shadow-lg w-1/2 object-cover">
            </div>
        </div>
    </section>

    <!-- Properties Section -->
    <section class="bg-white py-14 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
                Properties For You
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($properties as $property)
                    <div class="bg-white rounded-2xl border border-yellow-100 shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-300 overflow-hidden">
                        <!-- Property Image -->
                        <div class="relative w-full h-48 bg-yellow-50">
                            @if($property->images->count())
                                <img src="{{ asset('storage/' . $property->images->first()->file_path) }}"
                                     alt="{{ $property->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-gray-400">
                                    <i class="fas fa-home text-5xl"></i>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 bg-yellow-200 text-black font-semibold text-sm px-3 py-1 rounded-full shadow">
                                Rs. {{ number_format($property->price) }}
                            </span>
                        </div>

                        <!-- Property Content -->
                        <div class="p-5 flex flex-col gap-2">
                            <h5 class="text-lg font-bold text-black truncate">{{ $property->title }}</h5>
                            <p class="text-gray-600 text-sm truncate">
                                {{ $property->city ?? '' }} {{ $property->state ?? '' }}
                            </p>
                            <div class="flex items-center gap-4 text-gray-700 text-sm">
                                <span class="flex items-center gap-1"><i class="fas fa-bed"></i> {{ $property->bedrooms ?? 0 }}</span>
                                <span class="flex items-center gap-1"><i class="fas fa-bath"></i> {{ $property->bathrooms ?? 0 }}</span>
                                <span class="flex items-center gap-1"><i class="fas fa-ruler-combined"></i> {{ $property->area ?? 'N/A' }} sqft</span>
                            </div>
                        </div>

                        <!-- View Button -->
                        <div class="px-5 pb-5 flex justify-center border-t border-yellow-100 pt-3">
                            @auth
                                <a href="{{ route('member.properties.show', $property->slug) }}"
                                   class="bg-yellow-400 text-black font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                   class="bg-yellow-400 text-black font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-yellow-50 rounded-2xl border border-dashed border-yellow-300">
                        <i class="fas fa-home text-yellow-400 text-6xl mb-4"></i>
                        <p class="text-gray-700 text-lg font-medium mb-4">No properties found.</p>
                        @auth
                            <a href="{{ route('member.properties.create') }}"
                               class="inline-block bg-yellow-400 text-black font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300">
                                + Add Your First Property
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="inline-block bg-yellow-400 text-black font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300">
                                Register to Add Property
                            </a>
                        @endauth
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</x-guest-layout>
