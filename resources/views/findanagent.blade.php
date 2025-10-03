<x-guest-layout>
    @section('title', 'Find an Agent')

    <!-- Hero Section -->
    <section class="py-24 bg-gradient-to-b from-yellow-100 to-white-200 relative overflow-hidden">
        <div class="relative max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 px-6">

            <!-- Text -->
            <div class="flex-1 text-left animate-fadeIn">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Find the Right Agent for You
                </h1>
                <h2 class="text-xl md:text-2xl font-semibold text-gray-700 mb-4">
                    Connect with trusted professionals to guide your property journey
                </h2>
                <p class="text-gray-600 mb-8 text-base md:text-lg max-w-lg">
                    Browse experienced real estate agents ready to assist with buying, selling, or renting.
                    Choose the one that fits your goals and location best.
                </p>
            </div>

            <!-- Illustration -->
            <div class="flex-1 relative flex justify-center">
                <img src="{{ asset('img/hand_shake-removebg-preview.png') }}"
                     alt="Agents Shaking Hands"
                     class="rounded-2xl shadow-lg object-cover w-80 h-80">
            </div>
        </div>
    </section>

    <!-- Agents Section -->
    <section class="bg-white py-14 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold mb-10 text-center text-gray-900">
                Meet Our Agents
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($agents as $agent)
                    <div class="bg-white rounded-2xl border border-yellow-100 shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-300 overflow-hidden">
                        <!-- Avatar -->
                        <div class="flex justify-center mt-6">
                            <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-xl uppercase shadow">
                                {{ strtoupper(substr($agent->user->name ?? $agent->user->username, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-5 text-center space-y-2">
                            <h5 class="text-lg font-bold text-black">{{ $agent->user->name ?? $agent->user->username }}</h5>
                            <p class="text-gray-600 text-sm"><i class="fas fa-envelope"></i> {{ $agent->user->email }}</p>
                            <p class="text-gray-600 text-sm"><i class="fas fa-phone"></i> {{ $agent->phone }}</p>
                            <p class="text-gray-600 text-sm"><i class="fas fa-id-card"></i> {{ $agent->license_number }}</p>
                            <p class="text-gray-600 text-sm"><i class="fas fa-building"></i> {{ $agent->agency_name }}</p>
                        </div>

                        <!-- Action -->
                        <div class="px-5 pb-5 flex justify-center border-t border-yellow-100 pt-3">
                            @auth
                                @if(auth()->user()->role === 'member')
                                    <a href="{{ route('member.request-agent', $agent->id) }}"
                                       class="bg-yellow-400 text-black font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300 flex items-center gap-2">
                                        <i class="fas fa-handshake"></i> Request Agent
                                    </a>
                                @else
                                    <span class="text-sm text-gray-500 italic">Only members can request agents</span>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="bg-yellow-400 text-black font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-sign-in-alt"></i> Login to Contact
                                </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-yellow-50 rounded-2xl border border-dashed border-yellow-300">
                        <i class="fas fa-user-tie text-yellow-400 text-6xl mb-4"></i>
                        <p class="text-gray-700 text-lg font-medium mb-4">No agents found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-guest-layout>
