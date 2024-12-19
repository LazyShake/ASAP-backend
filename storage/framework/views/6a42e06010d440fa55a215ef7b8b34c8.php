<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'My Application'); ?></title>

    <!-- Подключение CSS (например, через Vite или напрямую) -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
</head>
<body>
    <!-- Шапка сайта -->
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Основной контент -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Футер сайта -->
    <footer>
        <p>&copy; <?php echo e(date('Y')); ?> My Application. All rights reserved.</p>
    </footer>
</body>
</html>
<?php /**PATH D:\OSPanel\domains\asap-new-site-dev\back\resources\views/layouts/app.blade.php ENDPATH**/ ?>