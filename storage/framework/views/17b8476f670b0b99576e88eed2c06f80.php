

<?php $__env->startSection('title', $book->title); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Breadcrumb -->
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
        <nav class="flex text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-primary transition">Home</a>
                </li>
                <li><i class="fas fa-chevron-right text-xs text-gray-400"></i></li>
                <li>
                    <a href="<?php echo e(route('books.index')); ?>" class="hover:text-primary transition">Books</a>
                </li>
                <li><i class="fas fa-chevron-right text-xs text-gray-400"></i></li>
                <li aria-current="page">
                    <span class="text-gray-900 font-medium truncate max-w-xs block"><?php echo e($book->title); ?></span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="p-6 lg:p-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">
            <!-- Product Image -->
            <div class="relative">
                <div class="aspect-w-3 aspect-h-4 bg-gray-100 rounded-lg overflow-hidden shadow-inner">
                    <?php if($book->image): ?>
                        <img src="<?php echo e(asset('storage/' . $book->image)); ?>" class="w-full h-full object-cover object-center transform transition duration-500 hover:scale-105" alt="<?php echo e($book->title); ?>">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                            <i class="fas fa-book fa-9x text-gray-300"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="absolute top-4 left-4">
                     <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white text-gray-800 shadow-md">
                        <?php echo e($book->category->name); ?>

                    </span>
                </div>
            </div>

            <!-- Product Details -->
            <div class="flex flex-col h-full">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-2"><?php echo e($book->title); ?></h1>
                <p class="text-lg text-gray-600 mb-6">by <span class="font-semibold text-gray-800"><?php echo e($book->author); ?></span></p>

                <div class="flex items-center mb-6">
                    <span class="text-3xl font-bold text-primary mr-4">$<?php echo e(number_format($book->price, 2)); ?></span>
                    
                    <?php if($book->isInStock()): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1.5"></i> In Stock (<?php echo e($book->stock); ?> available)
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1.5"></i> Out of Stock
                        </span>
                    <?php endif; ?>
                </div>

                <div class="border-t border-b border-gray-100 py-6 mb-6">
                    <div class="prose prose-sm text-gray-600 max-w-none">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Description</h3>
                        <p><?php echo e($book->description ?? 'No description available.'); ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-gray-600 mb-8">
                    <?php if($book->isbn): ?>
                        <div class="font-medium">ISBN:</div>
                        <div><?php echo e($book->isbn); ?></div>
                    <?php endif; ?>
                    <div class="font-medium">Category:</div>
                    <div><?php echo e($book->category->name); ?></div>
                </div>

                <div class="mt-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($book->isInStock()): ?>
                            <form action="<?php echo e(route('cart.add', $book)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-indigo-700 md:py-4 md:text-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                </button>
                            </form>
                        <?php else: ?>
                            <button type="button" disabled class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed md:py-4 md:text-lg">
                                <i class="fas fa-ban mr-2"></i> Currently Unavailable
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900 md:py-4 md:text-lg shadow transition">
                            <i class="fas fa-lock mr-2"></i> Login to Purchase
                        </a>
                    <?php endif; ?>
                    
                    <a href="<?php echo e(route('books.index')); ?>" class="block text-center mt-4 text-sm text-gray-500 hover:text-gray-900 transition">
                        &larr; Back to all books
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-12">
    <h3 class="text-2xl font-bold text-gray-900 mb-6">Related Books</h3>
    <div class="bg-indigo-50 rounded-xl p-8 text-center border border-indigo-100">
        <p class="text-indigo-800 mb-4">Want to see more books in <span class="font-bold"><?php echo e($book->category->name); ?></span>?</p>
        <a href="<?php echo e(route('books.index', ['category' => $book->category_id])); ?>" class="inline-flex items-center px-4 py-2 border border-indigo-600 rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
            Browse <?php echo e($book->category->name); ?>

        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/books/show.blade.php ENDPATH**/ ?>