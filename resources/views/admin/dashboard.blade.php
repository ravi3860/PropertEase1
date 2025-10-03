<x-admin-layout>

    @section('title', 'Admin Dashboard')

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-72 bg-white border-r border-gray-200 p-6 space-y-6 shadow-lg sticky top-0">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase mb-8">Admin Menu</h2>
            <button onclick="showSection('dashboard')" class="w-full py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-home"></i> Dashboard
            </button>
            <button onclick="showSection('members')" class="w-full py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-users"></i> Members
            </button>
            <button onclick="showSection('agents')" class="w-full py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-user-tie"></i> Agents
            </button>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">
            <!-- Dashboard -->
            <section id="dashboard">
                <h1 class="text-4xl font-bold mb-8">Welcome, {{ $admin->user->name }}</h1>
                <p class="text-gray-700">This is your admin dashboard.</p>
            </section>

            <!-- Members -->
            <section id="members" class="hidden">
                <h2 class="text-3xl font-bold mb-6">Members</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members ?? [] as $member)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $member->name }}</td>
                            <td class="px-4 py-2">{{ $member->email }}</td>
                            <td class="px-4 py-2 space-x-2 flex">
                                <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button class="bg-green-500 text-white px-3 py-1 rounded">Update</button>
                                </form>
                                <form action="{{ route('admin.members.delete', $member->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <!-- Agents -->
            <section id="agents" class="hidden">
                <h2 class="text-3xl font-bold mb-6">Agents</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agents ?? [] as $agent)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $agent->name }}</td>
                            <td class="px-4 py-2">{{ $agent->email }}</td>
                            <td class="px-4 py-2 space-x-2 flex">
                                <form action="{{ route('admin.agents.update', $agent->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button class="bg-green-500 text-white px-3 py-1 rounded">Update</button>
                                </form>
                                <form action="{{ route('admin.agents.delete', $agent->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
