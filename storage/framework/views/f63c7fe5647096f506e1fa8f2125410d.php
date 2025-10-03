<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-black leading-tight">
            <?php echo e(__('Member Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-white p-6 shadow-xl border-l-4 border-yellow-100">
            <h2 class="text-xl font-medium text-black mb-8">
                Welcome back, <?php echo e($member->user->name ?? $member->user->username ?? 'Member'); ?>!
            </h2>
            <button onclick="showSection('profile')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                My Profile
            </button>
            <button onclick="showSection('properties')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                My Properties
            </button>
            <button onclick="showSection('agent')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                Agent Request Status
            </button>
            <button onclick="showSection('subscription')" class="w-full py-3 mb-3 bg-transparent text-black border border-yellow-200 rounded-lg shadow-md hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                Purchase Status
            </button>
        </aside>

        <!-- Main Content -->
        <main class="w-4/5 p-6">
            <!-- Profile Section -->
            <section id="profile" class="section bg-white p-8 rounded-lg shadow-xl border border-yellow-100 mb-6 transition-all duration-300 ease-in-out transform hover:scale-105">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full mr-4 flex items-center justify-center text-white font-semibold text-xl uppercase shadow-md">
                        <?php echo e(strtoupper(substr($member->user->name ?? 'M', 0, 1))); ?>

                    </div>
                    <h2 class="text-2xl font-medium text-black"><?php echo e($member->user->name ?? 'Member'); ?></h2>
                </div>

                <form method="POST" action="<?php echo e(route('member.update')); ?>" class="grid grid-cols-2 gap-4 mb-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div>
                        <label class="block text-black mb-1 font-medium">Name</label>
                        <input name="name" value="<?php echo e($member->user->name); ?>" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black mb-1 font-medium">Email</label>
                        <input name="email" type="email" value="<?php echo e($member->user->email); ?>" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black mb-1 font-medium">Phone</label>
                        <input name="phone" type="text" value="<?php echo e($member->phone); ?>" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black mb-1 font-medium">Password</label>
                        <input type="password" value="********" class="w-full p-3 border border-yellow-200 rounded-lg shadow-sm bg-gray-100" disabled>
                        <small class="text-xs text-black">Use change-password to update.</small>
                    </div>

                    <div class="col-span-2 flex space-x-4 pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-100 to-yellow-100 text-black py-3 px-6 rounded-lg shadow-md hover:from-yellow-100 hover:to-yellow-100 transition-all duration-300">
                            Update
                        </button>
                    </div>
                </form>
            </section>

            <!-- Properties Section -->
            <section id="properties" class="section hidden bg-white p-10 rounded-2xl shadow-2xl border border-yellow-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <h3 class="text-3xl font-bold text-black">My Properties</h3>
                    <a href="<?php echo e(route('member.properties.create')); ?>" 
                    class="mt-4 md:mt-0 inline-flex items-center gap-2 bg-yellow-400 text-black font-semibold py-3 px-6 rounded-xl shadow-md hover:bg-yellow-500 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-plus"></i> Add New Property
                    </a>
                </div>

                <!-- List My Properties -->
                <div>
                    <h4 class="text-xl font-semibold text-black mb-6">My Listed Properties</h4>
                    <?php if($member->properties->count()): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            <?php $__currentLoopData = $member->properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white rounded-2xl border border-yellow-100 shadow-md hover:shadow-xl transition-transform transform hover:-translate-y-1 duration-300 overflow-hidden">
                                    
                                    <!-- Property Image -->
                                    <div class="relative w-full h-48 bg-yellow-50">
                                        <?php if($property->images->count()): ?>
                                            <img src="<?php echo e(asset('storage/' . $property->images->first()->file_path)); ?>" 
                                                alt="<?php echo e($property->title); ?>" 
                                                class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                <i class="fas fa-home text-5xl"></i>
                                            </div>
                                        <?php endif; ?>
                                        <span class="absolute top-3 left-3 bg-yellow-200 text-black font-semibold text-sm px-3 py-1 rounded-full shadow">
                                            Rs. <?php echo e(number_format($property->price)); ?>

                                        </span>
                                    </div>

                                    <!-- Property Content -->
                                    <div class="p-5 flex flex-col gap-3">
                                        <h5 class="text-lg font-bold text-black truncate"><?php echo e($property->title); ?></h5>
                                        <p class="text-gray-600 text-sm truncate">
                                            <?php echo e($property->city ?? ''); ?> <?php echo e($property->state ?? ''); ?>

                                        </p>
                                        <div class="flex items-center gap-4 text-gray-700 text-sm">
                                            <span class="flex items-center gap-1"><i class="fas fa-bed"></i> <?php echo e($property->bedrooms ?? 0); ?></span>
                                            <span class="flex items-center gap-1"><i class="fas fa-bath"></i> <?php echo e($property->bathrooms ?? 0); ?></span>
                                            <span class="flex items-center gap-1"><i class="fas fa-ruler-combined"></i> <?php echo e($property->area ?? 'N/A'); ?> sqft</span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="px-5 pb-5 flex justify-between items-center border-t border-yellow-100 pt-3">
                                        <a href="<?php echo e(route('member.properties.show', $property->slug)); ?>" 
                                        class="text-blue-600 hover:underline text-sm font-medium flex items-center gap-1">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        <a href="<?php echo e(route('member.properties.edit', $property->id)); ?>" 
                                        class="text-green-600 hover:underline text-sm font-medium flex items-center gap-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form method="POST" action="<?php echo e(route('member.properties.destroy', $property->id)); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Delete this property?')" 
                                                    class="text-red-600 hover:underline text-sm font-medium flex items-center gap-1">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <!-- Empty State -->
                        <div class="text-center py-20 bg-yellow-50 rounded-2xl border border-dashed border-yellow-300">
                            <i class="fas fa-home text-yellow-400 text-6xl mb-4"></i>
                            <p class="text-gray-700 text-lg font-medium mb-4">You don’t have any properties listed yet.</p>
                            <a href="<?php echo e(route('member.properties.create')); ?>" 
                            class="inline-block bg-yellow-400 text-black font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300">
                                + Add Your First Property
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>


            <!-- Agent Requests Section -->
            <section id="agent" class="section hidden bg-white p-8 rounded-lg shadow-xl border border-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-xl font-semibold text-black mb-4">Request an Agent</h3>

                <?php if($agents->count()): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-6 bg-yellow-50 rounded-xl shadow-md border border-yellow-200 flex flex-col justify-between">
                                <div class="mb-4">
                                    <h4 class="text-lg font-bold text-black"><?php echo e($agent->user->name); ?></h4>
                                    <p class="text-gray-600"><?php echo e($agent->agency_name ?? 'Independent Agent'); ?></p>
                                    <p class="text-gray-500 text-sm"><?php echo e($agent->phone); ?></p>

                                    <!-- Show status if request exists -->
                                    <?php
                                        $request = $requests->firstWhere('agent_id', $agent->id);
                                    ?>

                                    <?php if($request): ?>
                                        <p class="mt-2 text-sm font-semibold
                                            <?php if($request->status == 'pending'): ?> text-yellow-600
                                            <?php elseif($request->status == 'accepted'): ?> text-green-600
                                            <?php else: ?> text-red-600 <?php endif; ?>">
                                            Status: <?php echo e(ucfirst($request->status)); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>

                                <?php if(!$request): ?>
                                    <a href="<?php echo e(route('member.request-agent', $agent->id)); ?>"
                                        class="mt-auto inline-block text-center px-4 py-2 bg-yellow-400 text-black font-semibold rounded-lg shadow-md hover:bg-yellow-500 transition-all duration-300">
                                        Request Contact / Visit
                                    </a>
                                <?php else: ?>
                                    <button class="mt-auto px-4 py-2 bg-gray-300 text-black font-semibold rounded-lg cursor-not-allowed">
                                        Request Sent
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-10 bg-yellow-50 rounded-xl border border-dashed border-yellow-300">
                        <i class="fas fa-user-tie text-yellow-400 text-5xl mb-4"></i>
                        <p class="text-gray-700 text-lg">No agents available at the moment.</p>
                    </div>
                <?php endif; ?>
            </section>



            <!-- Purchase Section -->
            <section id="subscription" class="section hidden bg-white p-8 rounded-lg shadow-xl border border-yellow-100">
                <h3 class="text-2xl font-semibold text-black mb-6">Purchase Status</h3>

                <?php if($purchases->count()): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border border-yellow-200 rounded-xl p-4 shadow hover:shadow-lg transition-all">
                                <h4 class="font-bold text-lg"><?php echo e($purchase->property->title); ?></h4>
                                <p>Price: Rs. <?php echo e(number_format($purchase->price_at_purchase)); ?></p>
                                <p>Deposit: Rs. <?php echo e(number_format($purchase->deposit_amount)); ?> (<?php echo e($purchase->deposit_percent); ?>%)</p>
                                <p>Status: <span class="font-semibold text-blue-600"><?php echo e(ucfirst(str_replace('_', ' ', $purchase->status))); ?></span></p>
                                <p>Buyer: <?php echo e($purchase->buyer->user->name ?? $purchase->buyer->user->username); ?></p>
                                <p>Seller: <?php echo e($purchase->seller->user->name ?? $purchase->seller->user->username); ?></p>
                                
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <?php if(auth()->user()->member->id === $purchase->buyer_id): ?>
                                        <?php if($purchase->status === 'pending_payment'): ?>
                                            <form action="<?php echo e(route('member.purchases.confirm', $purchase)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Confirm Deposit</button>
                                            </form>
                                            <form action="<?php echo e(route('member.purchases.cancel', $purchase)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Cancel</button>
                                            </form>
                                        <?php elseif($purchase->status === 'deposit_paid'): ?>
                                            <form action="<?php echo e(route('member.purchases.markSettled', $purchase)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Mark as Settled</button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(auth()->user()->member->id === $purchase->seller_id): ?>
                                        <span class="px-4 py-2 bg-gray-200 rounded-lg">Seller view only</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-6">
                        <?php echo e($purchases->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="text-center py-20 bg-yellow-50 rounded-2xl border border-dashed border-yellow-300">
                        <i class="fas fa-shopping-cart text-yellow-400 text-6xl mb-4"></i>
                        <p class="text-gray-700 text-lg font-medium mb-4">No purchases yet.</p>
                    </div>
                <?php endif; ?>
            </section>

        </main>
    </div>

    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }
        // default section
        showSection('profile');
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\banda\OneDrive\Desktop\PropertEase\resources\views/member/dashboard.blade.php ENDPATH**/ ?>