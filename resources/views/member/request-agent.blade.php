<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Request Agent') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-50 p-6">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-10 border border-yellow-200 hover:shadow-yellow-300 transition-shadow duration-500">
            
            <!-- Agent Info -->
            <div class="flex items-center gap-5 mb-8 p-4 bg-yellow-50 rounded-xl border border-yellow-100 shadow-inner">
                <div class="w-20 h-20 rounded-full bg-yellow-400 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    {{ strtoupper(substr($agent->user->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-black">{{ $agent->user->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $agent->agency_name ?? 'Independent Agent' }}</p>
                </div>
            </div>

            <!-- Request Form -->
            <form action="{{ route('member.request-agent.store', $agent->id) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="agent_id" value="{{ $agent->id }}">

                <!-- Message -->
                <div>
                    <label class="block text-black font-semibold mb-2">Message</label>
                    <textarea name="message" rows="5"
                        class="w-full px-5 py-4 border border-yellow-200 rounded-2xl shadow-sm focus:ring-4 focus:ring-yellow-300 focus:border-yellow-400 transition-all duration-300 placeholder-gray-400"
                        placeholder="Explain what kind of property or service you are looking for..." required></textarea>
                </div>

                <!-- Type Selection -->
                <div>
                    <label class="block text-black font-semibold mb-2">Request Type</label>
                    <select name="type" required
                        class="w-full px-5 py-3 border border-yellow-200 rounded-2xl shadow-sm focus:ring-4 focus:ring-yellow-300 focus:border-yellow-400 transition-all duration-300 bg-white text-black">
                        <option value="general">General</option>
                        <option value="visit">Visit</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-4 bg-yellow-400 text-black font-bold rounded-2xl shadow-lg hover:bg-yellow-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3">
                    <i class="fas fa-paper-plane"></i>
                    Send Request
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
