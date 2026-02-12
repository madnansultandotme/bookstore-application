

<?php $__env->startSection('title', 'Shopping Cart'); ?>

<?php $__env->startSection('content'); ?>
<h2>Shopping Cart</h2>

<?php if($cartItems->isEmpty()): ?>
    <div class="alert alert-info">
        Your cart is empty. <a href="<?php echo e(route('books.index')); ?>">Browse books</a>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->book->title); ?></td>
                        <td><?php echo e($item->book->author); ?></td>
                        <td>$<?php echo e(number_format($item->book->price, 2)); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.update', $item)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" 
                                       min="1" max="<?php echo e($item->book->stock); ?>" class="form-control" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                            </form>
                        </td>
                        <td>$<?php echo e(number_format($item->book->price * $item->quantity, 2)); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.remove', $item)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>$<?php echo e(number_format($total, 2)); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-end">
        <a href="<?php echo e(route('books.index')); ?>" class="btn btn-secondary">Continue Shopping</a>
        <a href="<?php echo e(route('checkout')); ?>" class="btn btn-success">Proceed to Checkout</a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/cart/index.blade.php ENDPATH**/ ?>