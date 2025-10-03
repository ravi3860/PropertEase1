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
    <?php if (isset($component)) { $__componentOriginalf7b62739b7076c0563d3ad4515ad2917 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf7b62739b7076c0563d3ad4515ad2917 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.authentication-card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('authentication-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
         <?php $__env->slot('logo', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal1a590bee94ab2d9c08b342367154fca0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a590bee94ab2d9c08b342367154fca0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.authentication-card-logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('authentication-card-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a590bee94ab2d9c08b342367154fca0)): ?>
<?php $attributes = $__attributesOriginal1a590bee94ab2d9c08b342367154fca0; ?>
<?php unset($__attributesOriginal1a590bee94ab2d9c08b342367154fca0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a590bee94ab2d9c08b342367154fca0)): ?>
<?php $component = $__componentOriginal1a590bee94ab2d9c08b342367154fca0; ?>
<?php unset($__componentOriginal1a590bee94ab2d9c08b342367154fca0); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>

        <?php if (isset($component)) { $__componentOriginalb24df6adf99a77ed35057e476f61e153 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb24df6adf99a77ed35057e476f61e153 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation-errors','data' => ['class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb24df6adf99a77ed35057e476f61e153)): ?>
<?php $attributes = $__attributesOriginalb24df6adf99a77ed35057e476f61e153; ?>
<?php unset($__attributesOriginalb24df6adf99a77ed35057e476f61e153); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb24df6adf99a77ed35057e476f61e153)): ?>
<?php $component = $__componentOriginalb24df6adf99a77ed35057e476f61e153; ?>
<?php unset($__componentOriginalb24df6adf99a77ed35057e476f61e153); ?>
<?php endif; ?>

        <?php if(session('status')): ?>
            <div class="mb-4 font-medium text-sm text-green-600">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        
        <div class="w-full max-w-md mx-auto bg-white border border-yellow-100 shadow-sm rounded-2xl p-6 sm:p-8">
            <header class="mb-5 text-center">
                <h2 class="text-lg sm:text-2xl font-semibold text-gray-800">Welcome back</h2>
                <p class="mt-1 text-sm text-gray-500">Sign in to your PropertEase account</p>
            </header>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                
                <?php $oldRole = old('role', 'member'); ?>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Login as</label>
                    <div class="flex flex-wrap items-center gap-3">
                        <?php $__currentLoopData = ['member' => 'M', 'agent' => 'A', 'admin' => 'AD']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="<?php echo e($role); ?>" class="hidden role-radio" <?php echo e($oldRole === $role ? 'checked' : ''); ?> required>
                                <div
                                    data-role="<?php echo e($role); ?>"
                                    role="button"
                                    tabindex="0"
                                    aria-pressed="<?php echo e($oldRole === $role ? 'true' : 'false'); ?>"
                                    class="inline-flex items-center gap-3 px-3 py-2 rounded-full border text-sm font-medium transition
                                      <?php echo e($oldRole === $role ? 'bg-yellow-50 border-yellow-400 text-yellow-800' : 'bg-white border-gray-200 text-gray-700 hover:shadow-sm'); ?>">
                                    
                                    <?php if($role === 'member'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1119.07 8.93M12 7a4 4 0 100 8 4 4 0 000-8z" />
                                        </svg>
                                    <?php elseif($role === 'agent'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7V6a2 2 0 00-2-2H8a2 2 0 00-2 2v1m8 0v1m0 0h4a2 2 0 012 2v6a2 2 0 01-2 2h-4M4 11h16" />
                                        </svg>
                                    <?php elseif($role === 'admin'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l7 4v5c0 5-3.58 9.74-7 11-3.42-1.26-7-6-7-11V6l7-4z" />
                                        </svg>
                                    <?php endif; ?>
                                    <span><?php echo e(ucfirst($role)); ?></span>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Choose the account type you want to sign in with.</p>
                </div>

                
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300"
                        autocomplete="email" autofocus>
                </div>

                
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

                
                <div class="mt-4 flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    <?php if(Route::has('password.request')): ?>
                        <a class="text-sm text-gray-600 hover:underline" href="<?php echo e(route('password.request')); ?>">Forgot your password?</a>
                    <?php endif; ?>
                </div>

                
                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-300 px-5 py-2 text-sm font-semibold text-black shadow hover:from-yellow-500 hover:to-yellow-400 transition">
                        Log in
                    </button>
                </div>
            </form>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf7b62739b7076c0563d3ad4515ad2917)): ?>
<?php $attributes = $__attributesOriginalf7b62739b7076c0563d3ad4515ad2917; ?>
<?php unset($__attributesOriginalf7b62739b7076c0563d3ad4515ad2917); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf7b62739b7076c0563d3ad4515ad2917)): ?>
<?php $component = $__componentOriginalf7b62739b7076c0563d3ad4515ad2917; ?>
<?php unset($__componentOriginalf7b62739b7076c0563d3ad4515ad2917); ?>
<?php endif; ?>

    
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
<?php /**PATH C:\Users\banda\OneDrive\Desktop\PropertEase\resources\views/auth/login.blade.php ENDPATH**/ ?>