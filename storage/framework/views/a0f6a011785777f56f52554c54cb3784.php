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

        
        <div class="w-full max-w-2xl mx-auto bg-white border border-yellow-200 shadow-lg rounded-2xl p-6 sm:p-10">
            <header class="mb-6 text-center">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">Create your account</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Join PropertEase — list properties, browse listings and manage purchases.
                </p>
            </header>

            <form method="POST" action="<?php echo e(route('register')); ?>" novalidate>
                <?php echo csrf_field(); ?>

                
                <?php $oldRole = old('role', 'member'); ?>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Register as</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="member"
                                class="hidden role-radio"
                                <?php echo e($oldRole === 'member' ? 'checked' : ''); ?> required />
                            <div data-role="member"
                                class="flex flex-col items-center justify-center rounded-xl border p-6 transition hover:shadow-md
                                    <?php echo e($oldRole === 'member'
                                        ? 'bg-yellow-50 border-yellow-400 text-yellow-800'
                                        : 'bg-white border-gray-200 text-gray-700'); ?>">
                                <i class="fas fa-user h-10 w-10 mb-2 text-2xl"></i>
                                <span class="text-base font-semibold">Member</span>
                                <p class="text-xs text-gray-500 mt-1 text-center">Browse & purchase properties</p>
                            </div>
                        </label>

                        
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="agent"
                                class="hidden role-radio"
                                <?php echo e($oldRole === 'agent' ? 'checked' : ''); ?> required />
                            <div data-role="agent"
                                class="flex flex-col items-center justify-center rounded-xl border p-6 transition hover:shadow-md
                                    <?php echo e($oldRole === 'agent'
                                        ? 'bg-yellow-50 border-yellow-400 text-yellow-800'
                                        : 'bg-white border-gray-200 text-gray-700'); ?>">
                                <i class="fas fa-building h-10 w-10 mb-2 text-2xl"></i>
                                <span class="text-base font-semibold">Agent</span>
                                <p class="text-xs text-gray-500 mt-1 text-center">List & manage properties</p>
                            </div>
                        </label>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                        <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" required
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" autofocus />
                    </div>

                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" />
                    </div>

                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone (optional)</label>
                        <input id="phone" name="phone" type="text" value="<?php echo e(old('phone')); ?>"
                            class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300" />
                    </div>
                </div>

                
                <div id="agentFields" class="mt-4 space-y-4 <?php echo e($oldRole === 'agent' ? '' : 'hidden'); ?>">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="license_number" class="block text-sm font-medium text-gray-700">License number</label>
                            <input id="license_number" name="license_number" type="text" value="<?php echo e(old('license_number')); ?>"
                                class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300"
                                <?php echo e($oldRole === 'agent' ? 'required' : ''); ?> />
                        </div>
                        <div>
                            <label for="agency_name" class="block text-sm font-medium text-gray-700">Agency name</label>
                            <input id="agency_name" name="agency_name" type="text" value="<?php echo e(old('agency_name')); ?>"
                                class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 bg-white placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300"
                                <?php echo e($oldRole === 'agent' ? 'required' : ''); ?> />
                        </div>
                    </div>
                </div>

                
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

                
                <?php if(Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature()): ?>
                    <div class="mt-4">
                        <label class="inline-flex items-center text-sm">
                            <input type="checkbox" name="terms" id="terms" class="rounded" required>
                            <span class="ml-2 text-gray-600 text-sm">
                                <?php echo __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm">'.__('Privacy Policy').'</a>',
                                ]); ?>

                            </span>
                        </label>
                    </div>
                <?php endif; ?>

                
                <div class="mt-6 flex items-center justify-between">
                    <a class="text-sm text-gray-600 hover:underline" href="<?php echo e(route('login')); ?>">
                        Already registered?
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-300 px-6 py-2 text-sm font-semibold text-black shadow hover:from-yellow-500 hover:to-yellow-400 transition">
                        Register
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
<?php /**PATH C:\Users\banda\OneDrive\Desktop\PropertEase\resources\views/auth/register.blade.php ENDPATH**/ ?>