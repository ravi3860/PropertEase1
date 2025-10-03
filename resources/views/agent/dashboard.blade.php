<x-agent-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-black tracking-tight">
            {{ __('Agent Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-1 min-h-screen font-[Poppins] bg-gray-50 py-10 px-6 sm:px-12">

        <!-- Sidebar -->
        <aside class="w-72 bg-white p-8 space-y-6 shadow-xl rounded-tr-3xl rounded-br-3xl border border-yellow-200">
            <h2 class="text-2xl font-extrabold text-black mb-8 uppercase tracking-wide">Agent Menu</h2>

            <!-- Sidebar Buttons -->
            <button onclick="showSection('profile')" 
                class="w-full py-3 rounded-xl bg-white text-black font-semibold shadow-md border border-yellow-200 flex items-center gap-3 px-5 hover:bg-yellow-50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 active:bg-yellow-100">
                <i class="fas fa-user-circle text-yellow-600 text-lg"></i>
                My Profile
            </button>

            <button onclick="showSection('client-requests')" 
                class="w-full py-3 rounded-xl bg-white text-black font-semibold shadow-md border border-yellow-200 flex items-center gap-3 px-5 hover:bg-yellow-50 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 active:bg-yellow-100">
                <i class="fas fa-users text-yellow-600 text-lg"></i>
                Client Requests
            </button>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-8 p-10 bg-white rounded-tl-3xl rounded-bl-3xl shadow-xl border border-yellow-200">
            
            <h1 class="text-4xl font-extrabold text-black mb-12">Welcome back, Agent!</h1>

            <!-- Profile Section -->
            <section id="profile">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-black mb-6">Profile Details</h2>
                </div>

                <form method="POST" action="{{ route('agent.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Email -->
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-yellow-200 hover:shadow-lg transition-all duration-300">
                            <label class="block text-sm font-semibold text-black mb-2">Email</label>
                            <!-- Email -->
                        <input type="email" name="email" value="{{ $agent->user->email }}"
                            class="w-full px-5 py-3 border border-yellow-300 rounded-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition placeholder-gray-400"/>
                        </div>

                        <!-- Phone -->
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-yellow-200 hover:shadow-lg transition-all duration-300">
                            <label class="block text-sm font-semibold text-black mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ $agent->phone }}"
                                   class="w-full px-5 py-3 border border-yellow-300 rounded-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition placeholder-gray-400"/>
                        </div>

                        <!-- License Number -->
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-yellow-200 hover:shadow-lg transition-all duration-300">
                            <label class="block text-sm font-semibold text-black mb-2">License Number</label>
                            <input type="text" name="license_number" value="{{ $agent->license_number }}"
                                   class="w-full px-5 py-3 border border-yellow-300 rounded-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition placeholder-gray-400"/>
                        </div>

                        <!-- Agency Name -->
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-yellow-200 hover:shadow-lg transition-all duration-300">
                            <label class="block text-sm font-semibold text-black mb-2">Agency Name</label>
                            <input type="text" name="agency_name" value="{{ $agent->agency_name }}"
                                   class="w-full px-5 py-3 border border-yellow-300 rounded-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition placeholder-gray-400"/>
                        </div>
                    </div>

                    <!-- Professional Update Button -->
                    <button type="submit" 
                        class="w-full py-3 mt-8 rounded-3xl bg-gradient-to-r from-white-500 to-yellow-200 text-black font-extrabold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:from-white-600 hover:to-yellow-300 flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        Update Profile
                    </button>
                </form>
            </section>

            <!-- Client Requests -->
            <section id="client-requests" class="hidden">
                <h2 class="text-3xl font-extrabold text-black mb-6">Client Requests</h2>

                @if($requests->count())
                    <div class="space-y-4">
                        @foreach($requests as $request)
                            <div class="p-6 bg-white rounded-xl shadow border border-yellow-200 flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-bold text-black">{{ $request->member->user->name }}</h4>
                                    <p class="text-gray-600">{{ $request->message }}</p>
                                    <p class="text-sm text-gray-500">Type: {{ $request->type ?? 'Not provided' }}</p>
                                </div>
                               <div class="flex gap-3 items-center">
                                    @if($request->status === 'pending')
                                        <!-- Only show buttons if request is pending -->
                                        <form action="{{ route('agent.contact-requests.update', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Accept</button>
                                        </form>
                                        <form action="{{ route('agent.contact-requests.update', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="declined">
                                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Reject</button>
                                        </form>
                                    @else
                                        <!-- Show current status if already accepted/declined -->
                                        @if($request->status === 'accepted')
                                            <span class="px-4 py-2 bg-green-500 text-white rounded-lg font-bold">Accepted</span>
                                        @elseif($request->status === 'declined')
                                            <span class="px-4 py-2 bg-red-500 text-white rounded-lg font-bold">Declined</span>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 bg-yellow-50 rounded-xl border border-dashed border-yellow-300">
                        <i class="fas fa-envelope text-yellow-400 text-5xl mb-4"></i>
                        <p class="text-gray-700 text-lg">No client requests yet.</p>
                    </div>
                @endif
            </section>

        </main>
    </div>

    <script>
        function showSection(id) {
            document.querySelectorAll('main > section').forEach(s => s.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
        }
        showSection('profile');
    </script>
</x-agent-layout>
