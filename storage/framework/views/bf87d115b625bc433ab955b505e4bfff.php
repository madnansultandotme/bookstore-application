

<?php $__env->startSection('title', 'Welcome to BookStore'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="bg-primary rounded-lg shadow-lg overflow-hidden mb-12">
    <div class="px-6 py-16 sm:px-12 sm:py-20 lg:flex lg:items-center lg:justify-between">
        <div class="lg:w-1/2">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                <span class="block">Welcome to</span>
                <span class="block mt-2">Pakistan's BookStore</span>
            </h1>
            <p class="mt-6 text-xl text-white opacity-90 max-w-2xl">
                Discover thousands of books at amazing prices. From bestsellers to hidden gems, find your next great read today!
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="<?php echo e(route('books.index')); ?>" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-100 shadow-lg transition">
                    Browse Books
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="<?php echo e(route('contact')); ?>" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-medium rounded-md text-white hover:bg-white hover:text-primary transition">
                    Contact Us
                </a>
            </div>
        </div>
        <div class="mt-12 lg:mt-0 lg:w-1/2 lg:pl-12">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&h=600&fit=crop" 
                     alt="Books Collection" 
                     class="rounded-lg shadow-2xl w-full h-auto object-cover"
                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22800%22 height=%22600%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22800%22 height=%22600%22/%3E%3Ctext fill=%22%239ca3af%22 font-family=%22sans-serif%22 font-size=%2248%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3EBooks%3C/text%3E%3C/svg%3E';">
            </div>
        </div>
    </div>
</div>

<!-- Featured Books -->
<div class="mb-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Featured Books</h2>
            <p class="text-gray-600 mt-1">Discover our handpicked selection</p>
        </div>
        <a href="<?php echo e(route('books.index')); ?>" class="text-primary hover:text-indigo-700 font-medium transition flex items-center">
            View All <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $featuredBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            In Stock
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
                        <span class="text-xl font-bold text-gray-900">Rs <?php echo e(number_format($book->price, 2)); ?></span>
                        <div class="flex gap-2">
                            <a href="<?php echo e(route('books.show', $book)); ?>" class="p-2 text-gray-400 hover:text-primary transition" title="View Details">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <?php if(auth()->guard()->check()): ?>
                                <form action="<?php echo e(route('cart.add', $book)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="p-2 text-gray-400 hover:text-secondary transition" title="Add to Cart">
                                        <i class="fas fa-cart-plus text-lg"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full py-16 text-center text-gray-500">
                <i class="fas fa-book fa-3x mb-4 text-gray-300"></i>
                <p class="text-lg font-medium">No books available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Categories Section -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-16">
    <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">Browse by Category</h2>
    <p class="text-gray-600 text-center mb-8">Explore our wide range of book categories</p>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('books.index', ['category' => $category->id])); ?>" class="group bg-gray-50 rounded-lg p-6 text-center hover:bg-primary hover:shadow-lg transition-all duration-300 border border-gray-200">
                <i class="fas fa-book text-3xl text-primary group-hover:text-white mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-bold text-gray-900 group-hover:text-white transition"><?php echo e($category->name); ?></h3>
                <p class="text-sm text-gray-500 group-hover:text-white group-hover:opacity-90 mt-1 transition"><?php echo e($category->books_count); ?> books</p>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-gray-50 rounded-lg border border-gray-200 p-8 mb-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="p-4">
            <div class="text-4xl font-bold text-primary mb-2">1000+</div>
            <div class="text-gray-600 font-medium">Books Available</div>
        </div>
        <div class="p-4">
            <div class="text-4xl font-bold text-primary mb-2">500+</div>
            <div class="text-gray-600 font-medium">Happy Customers</div>
        </div>
        <div class="p-4">
            <div class="text-4xl font-bold text-primary mb-2">50+</div>
            <div class="text-gray-600 font-medium">Cities Covered</div>
        </div>
        <div class="p-4">
            <div class="text-4xl font-bold text-primary mb-2">24/7</div>
            <div class="text-gray-600 font-medium">Customer Support</div>
        </div>
    </div>
</div>

<!-- Promotional Banner -->
<div class="bg-primary rounded-lg shadow-lg overflow-hidden mb-16">
    <div class="px-6 py-12 sm:px-12 lg:flex lg:items-center lg:justify-between">
        <div class="lg:w-2/3">
            <h2 class="text-3xl font-bold text-white mb-4">Special Offer!</h2>
            <p class="text-xl text-white opacity-90 mb-6">
                Get free delivery on orders above Rs 2,000. Limited time offer!
            </p>
            <a href="<?php echo e(route('books.index')); ?>" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-base font-medium rounded-md text-white hover:bg-white hover:text-primary transition">
                Shop Now
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="mt-8 lg:mt-0 lg:w-1/3 flex justify-center">
            <div class="relative">
                <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-gift text-white text-6xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="mb-16">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Why Choose BookStore</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
            <div class="mb-4">
                <img src="https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?w=400&h=250&fit=crop" 
                     alt="Fast Delivery" 
                     class="w-full h-40 object-cover rounded-lg"
                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22250%22%3E%3Crect fill=%22%234F46E5%22 width=%22400%22 height=%22250%22/%3E%3Ctext fill=%22white%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3EDelivery%3C/text%3E%3C/svg%3E';">
            </div>
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-shipping-fast text-xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Fast Delivery</h3>
            </div>
            <p class="text-gray-600">Quick and reliable delivery service across all major cities in Pakistan</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
            <div class="mb-4">
                <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=250&fit=crop" 
                     alt="Secure Payment" 
                     class="w-full h-40 object-cover rounded-lg"
                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22250%22%3E%3Crect fill=%22%234F46E5%22 width=%22400%22 height=%22250%22/%3E%3Ctext fill=%22white%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3ESecure%3C/text%3E%3C/svg%3E';">
            </div>
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-shield-alt text-xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Cash on Delivery</h3>
            </div>
            <p class="text-gray-600">Pay when you receive your order. Safe and secure transactions guaranteed</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
            <div class="mb-4">
                <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=400&h=250&fit=crop" 
                     alt="24/7 Support" 
                     class="w-full h-40 object-cover rounded-lg"
                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22250%22%3E%3Crect fill=%22%234F46E5%22 width=%22400%22 height=%22250%22/%3E%3Ctext fill=%22white%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3ESupport%3C/text%3E%3C/svg%3E';">
            </div>
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-headset text-xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">24/7 Support</h3>
            </div>
            <p class="text-gray-600">Our dedicated customer support team is always ready to help you</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\adnan\Downloads\bookstore-application\resources\views/home.blade.php ENDPATH**/ ?>