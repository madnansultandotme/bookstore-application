

<?php $__env->startSection('title', $book->title); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('books.index')); ?>">Books</a></li>
                <li class="breadcrumb-item active"><?php echo e($book->title); ?></li>
            </ol>
        </nav>

        <div class="card">
            <?php if($book->image): ?>
                <img src="<?php echo e(asset('storage/' . $book->image)); ?>" class="card-img-top" alt="<?php echo e($book->title); ?>">
            <?php else: ?>
                <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="fas fa-book fa-5x"></i>
                </div>
            <?php endif; ?>
            
            <div class="card-body">
                <h1 class="card-title"><?php echo e($book->title); ?></h1>
                <h5 class="text-muted mb-3">by <?php echo e($book->author); ?></h5>
                
                <div class="mb-3">
                    <span class="badge bg-primary"><?php echo e($book->category->name); ?></span>
                    <?php if($book->isbn): ?>
                        <span class="badge bg-secondary">ISBN: <?php echo e($book->isbn); ?></span>
                    <?php endif; ?>
                </div>

                <h3 class="text-success mb-3">$<?php echo e(number_format($book->price, 2)); ?></h3>

                <div class="mb-3">
                    <?php if($book->isInStock()): ?>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle"></i> In Stock (<?php echo e($book->stock); ?> available)
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger">
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </span>
                    <?php endif; ?>
                </div>

                <?php if($book->description): ?>
                    <h5 class="mt-4">Description</h5>
                    <p class="card-text"><?php echo e($book->description); ?></p>
                <?php endif; ?>

                <div class="mt-4">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($book->isInStock()): ?>
                            <form action="<?php echo e(route('cart.add', $book)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="fas fa-ban"></i> Out of Stock
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Login to Purchase
                        </a>
                    <?php endif; ?>
                    
                    <a href="<?php echo e(route('books.index')); ?>" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Back to Books
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Book Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Author:</th>
                        <td><?php echo e($book->author); ?></td>
                    </tr>
                    <tr>
                        <th>Category:</th>
                        <td><?php echo e($book->category->name); ?></td>
                    </tr>
                    <tr>
                        <th>Price:</th>
                        <td class="text-success">$<?php echo e(number_format($book->price, 2)); ?></td>
                    </tr>
                    <?php if($book->isbn): ?>
                    <tr>
                        <th>ISBN:</th>
                        <td><?php echo e($book->isbn); ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>Availability:</th>
                        <td>
                            <?php if($book->isInStock()): ?>
                                <span class="text-success">In Stock</span>
                            <?php else: ?>
                                <span class="text-danger">Out of Stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">More from <?php echo e($book->category->name); ?></h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    <a href="<?php echo e(route('books.index', ['category' => $book->category_id])); ?>">
                        Browse more <?php echo e($book->category->name); ?> books
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/books/show.blade.php ENDPATH**/ ?>