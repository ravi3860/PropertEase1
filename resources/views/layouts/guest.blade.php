<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>{{ config('app.name', 'PropertEase') }} - @yield('title')</title>

  <!-- Tailwind + Fonts + Icons -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Vite (optional if you use app.css/js) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles
</head>
<body class="bg-white text-gray-900 font-[Poppins]">

  <!-- Header -->
  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-12 w-12 rounded-full border-2 border-yellow-400 shadow-md">
        <span class="text-2xl font-bold text-gray-900 tracking-tight">PropertEase</span>
      </a>

      <!-- Navigation -->
      <nav class="hidden md:flex space-x-6 items-center">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
        <a href="{{ route('aboutus') }}" class="nav-link">About Us</a>
        <a href="{{ route('browse') }}" class="nav-link">Browse</a>
        <a href="{{ route('agents') }}" class="nav-link">Find Agent</a>
        <a href="{{ route('loans') }}" class="nav-link">Loans</a>
        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
      </nav>

      <!-- User Icon -->
      <div class="ml-4">
        @auth
          @php
            $role = Auth::user()->role;
            $dashboardLink = $role === 'admin' ? route('admin.dashboard') : ($role === 'agent' ? route('agent.dashboard') : route('member.dashboard'));
          @endphp
          <a href="{{ $dashboardLink }}" class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-200 transition">
            <i class="fas fa-user text-xl text-gray-800"></i>
          </a>
        @else
          <a href="{{ route('login') }}" class="p-2 rounded-full bg-yellow-100 hover:bg-yellow-200 transition">
            <i class="fas fa-user text-xl text-gray-800"></i>
          </a>
        @endauth
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    {{ $slot }}
  </main>

  <!-- Footer -->
  <footer class="bg-yellow-50 text-gray-700 border-t border-yellow-200 mt-8">
    <div class="max-w-7xl mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-4 gap-8">

      <!-- Brand -->
      <div>
        <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-16 w-16 rounded-full shadow-md border border-gray-300 mb-4">
        <p class="font-bold mb-1">"Your Trusted Property Partner"</p>
        <p class="text-sm font-medium mb-4">Connecting buyers and sellers with ease and transparency.</p>
        <div class="flex space-x-4">
          <a href="#"><i class="fab fa-instagram text-2xl hover:text-pink-600"></i></a>
          <a href="#"><i class="fab fa-facebook text-2xl hover:text-blue-600"></i></a>
          <a href="#"><i class="fab fa-x-twitter text-2xl hover:text-gray-800"></i></a>
          <a href="#"><i class="fab fa-linkedin text-2xl hover:text-blue-500"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h4 class="font-bold mb-3 text-lg">Quick Links</h4>
        <ul class="space-y-2">
          <li><a href="{{ route('home') }}" class="hover:text-yellow-600">Home</a></li>
          <li><a href="{{ route('aboutus') }}" class="hover:text-yellow-600">About Us</a></li>
          <li><a href="{{ route('browse') }}" class="hover:text-yellow-600">Browse Properties</a></li>
          <li><a href="{{ route('agents') }}" class="hover:text-yellow-600">Find an Agent</a></li>
          <li><a href="{{ route('loans') }}" class="hover:text-yellow-600">Home Loans</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-yellow-600">Contact Us</a></li>
        </ul>
      </div>

      <!-- Helpful Resources -->
      <div>
        <h4 class="font-bold mb-3 text-lg">Helpful Resources</h4>
        <ul class="space-y-2">
          <li><a href="#" class="hover:text-yellow-600">Terms & Conditions</a></li>
          <li><a href="#" class="hover:text-yellow-600">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-yellow-600">Blog</a></li>
          <li><a href="#" class="hover:text-yellow-600">Support Center</a></li>
          <li><a href="#" class="hover:text-yellow-600">How It Works</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div>
        <h4 class="font-bold mb-3 text-lg">Contact Info</h4>
        <p class="mb-2">📍 123 Main Street, Colombo, Sri Lanka</p>
        <p class="mb-2">📞 +94 77 123 4567</p>
        <p>📧 info@PropertEase.com</p>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center py-4 bg-yellow-100 font-medium">
      © 2025 PropertEase. All rights reserved.
    </div>
  </footer>

  @livewireScripts
</body>
</html>
