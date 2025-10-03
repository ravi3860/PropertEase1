<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

  <?php $__env->startSection('title', 'Home'); ?>

    <!-- Hero Section -->
    <section class="py-24 bg-white relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 via-white to-yellow-100 opacity-70"></div>

      <div class="relative max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 px-6">
        
        <!-- Text -->
        <div class="flex-1 text-left animate-fadeIn">
          <h2 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
            Find Your <span class="text-yellow-600">Perfect Home</span> with Ease
          </h2>
          <h3 class="text-lg md:text-xl font-semibold text-gray-700 mb-4">
            Connecting Buyers, Sellers & Agents Seamlessly
          </h3>
          <p class="text-gray-600 mb-8 text-base md:text-lg max-w-lg">
            Explore trusted listings, connect with verified agents, and manage your real estate journey — all in one place.
          </p>
          <a href="<?php echo e(route('register')); ?>" 
             class="inline-block bg-yellow-500 text-white font-semibold px-8 py-3 rounded-full hover:bg-yellow-600 hover:shadow-lg transform hover:scale-105 transition duration-300">
            Get Started
          </a>
        </div>

        <!-- Image -->
        <div class="flex-1 animate-fadeIn delay-200">
          <img src="<?php echo e(asset('img/hmimage.png')); ?>" alt="Home illustration" 
               class="rounded-2xl shadow-lg border-4 border-yellow-200 hover:shadow-2xl transform hover:scale-105 transition duration-300">
        </div>
      </div>
    </section>

    <!-- Top Rated Properties -->
    <section class="py-20 bg-white border-t border-b border-yellow-200">
      <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
          <span class="text-yellow-600">🏆 Top Rated</span> Properties
        </h2>

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
          <?php $__empty_1 = true; $__currentLoopData = $topRatedProperties ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white border-2 border-yellow-200 rounded-2xl shadow hover:shadow-xl hover:border-yellow-400 transform hover:-translate-y-2 transition duration-300 overflow-hidden">
              <div class="relative">
                <img src="<?php echo e($property->images[0] ?? asset('images/default.jpg')); ?>" class="w-full h-60 object-cover">
                <span class="absolute bottom-3 right-3 bg-yellow-500 text-white text-sm font-bold px-4 py-1 rounded-full shadow-md">
                  LKR <?php echo e(number_format($property->price)); ?>

                </span>
              </div>
              <div class="p-6 space-y-2">
                <h3 class="text-xl font-semibold truncate text-gray-900"><?php echo e($property->title); ?></h3>
                <p class="text-sm text-gray-600 flex items-center">
                  <i class="fas fa-map-marker-alt text-yellow-600 mr-2"></i> <?php echo e($property->location); ?>

                </p>
                <p class="text-gray-500 text-sm line-clamp-2"><?php echo e($property->description); ?></p>
                <a href="<?php echo e(route('properties.index')); ?>" 
                   class="inline-block mt-3 text-yellow-600 font-semibold hover:underline hover:text-yellow-700 transition">
                  View More →
                </a>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="col-span-full text-center text-gray-600">No properties available right now.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-20 bg-gradient-to-b from-yellow-50 via-white to-yellow-100">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">What Our Users Say</h2>
      <div class="grid gap-10 md:grid-cols-3 max-w-7xl mx-auto px-6">
        <div class="p-6 border-2 border-yellow-300 rounded-2xl shadow-md bg-white hover:shadow-xl transform hover:-translate-y-2 transition duration-300">
          <p class="italic text-gray-700">“Smooth experience from start to finish. Found my dream home in days!”</p>
          <h3 class="mt-4 font-bold text-yellow-600 flex items-center"><i class="fas fa-user mr-2"></i> James W.</h3>
        </div>
        <div class="p-6 border-2 border-yellow-300 rounded-2xl shadow-md bg-white hover:shadow-xl transform hover:-translate-y-2 transition duration-300">
          <p class="italic text-gray-700">“Great interface and helpful support. The listings were accurate and up to date.”</p>
          <h3 class="mt-4 font-bold text-yellow-600 flex items-center"><i class="fas fa-user mr-2"></i> Daniel K.</h3>
        </div>
        <div class="p-6 border-2 border-yellow-300 rounded-2xl shadow-md bg-white hover:shadow-xl transform hover:-translate-y-2 transition duration-300">
          <p class="italic text-gray-700">“Love how simple and fast everything was. Highly recommend this platform!”</p>
          <h3 class="mt-4 font-bold text-yellow-600 flex items-center"><i class="fas fa-user mr-2"></i> Arjun M.</h3>
        </div>
      </div>
    </section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\banda\OneDrive\Desktop\PropertEase\resources\views/home.blade.php ENDPATH**/ ?>