<x-guest-layout>
    <section class="bg-gradient-to-b from-yellow-100 to-white-200 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">Home Loan Calculator</h1>
            <p class="text-lg text-gray-700 mt-3">
                Calculate your monthly payments instantly and explore loan options.
            </p>
        </div>

        <!-- Loan Calculator Component -->
        @auth
            @livewire('loan-calculator')
        @else
            <div class="max-w-xl mx-auto bg-white border-2 border-white-300 rounded-2xl shadow-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Please log in to use the loan calculator</h2>
                <a href="{{ route('login') }}"
                   class="bg-white-400 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                    Login Now
                </a>
            </div>
        @endauth
    </section>
</x-guest-layout>
