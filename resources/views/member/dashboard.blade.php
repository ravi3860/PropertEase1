<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-white p-6 shadow-xl border-l-4 border-yellow-100">
            <h2 class="text-xl font-medium text-black mb-8">
                Welcome back, {{ $member->user->name ?? $member->user->username ?? 'Member' }}!
            </h2>
            <button onclick="showSection('profile')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                My Profile
            </button>
            <button onclick="showSection('properties')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                My Properties
            </button>
            <button onclick="showSection('agent')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                Agent Request Status
            </button>
            <button onclick="showSection('subscription')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                Purchase Status
            </button>
        </aside>

        <!-- Main Content -->
        <main class="w-4/5 p-6">
            <!-- Profile Section -->
            <section id="profile" class="section bg-white p-8 rounded-lg shadow-xl border border-yellow-100 mb-6 transition-all duration-300 ease-in-out transform hover:scale-105">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full mr-4 flex items-center justify-center text-white font-semibold text-xl uppercase shadow-md">
                        {{ strtoupper(substr($member->user->name ?? 'M', 0, 1)) }}
                    </div>
                    <h2 class="text-2xl font-medium text-black">{{ $member->user->name ?? 'Member' }}</h2>
                </div>

                <form method="POST" action="{{ route('member.update') }}" class="grid grid-cols-2 gap-4 mb-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-black mb-1 font-medium">Name</label>
                        <input name="name" value="{{ $member->user->name }}" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black mb-1 font-medium">Email</label>
                        <input name="email" type="email" value="{{ $member->user->email }}" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black mb-1 font-medium">Phone</label>
                        <input name="phone" type="text" value="{{ $member->phone }}" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black mb-1 font-medium">Password</label>
                        <input type="password" value="********" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm bg-gray-100" disabled>
                        <small class="text-xs text-black">Use change-password to update.</small>
                    </div>

                    <div class="col-span-2 flex space-x-4 pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-100 to-yellow-100 text-black py-3 px-6 rounded-lg shadow-md hover:from-yellow-100 hover:to-yellow-100 transition-all duration-300">
                            Update
                        </button>
                    </div>
                </form>
            </section>

            <!-- Properties Section -->
            <section id="properties" class="section hidden bg-white p-10 rounded-2xl shadow-2xl border border-yellow-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <h3 class="text-3xl font-bold text-black">My Properties</h3>
                    <a href="{{ route('member.properties.create') }}" 
                    class="mt-4 md:mt-0 inline-flex items-center gap-2 bg-yellow-400 text-black font-semibold py-3 px-6 rounded-xl shadow-md hover:bg-yellow-500 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-plus"></i> Add New Property
                    </a>
                </div>

                <!-- List My Properties -->
                <div>
                    <h4 class="text-xl font-semibold text-black mb-6">My Listed Properties</h4>
                    @if($member->properties->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($member->properties as $property)
                                <div class="bg-white rounded-2xl border border-yellow-100 shadow-md hover:shadow-xl transition-transform transform hover:-translate-y-1 duration-300 overflow-hidden">
                                    
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
                                    <div class="p-5 flex flex-col gap-3">
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

                                    <!-- Actions -->
                                    <div class="px-5 pb-5 flex justify-between items-center border-t border-yellow-100 pt-3">
                                        <a href="{{ route('member.properties.show', $property->slug) }}" 
                                        class="text-blue-600 hover:underline text-sm font-medium flex items-center gap-1">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        <a href="{{ route('member.properties.edit', $property->id) }}" 
                                        class="text-green-600 hover:underline text-sm font-medium flex items-center gap-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form method="POST" action="{{ route('member.properties.destroy', $property->id) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete this property?')" 
                                                    class="text-red-600 hover:underline text-sm font-medium flex items-center gap-1">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-20 bg-yellow-50 rounded-2xl border border-dashed border-yellow-300">
                            <i class="fas fa-home text-yellow-400 text-6xl mb-4"></i>
                            <p class="text-gray-700 text-lg font-medium mb-4">You don’t have any properties listed yet.</p>
                            <a href="{{ route('member.properties.create') }}" 
                            class="inline-block bg-yellow-400 text-black font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300">
                                + Add Your First Property
                            </a>
                        </div>
                    @endif
                </div>
            </section>


            <!-- Agent Requests Section -->
            <section id="agent" class="section hidden bg-white p-8 rounded-lg shadow-xl border border-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-xl font-semibold text-black mb-4">Request an Agent</h3>

                @if($agents->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($agents as $agent)
                            <div class="p-6 bg-yellow-50 rounded-xl shadow-md border border-yellow-200 flex flex-col justify-between">
                                <div class="mb-4">
                                    <h4 class="text-lg font-bold text-black">{{ $agent->user->name }}</h4>
                                    <p class="text-gray-600">{{ $agent->agency_name ?? 'Independent Agent' }}</p>
                                    <p class="text-gray-500 text-sm">{{ $agent->phone }}</p>

                                    <!-- Show status if request exists -->
                                    @php
                                        $request = $requests->firstWhere('agent_id', $agent->id);
                                    @endphp

                                    @if($request)
                                        <p class="mt-2 text-sm font-semibold
                                            @if($request->status == 'pending') text-yellow-600
                                            @elseif($request->status == 'accepted') text-green-600
                                            @else text-red-600 @endif">
                                            Status: {{ ucfirst($request->status) }}
                                        </p>
                                    @endif
                                </div>

                                @if(!$request)
                                    <a href="{{ route('member.request-agent', $agent->id) }}"
                                        class="mt-auto inline-block text-center px-4 py-2 bg-yellow-400 text-black font-semibold rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300">
                                        Request Contact / Visit
                                    </a>
                                @else
                                    <button class="mt-auto px-4 py-2 bg-gray-300 text-black font-semibold rounded-lg cursor-not-allowed">
                                        Request Sent
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-yellow-50 rounded-xl border border-dashed border-yellow-300">
                        <i class="fas fa-user-tie text-yellow-400 text-5xl mb-4"></i>
                        <p class="text-gray-700 text-lg">No agents available at the moment.</p>
                    </div>
                @endif
            </section>



            <!-- Purchase Section -->
            <section id="subscription" class="section hidden bg-white p-8 rounded-lg shadow-xl border border-yellow-100">
                <h3 class="text-2xl font-semibold text-black mb-6">Purchase Status</h3>

                @if($purchases->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($purchases as $purchase)
                            <div class="border border-yellow-200 rounded-xl p-4 shadow hover:shadow-lg transition-all">
                                <h4 class="font-bold text-lg">{{ $purchase->property->title }}</h4>
                                <p>Price: Rs. {{ number_format($purchase->price_at_purchase) }}</p>
                                <p>Deposit: Rs. {{ number_format($purchase->deposit_amount) }} ({{ $purchase->deposit_percent }}%)</p>
                                <p>Status: <span class="font-semibold text-blue-600">{{ ucfirst(str_replace('_', ' ', $purchase->status)) }}</span></p>
                                <p>Buyer: {{ $purchase->buyer->user->name ?? $purchase->buyer->user->username }}</p>
                                <p>Seller: {{ $purchase->seller->user->name ?? $purchase->seller->user->username }}</p>
                                
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @if(auth()->user()->member->id === $purchase->buyer_id)
                                        @if($purchase->status === 'pending_payment')
                                            <form action="{{ route('member.purchases.confirm', $purchase) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Confirm Deposit</button>
                                            </form>
                                            <form action="{{ route('member.purchases.cancel', $purchase) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Cancel</button>
                                            </form>
                                        @elseif($purchase->status === 'deposit_paid')
                                            <form action="{{ route('member.purchases.markSettled', $purchase) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Mark as Settled</button>
                                            </form>
                                        @endif
                                    @endif

                                    @if(auth()->user()->member->id === $purchase->seller_id)
                                        <span class="px-4 py-2 bg-gray-200 rounded-lg">Seller view only</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $purchases->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-yellow-50 rounded-2xl border border-dashed border-yellow-300">
                        <i class="fas fa-shopping-cart text-yellow-400 text-6xl mb-4"></i>
                        <p class="text-gray-700 text-lg font-medium mb-4">No purchases yet.</p>
                    </div>
                @endif
            </section>

        </main>
    </div>

    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }
        // default section
        showSection('profile');
    </script>
</x-app-layout>
