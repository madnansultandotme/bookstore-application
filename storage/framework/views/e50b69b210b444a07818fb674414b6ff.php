

<?php $__env->startSection('title', 'Browse Books'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col md:flex-row gap-8">
    <!-- Filters Sidebar -->
    <div class="w-full md:w-1/4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
            <h5 class="font-bold text-lg mb-4 text-gray-900 flex items-center gap-2">
                <i class="fas fa-filter text-primary"></i> Filters
            </h5>
            <form action="<?php echo e(route('books.index')); ?>" method="GET">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" value="<?php echo e(request('search')); ?>" placeholder="Title or Author">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border">
                        <option value="">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                    <div class="flex gap-2">
                        <input type="number" name="min_price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" placeholder="Min" value="<?php echo e(request('min_price')); ?>" step="0.01">
                        <input type="number" name="max_price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" placeholder="Max" value="<?php echo e(request('max_price')); ?>" step="0.01">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200 font-medium">Apply Filters</button>
                <a href="<?php echo e(route('books.index')); ?>" class="block text-center w-full mt-3 text-sm text-gray-600 hover:text-gray-900 transition">Clear Filters</a>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Books Collection</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                    <div class="relative h-64 bg-gray-100 overflow-hidden">
                         <?php if($book->image): ?>
                            <img src="<?php echo e(asset('storage/' . $book->image)); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="<?php echo e($book->title); ?>">
                        <?php else: ?>
                             <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 group-hover:bg-gray-200 transition">
                                <i class="fas fa-book fa-3x"></i>
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-2 right-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo e($book->isInStock() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                <?php echo e($book->isInStock() ? 'In Stock' : 'Out of Stock'); ?>

                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="mb-2">
                            <span class="text-xs uppercase tracking-wider text-primary font-bold bg-indigo-50 px-2 py-1 rounded"><?php echo e($book->category->name); ?></span>
                        </div>
                        <h5 class="text-lg font-bold text-gray-900 mb-1 leading-tight group-hover:text-primary transition"><?php echo e($book->title); ?></h5>
                        <p class="text-sm text-gray-600 mb-3">by <span class="font-medium"><?php echo e($book->author); ?></span></p>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 flex-grow"><?php echo e($book->description); ?></p>
                        
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <span class="text-xl font-bold text-gray-900">$<?php echo e(number_format($book->price, 2)); ?></span>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('books.show', $book)); ?>" class="p-2 text-gray-400 hover:text-primary transition" title="View Details">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if($book->isInStock()): ?>
                                        <form action="<?php echo e(route('cart.add', $book)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="p-2 text-gray-400 hover:text-secondary transition" title="Add to Cart">
                                                <i class="fas fa-cart-plus text-lg"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full py-16 text-center text-gray-500 bg-white rounded-lg border border-dashed border-gray-300">
                    <i class="fas fa-search fa-3x mb-4 text-gray-300"></i>
                    <p class="text-lg font-medium">No books found matching your criteria.</p>
                    <a href="<?php echo e(route('books.index')); ?>" class="text-primary hover:underline mt-2 inline-block">Clear filters</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-8">
            <?php echo e($books->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/books/index.blade.php ENDPATH**/ ?>