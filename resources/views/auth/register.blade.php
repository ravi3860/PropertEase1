<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- Validation Errors --}}
        <x-validation-errors class="mb-4" />

        {{-- Card container with white background + subtle yellow outline --}}
        <div class="w-full max-w-2xl mx-auto bg-white border border-yellow-200 shadow-lg rounded-2xl p-6 sm:p-10">
            <header class="mb-6 text-center">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">Create your account</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Join PropertEase — list properties, browse listings and manage purchases.
                </p>
            </header>

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                {{-- Role selection --}}
                @php $oldRole = old('role', 'member'); @endphp
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Register as</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Member --}}
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="member"
                                class="hidden role-radio"
                                {{ $oldRole === 'member' ? 'checked' : '' }} required />
                            <div data-role="member"
                                class="flex flex-col items-center justify-center rounded-xl border p-6 transition hover:shadow-md
                                    {{ $oldRole === 'member'
                                        ? 'bg-yellow-50 border-yellow-400 text-yellow-800'
                                        : 'bg-white border-gray-200 text-gray-700' }}">
                                <i class="fas fa-user h-10 w-10 mb-2 text-2xl"></i>
                                <span class="text-base font-semibold">Member</span>
                                <p class="text-xs text-gray-500 mt-1 text-center">Browse & purchase properties</p>
                            </div>
                        </label>

                        {{-- Agent --}}
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="agent"
                                class="hidden role-radio"
                                {{ $oldRole === 'agent' ? 'checked' : '' }} required />
                            <div data-role="agent"
                                class="flex flex-col items-center justify-center rounded-xl border p-6 transition hover:shadow-md
                                    {{ $oldRole === 'agent'
                                        ? 'bg-yellow-50 border-yellow-400 text-yellow-800'
                                        : 'bg-white border-gray-200 text-gray-700' }}">
                                <i class="fas fa-building h-10 w-10 mb-2 text-2xl"></i>
                                <span class="text-base font-semibold">Agent</span>
                                <p class="text-xs text-gray-500 mt-1 text-center">List & manage properties</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Grid layout for form fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Full name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" autofocus />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" />
                    </div>

                    {{-- Phone (optional) --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone (optional)</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" />
                    </div>
                </div>

                {{-- Agent-only fields --}}
                <div id="agentFields" class="mt-4 space-y-4 {{ $oldRole === 'agent' ? '' : 'hidden' }}">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="license_number" class="block text-sm font-medium text-gray-700">License number</label>
                            <input id="license_number" name="license_number" type="text" value="{{ old('license_number') }}"
                                class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300"
                                {{ $oldRole === 'agent' ? 'required' : '' }} />
                        </div>
                        <div>
                            <label for="agency_name" class="block text-sm font-medium text-gray-700">Agency name</label>
                            <input id="agency_name" name="agency_name" type="text" value="{{ old('agency_name') }}"
                                class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300"
                                {{ $oldRole === 'agent' ? 'required' : '' }} />
                        </div>
                    </div>
                </div>

                {{-- Passwords --}}
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" />
                    </div>
                </div>

                {{-- Terms --}}
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <label class="inline-flex items-center text-sm">
                            <input type="checkbox" name="terms" id="terms" class="rounded" required>
                            <span class="ml-2 text-gray-600 text-sm">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </span>
                        </label>
                    </div>
                @endif

                {{-- Submit / Login link --}}
                <div class="mt-6 flex items-center justify-between">
                    <a class="text-sm text-gray-600 hover:underline" href="{{ route('login') }}">
                        Already registered?
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-300 px-6 py-2 text-sm font-semibold text-black shadow hover:from-yellow-500 hover:to-yellow-400 transition">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </x-authentication-card>

    {{-- JS for role toggle --}}
    <script>
        const roleRadios = document.querySelectorAll('input[name="role"]');
        const agentFields = document.getElementById('agentFields');
        const licenseInput = document.getElementById('license_number');
        const agencyInput = document.getElementById('agency_name');

        function toggleAgentFields(isAgent) {
            if (isAgent) {
                agentFields.classList.remove('hidden');
                licenseInput.required = true;
                agencyInput.required = true;
            } else {
                agentFields.classList.add('hidden');
                licenseInput.required = false;
                agencyInput.required = false;
            }
        }

        roleRadios.forEach(radio => {
            radio.addEventListener('change', e => toggleAgentFields(e.target.value === 'agent'));
        });

        // Initialize on load
        const selected = Array.from(roleRadios).find(r => r.checked);
        toggleAgentFields(selected && selected.value === 'agent');
    </script>
</x-guest-layout>
