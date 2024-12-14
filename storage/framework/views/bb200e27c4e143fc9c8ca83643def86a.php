

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2>Форма обратной связи</h2>
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

    <form action="<?php echo e(route('feedback.submit')); ?>" method="POST">
    <?php echo csrf_field(); ?> <!-- Токен безопасности для защиты от CSRF-атак -->
    <div class="form-group">
        <label for="name">Ваше имя</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Ваш Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="message">Сообщение</label>
        <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-success mt-3">Отправить</button>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OSPanel\domains\asap-new-site-dev-main\back\resources\views/feedback-form.blade.php ENDPATH**/ ?>