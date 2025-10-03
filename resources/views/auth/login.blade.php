<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        {{-- Card container --}}
        <div class="w-full max-w-md mx-auto bg-white border border-yellow-100 shadow-sm rounded-2xl p-6 sm:p-8">
            <header class="mb-5 text-center">
                <h2 class="text-lg sm:text-2xl font-semibold text-gray-800">Welcome back</h2>
                <p class="mt-1 text-sm text-gray-500">Sign in to your PropertEase account</p>
            </header>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Role selection --}}
                @php $oldRole = old('role', 'member'); @endphp
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Login as</label>
                    <div class="flex flex-wrap items-center gap-3">
                        @foreach (['member' => 'M', 'agent' => 'A', 'admin' => 'AD'] as $role => $label)
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="{{ $role }}" class="hidden role-radio" {{ $oldRole === $role ? 'checked' : '' }} required>
                                <div
                                    data-role="{{ $role }}"
                                    role="button"
                                    tabindex="0"
                                    aria-pressed="{{ $oldRole === $role ? 'true' : 'false' }}"
                                    class="inline-flex items-center gap-3 px-3 py-2 rounded-full border text-sm font-medium transition
                                      {{ $oldRole === $role ? 'bg-yellow-50 border-yellow-400 text-yellow-800' : 'bg-white border-gray-200 text-gray-700 hover:shadow-sm' }}">
                                    {{-- Icons --}}
                                    @if ($role === 'member')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1119.07 8.93M12 7a4 4 0 100 8 4 4 0 000-8z" />
                                        </svg>
                                    @elseif ($role === 'agent')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7V6a2 2 0 00-2-2H8a2 2 0 00-2 2v1m8 0v1m0 0h4a2 2 0 012 2v6a2 2 0 01-2 2h-4M4 11h16" />
                                        </svg>
                                    @elseif ($role === 'admin')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l7 4v5c0 5-3.58 9.74-7 11-3.42-1.26-7-6-7-11V6l7-4z" />
                                        </svg>
                                    @endif
                                    <span>{{ ucfirst($role) }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Choose the account type you want to sign in with.</p>
                </div>

                {{-- Email --}}
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300"
                        autocomplete="email" autofocus>
                </div>

                {{-- Password --}}
                <div class="mt-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300 pr-10"
                        autocomplete="current-password">
                    <button type="button" id="togglePassword" class="absolute right-2 top-[42px] text-gray-400 hover:text-gray-600" aria-label="Show password">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                {{-- Remember + Forgot --}}
                <div class="mt-4 flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:underline" href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-300 px-5 py-2 text-sm font-semibold text-black shadow hover:from-yellow-500 hover:to-yellow-400 transition">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </x-authentication-card>

    {{-- Scripts --}}
    <script>
        (function () {
            const radios = Array.from(document.querySelectorAll('input[name="role"]'));
            const cards = Array.from(document.querySelectorAll('[data-role]'));

            function refreshRoleUI() {
                radios.forEach(radio => {
                    const card = cards.find(c => c.getAttribute('data-role') === radio.value);
                    if (!card) return;
                    if (radio.checked) {
                        card.classList.add('bg-yellow-50','border-yellow-400','text-yellow-800');
                        card.classList.remove('bg-white','border-gray-200','text-gray-700');
                        card.setAttribute('aria-pressed', 'true');
                    } else {
                        card.classList.remove('bg-yellow-50','border-yellow-400','text-yellow-800');
                        card.classList.add('bg-white','border-gray-200','text-gray-700');
                        card.setAttribute('aria-pressed', 'false');
                    }
                });
            }

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    const role = card.getAttribute('data-role');
                    const radio = radios.find(r => r.value === role);
                    if (radio) {
                        radio.checked = true;
                        refreshRoleUI();
                    }
                });
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        card.click();
                    }
                });
            });

            refreshRoleUI();

            const pwd = document.getElementById('password');
            const toggle = document.getElementById('togglePassword');
            if (toggle && pwd) {
                toggle.addEventListener('click', () => {
                    pwd.type = pwd.type === 'password' ? 'text' : 'password';
                });
            }
        })();
    </script>
</x-guest-layout>
