<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">

        <!-- Hero Section -->
        <div class="relative w-full h-80 md:h-96 rounded-2xl overflow-hidden shadow-lg mb-8">
            @if($property->images->count())
                <img src="{{ asset('storage/' . $property->images->first()->file_path) }}" 
                     alt="{{ $property->title }}" 
                     class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-105">
            @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-lg font-semibold">
                    No Image Available
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight">{{ $property->title }}</h1>
                <p class="text-yellow-400 text-2xl md:text-3xl font-semibold mt-2">Rs. {{ number_format($property->price) }}</p>
                <div class="flex gap-4 mt-3 items-center flex-wrap">
                    <span class="bg-yellow-400 text-black px-3 py-1 rounded-full font-medium text-sm">{{ $property->property_type }}</span>
                    <span class="flex items-center gap-1 text-sm font-medium"><i class="fas fa-map-marker-alt"></i> {{ $property->address }}, {{ $property->city }}</span>
                </div>
            </div>
        </div>

        <!-- Image Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-10">
            <div class="md:col-span-3">
                <img id="mainImage" src="{{ $property->images->count() ? asset('storage/' . $property->images->first()->file_path) : '' }}" 
                     alt="Property" 
                     class="w-full h-80 md:h-96 object-cover rounded-2xl shadow-lg cursor-pointer transition-transform duration-300 hover:scale-105" 
                     onclick="openLightbox(this.src)">
            </div>
            <div class="md:col-span-2 flex flex-col gap-3">
                @foreach($property->images as $image)
                    <img src="{{ asset('storage/' . $image->file_path) }}" 
                         alt="Thumbnail" 
                         class="w-full h-24 md:h-28 object-cover rounded-xl cursor-pointer shadow hover:shadow-xl transition transform duration-300 hover:scale-105"
                         onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $image->file_path) }}'">
                @endforeach
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div id="lightbox" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">
            <span class="absolute top-6 right-8 text-white text-4xl font-bold cursor-pointer" onclick="closeLightbox()">&times;</span>
            <img id="lightboxImg" src="" class="max-h-full max-w-full rounded-2xl shadow-2xl transform transition duration-300 scale-95 hover:scale-100">
        </div>

        <!-- Property Details & Owner Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

            <!-- Property Info -->
            <div class="bg-gray-50 p-6 rounded-3xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
                <h2 class="text-2xl md:text-3xl font-bold text-black mb-5 border-b-2 border-yellow-400 pb-2 w-fit">Property Details</h2>
                <p class="text-gray-700 mb-6 leading-relaxed text-base md:text-lg">{{ $property->description }}</p>
                
               <div class="grid grid-cols-2 gap-4">
                    @php
                        $details = [
                            ['icon'=>'fas fa-bed','label'=>'Bedrooms','value'=>$property->bedrooms],
                            ['icon'=>'fas fa-bath','label'=>'Bathrooms','value'=>$property->bathrooms],
                            ['icon'=>'fas fa-ruler-combined','label'=>'Area (sq ft)','value'=>$property->area],
                            ['icon'=>'fas fa-calendar-alt','label'=>'Year Built','value'=>$property->year_built],
                            ['icon'=>'fas fa-map-marker-alt','label'=>'Postal Code','value'=>$property->postal_code],
                            ['icon'=>'fas fa-building','label'=>'Type','value'=>$property->property_type],
                        ];
                    @endphp
                    @foreach($details as $item)
                        <div class="bg-white p-4 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col items-start gap-1">
                            <i class="{{ $item['icon'] }} text-black text-xl mb-1"></i>
                            <p class="font-semibold text-black text-sm">{{ $item['label'] }}</p>
                            @if(is_numeric($item['value']))
                                <p class="text-gray-700 text-lg counter" data-target="{{ $item['value'] ?? 0 }}">0</p>
                            @else
                                <p class="text-gray-700 text-lg">{{ $item['value'] ?? '–' }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Owner & Purchase CTA -->
            <div class="flex flex-col gap-6">
                <div class="bg-white p-6 rounded-3xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 text-2xl font-bold">
                            {{ strtoupper(substr($property->member->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-black">{{ $property->member->user->name ?? 'Unknown' }}</h3>
                            <p class="text-gray-600 text-sm">{{ $property->member->user->email ?? 'N/A' }}</p>
                            <p class="text-gray-600 text-sm">{{ $property->member->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4 flex-wrap">
                        <a href="mailto:{{ $property->member->user->email ?? '' }}" class="px-5 py-2 bg-yellow-400 text-black rounded-xl shadow hover:bg-yellow-300 transition font-medium flex items-center gap-2">
                            <i class="fas fa-envelope"></i> Contact Owner
                        </a>
                        <a href="#" class="px-5 py-2 bg-black text-white rounded-xl shadow hover:scale-105 transition font-medium flex items-center gap-2">
                            <i class="fas fa-calendar-alt"></i> Schedule Visit With Agent
                        </a>
                    </div>
                </div>

                <a href="{{ route('member.purchase.form', $property->id) }}">
                <button class="mt-4 px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-300 text-black font-bold rounded-2xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 text-lg flex items-center justify-center gap-2">
                    <i class="fas fa-shopping-cart"></i> Purchase Property
                </button>
            </a>

            </div>
        </div>
    </div>

    <!-- Scripts (unchanged) -->
    <script>
        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightbox').classList.remove('hidden');
            document.getElementById('lightbox').classList.add('flex');
        }
        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.getElementById('lightbox').classList.remove('flex');
        }

        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            const step = target / 100;
            function updateCounter() {
                count += step;
                if(count < target){
                    counter.textContent = Math.ceil(count);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            }
            updateCounter();
        });
    </script>
</x-app-layout>
