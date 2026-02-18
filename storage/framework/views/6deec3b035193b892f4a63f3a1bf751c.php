

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-900">Order #<?php echo e($order->id); ?> Details</h2>
            </div>
            
            <div class="p-6">
                <!-- Customer Info -->
                <div class="mb-8">
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Customer Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Name</p>
                            <p class="text-gray-900 font-medium"><?php echo e($order->user->name); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Email</p>
                            <p class="text-gray-900 font-medium"><?php echo e($order->user->email); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Phone</p>
                            <p class="text-gray-900 font-medium"><?php echo e($order->user->phone ?? 'N/A'); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Shipping Address</p>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-md border border-gray-200 text-sm whitespace-pre-line"><?php echo e($order->shipping_address); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Order Items</h4>
                    <div class="border rounded-md overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <?php if($item->book->image): ?>
                                                    <div class="flex-shrink-0 h-10 w-8">
                                                        <img class="h-10 w-8 object-cover rounded" src="<?php echo e(asset('storage/' . $item->book->image)); ?>" alt="">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo e($item->book->title); ?></div>
                                                    <div class="text-xs text-gray-500"><?php echo e($item->book->author); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            $<?php echo e(number_format($item->price, 2)); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo e($item->quantity); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            $<?php echo e(number_format($item->price * $item->quantity, 2)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">Total:</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-gray-900">$<?php echo e(number_format($order->total_price, 2)); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-6">
        <!-- Status Update -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h5 class="text-lg font-medium text-gray-900">Order Status</h5>
            </div>
            <div class="p-6">
                <form action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
                        <select id="status" name="status" required
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                            <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="processing" <?php echo e($order->status === 'processing' ? 'selected' : ''); ?>>Processing</option>
                            <option value="shipped" <?php echo e($order->status === 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                            <option value="delivered" <?php echo e($order->status === 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                            <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Meta Info -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h5 class="text-lg font-medium text-gray-900">Order Information</h5>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Order Date</p>
                    <p class="text-gray-900 font-medium"><?php echo e($order->created_at->format('M d, Y H:i')); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Last Updated</p>
                    <p class="text-gray-900 font-medium"><?php echo e($order->updated_at->format('M d, Y H:i')); ?></p>
                </div>
            </div>
        </div>
        
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="block w-full text-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
            Back to Orders
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>