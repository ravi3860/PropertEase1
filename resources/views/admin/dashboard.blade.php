<x-admin-layout>

    @section('title', 'Admin Dashboard')

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-72 bg-white border-r border-gray-200 p-6 space-y-6 shadow-xl sticky top-0">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase mb-8">Admin Menu</h2>
            <button onclick="showSection('dashboard')" class="w-full py-3 rounded-xl bg-yellow-500 text-white font-semibold hover:bg-yellow-600 transition flex items-center gap-3">
                <i class="fas fa-home w-5"></i> Dashboard
            </button>
            <button onclick="showSection('members')" class="w-full py-3 rounded-xl bg-yellow-500 text-white font-semibold hover:bg-yellow-600 transition flex items-center gap-3">
                <i class="fas fa-users w-5"></i> Members
            </button>
            <button onclick="showSection('agents')" class="w-full py-3 rounded-xl bg-yellow-500 text-white font-semibold hover:bg-yellow-600 transition flex items-center gap-3">
                <i class="fas fa-user-tie w-5"></i> Agents
            </button>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 space-y-10">
            <!-- Dashboard Overview -->
            <section id="dashboard">
                <h1 class="text-4xl font-bold mb-6">Welcome, {{ $admin->user->name }}</h1>
                <p class="text-gray-700 text-lg mb-8">This is your admin dashboard. Use the sidebar to manage members and agents.</p>

                <!-- Stat Cards -->
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-yellow-500 hover:shadow-xl transition transform hover:-translate-y-1">
                        <h3 class="text-gray-500 font-semibold">Total Members</h3>
                        <p class="text-2xl font-bold mt-2">{{ $members->count() ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-yellow-500 hover:shadow-xl transition transform hover:-translate-y-1">
                        <h3 class="text-gray-500 font-semibold">Total Agents</h3>
                        <p class="text-2xl font-bold mt-2">{{ $agents->count() ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-yellow-500 hover:shadow-xl transition transform hover:-translate-y-1">
                        <h3 class="text-gray-500 font-semibold">Total Properties</h3>
                        <p class="text-2xl font-bold mt-2">{{ \App\Models\Property::count() }}</p>
                    </div>
                </div>
                <!-- Charts Placeholder (Livewire component can go here) -->
                <div class="mt-10 grid sm:grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-yellow-500">
                        <h3 class="text-lg font-semibold mb-4">Properties Added (Monthly)</h3>
                        <livewire:dashboard-properties-chart />
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-yellow-500">
                        <h3 class="text-lg font-semibold mb-4">Members vs Agents</h3>
                        <livewire:dashboard-users-chart />
                    </div>
                </div>
            </section>

            <!-- Members Section -->
            <section id="members" class="hidden">
                <h2 class="text-3xl font-bold mb-8">Members</h2>
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($members ?? [] as $member)
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-2 border-yellow-300">
                        <h3 class="text-xl font-semibold mb-2">{{ $member->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $member->email }}</p>
                        <div class="flex flex-col gap-3">
                            <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
                                @csrf @method('PUT')
                                <label class="block text-gray-500 font-medium mb-1">Name</label>
                                <input type="text" name="name" value="{{ $member->name }}" class="w-full p-2 rounded-lg border border-gray-300 mb-2">
                                <label class="block text-gray-500 font-medium mb-1">Email</label>
                                <input type="email" name="email" value="{{ $member->email }}" class="w-full p-2 rounded-lg border border-gray-300 mb-2">
                                <button class="w-full bg-yellow-500 text-white py-2 rounded-xl font-semibold hover:bg-yellow-600 transition">
                                    Update
                                </button>
                            </form>
                            <form action="{{ route('admin.members.delete', $member->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="w-full bg-red-500 text-white py-2 rounded-xl font-semibold hover:bg-red-600 transition" onclick="return confirm('Are you sure you want to delete this member?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Agents Section -->
            <section id="agents" class="hidden">
                <h2 class="text-3xl font-bold mb-8">Agents</h2>
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($agents ?? [] as $agent)
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border-2 border-yellow-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-yellow-200 flex items-center justify-center text-yellow-700 font-bold text-lg">
                                {{ strtoupper(substr($agent->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold">{{ $agent->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $agent->email }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3">
                            <form action="{{ route('admin.agents.update', $agent->id) }}" method="POST">
                                @csrf @method('PUT')
                                <label class="block text-gray-500 font-medium mb-1">Name</label>
                                <input type="text" name="name" value="{{ $agent->name }}" class="w-full p-2 rounded-lg border border-gray-300 mb-2">
                                <label class="block text-gray-500 font-medium mb-1">Email</label>
                                <input type="email" name="email" value="{{ $agent->email }}" class="w-full p-2 rounded-lg border border-gray-300 mb-2">
                                <button class="w-full bg-yellow-500 text-white py-2 rounded-xl font-semibold hover:bg-yellow-600 transition">
                                    Update
                                </button>
                            </form>
                            <form action="{{ route('admin.agents.delete', $agent->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="w-full bg-red-500 text-white py-2 rounded-xl font-semibold hover:bg-red-600 transition" onclick="return confirm('Are you sure you want to delete this agent?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
    <script>
        function showSection(id) {
            document.querySelectorAll('main > section').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(id)?.classList.remove('hidden');
        }
        // Default to dashboard
        showSection('dashboard');
    </script>
</x-admin-layout>
