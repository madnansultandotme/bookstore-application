

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-900">Order #<?php echo e($order->id); ?></h2>
                <span class="text-sm text-gray-500"><?php echo e($order->created_at->format('M d, Y H:i')); ?></span>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Shipping Address</h4>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-md border border-gray-200 text-sm whitespace-pre-line"><?php echo e($order->shipping_address); ?></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Order Status</h4>
                        <?php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'shipped' => 'bg-indigo-100 text-indigo-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800'
                            ];
                            $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                        ?>
                        <div class="flex items-center">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full <?php echo e($statusClass); ?>">
                                <?php echo e(ucfirst($order->status)); ?>

                            </span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            Total Amount: <span class="font-bold text-green-600 text-lg ml-1">Rs <?php echo e(number_format($order->total_price, 2)); ?></span>
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            Payment Method: <span class="font-semibold text-gray-700">
                                <?php if($order->payment_method === 'cash_on_delivery'): ?>
                                    <i class="fas fa-money-bill-wave text-green-600"></i> Cash on Delivery
                                <?php else: ?>
                                    <i class="fas fa-credit-card text-blue-600"></i> Online Payment
                                <?php endif; ?>
                            </span>
                        </p>
                    </div>
                </div>

                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Order Items</h4>
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
                                        Rs <?php echo e(number_format($item->price, 2)); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo e($item->quantity); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rs <?php echo e(number_format($item->price * $item->quantity, 2)); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">Total:</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-gray-900">Rs <?php echo e(number_format($order->total_price, 2)); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="<?php echo e(route('orders.index')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 flex items-center transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Orders
                </a>
            </div>
        </div>
    </div>

    <!-- Order Timeline -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 sticky top-24">
            <h3 class="text-lg font-bold text-gray-900 mb-6 border-b pb-2">Order Status</h3>
            
            <div class="flow-root">
                <ul class="-mb-8">
                    <li>
                        <div class="relative pb-8">
                            <?php if(in_array($order->status, ['processing', 'shipped', 'delivered', 'cancelled'])): ?>
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <?php endif; ?>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-900 font-medium">Order Placed</p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        <time datetime="<?php echo e($order->created_at); ?>"><?php echo e($order->created_at->format('M d')); ?></time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <?php if(in_array($order->status, ['processing', 'shipped', 'delivered'])): ?>
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-cog text-white text-sm"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-900 font-medium">Processing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if(in_array($order->status, ['shipped', 'delivered'])): ?>
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-truck text-white text-sm"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-900 font-medium">Shipped</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if($order->status === 'delivered'): ?>
                    <li>
                        <div class="relative pb-8">
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-home text-white text-sm"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-900 font-medium">Delivered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if($order->status === 'cancelled'): ?>
                    <li>
                        <div class="relative pb-8">
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-times text-white text-sm"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-900 font-medium">Cancelled</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/orders/show.blade.php ENDPATH**/ ?>