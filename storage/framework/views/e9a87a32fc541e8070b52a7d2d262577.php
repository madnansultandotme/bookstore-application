

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <h2>Order #<?php echo e($order->id); ?></h2>
        
        <div class="card mb-3">
            <div class="card-header">
                <h5>Order Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Order Date:</strong> <?php echo e($order->created_at->format('M d, Y H:i')); ?></p>
                        <p><strong>Status:</strong> 
                            <?php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger'
                                ];
                            ?>
                            <span class="badge bg-<?php echo e($statusColors[$order->status] ?? 'secondary'); ?>">
                                <?php echo e(ucfirst($order->status)); ?>

                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Amount:</strong> <span class="text-success">$<?php echo e(number_format($order->total_price, 2)); ?></span></p>
                    </div>
                </div>
                <div class="mt-3">
                    <p><strong>Shipping Address:</strong></p>
                    <p><?php echo e($order->shipping_address); ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Order Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->book->title); ?></td>
                                    <td><?php echo e($item->book->author); ?></td>
                                    <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td>$<?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong>$<?php echo e(number_format($order->total_price, 2)); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Order Status</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="mb-3">
                        <i class="fas fa-check-circle text-success"></i>
                        <strong>Order Placed</strong>
                        <p class="text-muted small"><?php echo e($order->created_at->format('M d, Y H:i')); ?></p>
                    </div>
                    
                    <?php if(in_array($order->status, ['processing', 'shipped', 'delivered'])): ?>
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Processing</strong>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(in_array($order->status, ['shipped', 'delivered'])): ?>
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Shipped</strong>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($order->status === 'delivered'): ?>
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Delivered</strong>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($order->status === 'cancelled'): ?>
                        <div class="mb-3">
                            <i class="fas fa-times-circle text-danger"></i>
                            <strong>Cancelled</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/orders/show.blade.php ENDPATH**/ ?>