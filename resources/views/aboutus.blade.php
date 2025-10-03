<x-guest-layout>
    @section('title', 'About Us')

    <!-- Hero Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="relative max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 px-6">

            <!-- Text -->
            <div class="flex-1 text-left animate-fadeIn">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    Who We Are
                </h2>
                <h3 class="text-lg md:text-xl font-semibold text-gray-700 mb-4">
                    Empowering Property Seekers with Trust and Technology
                </h3>
                <p class="text-gray-600 mb-8 text-base md:text-lg max-w-lg">
                    We're a digital real estate platform connecting buyers, sellers, and agents — making property transactions simple, smart, and secure.
                </p>
            </div>

            <!-- Image -->
            <div class="flex-1 animate-fadeIn delay-200">
                <img src="{{ asset('img/abutus.png') }}" alt="About Us Illustration"
                     class="rounded-2xl shadow-lg border-4 border-yellow-100 hover:shadow-2xl transform hover:scale-105 transition duration-300">
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-24 bg-white border-t border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12">Our Mission & Vision</h2>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Mission -->
                <div class="text-left animate-fadeIn">
                    <h3 class="text-2xl font-bold mb-3 flex items-center gap-2">
                        🎯 Mission
                    </h3>
                    <p class="text-gray-700 text-base md:text-lg italic font-medium">
                        To simplify real estate experiences by connecting people with the right properties through a trusted and user-friendly platform.
                    </p>
                </div>
                <div class="animate-fadeIn">
                    <img src="{{ asset('img/mission.jpg') }}" alt="Mission Image"
                         class="rounded-2xl shadow-lg w-full h-64 object-cover">
                </div>

                <!-- Vision -->
                <div class="animate-fadeIn order-last md:order-first">
                    <img src="{{ asset('img/vision.png') }}" alt="Vision Image"
                         class="rounded-2xl shadow-lg w-full h-64 object-cover">
                </div>
                <div class="text-left animate-fadeIn">
                    <h3 class="text-2xl font-bold mb-3 flex items-center gap-2">
                        🌟 Vision
                    </h3>
                    <p class="text-gray-700 text-base md:text-lg italic font-medium">
                        To become the go-to real estate platform, empowering users to find their perfect property with confidence and ease.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Founders -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12">Meet Our Founders</h2>

            <div class="grid md:grid-cols-3 gap-12">
                @foreach([
                    ['name'=>'Aiden Fernando', 'role'=>'CEO & Co-Founder', 'bio'=>'Visionary leader passionate about tech-driven real estate solutions.', 'img'=>'Founder1.webp'],
                    ['name'=>'Nimal Perera', 'role'=>'CTO & Co-Founder', 'bio'=>'Tech expert building reliable and secure property platforms.', 'img'=>'Founder2.jpg'],
                    ['name'=>'Shanika Jayasuriya', 'role'=>'COO & Co-Founder', 'bio'=>'Operational strategist focused on seamless user experience and growth.', 'img'=>'Founder3.jpg']
                ] as $founder)
                <div class="flex flex-col items-center">
                    <img src="{{ asset('img/'.$founder['img']) }}" alt="{{ $founder['name'] }}"
                         class="w-40 h-40 rounded-full object-cover shadow-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $founder['name'] }}</h3>
                    <p class="text-gray-700 font-medium mb-1">{{ $founder['role'] }}</p>
                    <p class="text-gray-600 text-sm italic">{{ $founder['bio'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12">Frequently Asked Questions</h2>

            <div class="space-y-6 text-left">
                @foreach([
                    ['q'=>'How do I create an account?', 'a'=>'Click on the Sign Up button, choose your role, and fill out the registration form.'],
                    ['q'=>'Can I list my property for free?', 'a'=>'Yes, we offer a free listing tier for basic property visibility. Premium features are optional.'],
                    ['q'=>'How do I contact an agent?', 'a'=>'Use the “Find an Agent” menu option to browse and message agents directly from their profile.'],
                    ['q'=>'What are the available subscription plans?', 'a'=>'We offer monthly and annual subscription plans with benefits like priority listings, analytics, and support.']
                ] as $faq)
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $faq['q'] }}</h3>
                    <p class="text-gray-700 text-sm">{{ $faq['a'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
