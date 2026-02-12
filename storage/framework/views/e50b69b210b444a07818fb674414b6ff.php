

<?php $__env->startSection('title', 'Browse Books'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-3">
        <h5>Filters</h5>
        <form action="<?php echo e(route('books.index')); ?>" method="GET">
            <div class="mb-3">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" value="<?php echo e(request('search')); ?>" placeholder="Title or Author">
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Price Range</label>
                <div class="row">
                    <div class="col">
                        <input type="number" name="min_price" class="form-control" placeholder="Min" value="<?php echo e(request('min_price')); ?>" step="0.01">
                    </div>
                    <div class="col">
                        <input type="number" name="max_price" class="form-control" placeholder="Max" value="<?php echo e(request('max_price')); ?>" step="0.01">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            <a href="<?php echo e(route('books.index')); ?>" class="btn btn-secondary w-100 mt-2">Clear</a>
        </form>
    </div>

    <div class="col-md-9">
        <h2>Books</h2>
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($book->title); ?></h5>
                            <p class="card-text text-muted">by <?php echo e($book->author); ?></p>
                            <p class="card-text"><?php echo e(Str::limit($book->description, 100)); ?></p>
                            <p class="card-text"><strong>$<?php echo e(number_format($book->price, 2)); ?></strong></p>
                            <p class="card-text">
                                <small class="text-muted">Category: <?php echo e($book->category->name); ?></small>
                            </p>
                            <p class="card-text">
                                <small class="<?php echo e($book->isInStock() ? 'text-success' : 'text-danger'); ?>">
                                    <?php echo e($book->isInStock() ? 'In Stock' : 'Out of Stock'); ?>

                                </small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo e(route('books.show', $book)); ?>" class="btn btn-sm btn-info">View Details</a>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if($book->isInStock()): ?>
                                    <form action="<?php echo e(route('cart.add', $book)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <p class="text-center">No books found.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="d-flex justify-content-center">
            <?php echo e($books->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/books/index.blade.php ENDPATH**/ ?>