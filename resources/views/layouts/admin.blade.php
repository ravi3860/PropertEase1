<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'PropertEase') }} - Member Dashboard</title>

  <!-- Tailwind + Fonts + Icons -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

  <style>
    .btn-hover { transition: all 0.3s ease-in-out; }
    .btn-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(0,0,0,0.12); }
    .card-hover { transition: all 0.3s ease-in-out; }
    .card-hover:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(0,0,0,0.15); }
    .footer-link:hover { color: #FBBF24; transition: all 0.3s ease; }
    header { transition: box-shadow 0.3s ease; }
    header:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    [x-cloak] { display: none; }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 font-[Poppins]">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 1000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: "{{ session('error') }}",
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

<!-- Banner -->
<x-banner />

<!-- Header / Navbar -->
<header class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    <!-- Logo -->
    <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3 hover:scale-105 transition-transform duration-300">
      <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-12 w-12 rounded-full border-2 border-yellow-400 shadow-md">
      <span class="text-2xl font-extrabold text-gray-900 tracking-tight">PropertEase</span>
    </a>

    <!-- Navigation -->
    <nav class="hidden md:flex space-x-6 items-center">
      <a href="{{ route('home') }}" class="text-gray-800 font-semibold hover:text-yellow-500 transition-all duration-300">Home</a>
      <a href="{{ route('aboutus') }}" class="text-gray-800 font-semibold hover:text-yellow-500 transition-all duration-300">About Us</a>
      <a href="{{ route('browse') }}" class="text-gray-800 font-semibold hover:text-yellow-500 transition-all duration-300">Browse</a>
      <a href="{{ route('agents') }}" class="text-gray-800 font-semibold hover:text-yellow-500 transition-all duration-300">Find Agent</a>
      <a href="{{ route('loans') }}" class="text-gray-800 font-semibold hover:text-yellow-500 transition-all duration-300">Loans</a>
      <a href="{{ route('contact') }}" class="text-gray-800 font-semibold hover:text-yellow-500 transition-all duration-300">Contact</a>
    </nav>

    <!-- User Dropdown -->
    <div class="ml-4 relative">
      <x-dropdown align="right" width="48">
        <x-slot name="trigger">
          <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition btn-hover">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
          </button>
        </x-slot>

        <x-slot name="content">
          <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>
          <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>
          @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-dropdown-link href="{{ route('api-tokens.index') }}">API Tokens</x-dropdown-link>
          @endif
          <div class="border-t border-gray-200"></div>
          <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Log Out</x-dropdown-link>
          </form>
        </x-slot>
      </x-dropdown>
    </div>
  </div>
</header>

<!-- Main Content Slot -->
<main class="min-h-[70vh]">
  {{ $slot }}
</main>

<!-- Footer -->
<footer class="bg-yellow-50 text-gray-700 border-t border-yellow-200 mt-12">
  <div class="max-w-7xl mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-4 gap-8">

    <!-- Brand -->
    <div class="space-y-4">
      <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-16 w-16 rounded-full shadow-md border border-gray-300">
      <p class="font-bold text-gray-900">"Your Trusted Property Partner"</p>
      <p class="text-sm text-gray-600">Connecting buyers and sellers with ease and transparency.</p>
      <div class="flex space-x-4 mt-2">
        <a href="#" class="hover:text-pink-600 transition"><i class="fab fa-instagram text-2xl"></i></a>
        <a href="#" class="hover:text-blue-600 transition"><i class="fab fa-facebook text-2xl"></i></a>
        <a href="#" class="hover:text-gray-800 transition"><i class="fab fa-x-twitter text-2xl"></i></a>
        <a href="#" class="hover:text-blue-500 transition"><i class="fab fa-linkedin text-2xl"></i></a>
      </div>
    </div>

    <!-- Quick Links -->
    <div class="space-y-4">
      <h4 class="font-bold text-lg text-gray-900">Quick Links</h4>
      <ul class="flex flex-col space-y-2">
        <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
        <li><a href="{{ route('aboutus') }}" class="footer-link">About Us</a></li>
        <li><a href="{{ route('browse') }}" class="footer-link">Browse Properties</a></li>
        <li><a href="{{ route('agents') }}" class="footer-link">Find an Agent</a></li>
        <li><a href="{{ route('loans') }}" class="footer-link">Home Loans</a></li>
        <li><a href="{{ route('contact') }}" class="footer-link">Contact Us</a></li>
      </ul>
    </div>

    <!-- Helpful Resources -->
    <div class="space-y-4">
      <h4 class="font-bold text-lg text-gray-900">Helpful Resources</h4>
      <ul class="flex flex-col space-y-2">
        <li><a href="#" class="footer-link">Terms & Conditions</a></li>
        <li><a href="#" class="footer-link">Privacy Policy</a></li>
        <li><a href="#" class="footer-link">Blog</a></li>
        <li><a href="#" class="footer-link">Support Center</a></li>
        <li><a href="#" class="footer-link">How It Works</a></li>
      </ul>
    </div>

    <!-- Contact Info -->
    <div class="space-y-2">
      <h4 class="font-bold text-lg text-gray-900">Contact Info</h4>
      <p>📍 123 Main Street, Colombo, Sri Lanka</p>
      <p>📞 +94 77 123 4567</p>
      <p>📧 info@PropertEase.com</p>
    </div>
  </div>

  <div class="text-center py-4 bg-yellow-100 font-medium text-gray-800">
    © 2025 PropertEase. All rights reserved.
  </div>
</footer>

@livewireScripts
</body>
</html>
