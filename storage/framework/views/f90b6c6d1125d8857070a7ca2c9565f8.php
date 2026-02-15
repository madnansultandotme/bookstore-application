

<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Shipping Details -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h5 class="text-lg font-medium text-gray-900">Shipping Information</h5>
                </div>
                <div class="p-6">
                    <form action="<?php echo e(route('orders.store')); ?>" method="POST" id="checkout-form">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-6">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                            <textarea id="shipping_address" name="shipping_address" rows="4" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('shipping_address', auth()->user()->address)); ?></textarea>
                            <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="mt-2 text-sm text-gray-500">Please provide your complete shipping address including zip code.</p>
                        </div>

                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Note:</strong> This is a demo application. No actual payment will be processed.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="<?php echo e(route('cart.index')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Cart
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition shadow-lg transform hover:-translate-y-0.5">
                                <i class="fas fa-check mr-2"></i> Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-24">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h5 class="text-lg font-medium text-gray-900">Order Summary</h5>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-4">Items in Cart: <span class="font-medium text-gray-900"><?php echo e($cartItems->count()); ?></span></p>
                    
                    <div class="flow-root mb-6">
                        <ul class="divide-y divide-gray-200 -my-4">
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-4 flex text-sm">
                                    <div class="flex-grow">
                                        <p class="font-medium text-gray-900"><?php echo e($item->book->title); ?></p>
                                        <p class="text-gray-500">x<?php echo e($item->quantity); ?></p>
                                    </div>
                                    <div class="text-right font-medium text-gray-900">
                                        $<?php echo e(number_format($item->book->price * $item->quantity, 2)); ?>

                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex justify-between text-base font-bold text-gray-900">
                            <p>Total</p>
                            <p>$<?php echo e(number_format($cart->getTotalPrice(), 2)); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-shield-alt text-green-500 mr-2 text-lg"></i>
                        <span>Secure Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/orders/checkout.blade.php ENDPATH**/ ?>