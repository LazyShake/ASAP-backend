

<?php $__env->startSection('content'); ?>
<div class="profession-info">
    <h1><?php echo e($profession->name_profession); ?></h1>
    <p class="description"><?php echo e($profession->program); ?></p>

    <div class="details">
        <p><strong>Стоимость обучения:</strong> <?php echo e(number_format($profession->price, 2)); ?> руб.</p>
        <p><strong>Продолжительность:</strong> <?php echo e($profession->period ? $profession->period . ' дней' : 'Не указано'); ?></p>
        <p><strong>Дата ближайшего старта:</strong> <?php echo e(\Carbon\Carbon::parse($profession->start_of_training)->format('d.m.Y') ?? 'Не указано'); ?></p>
    </div>
</div>
<?php echo $__env->make('components.why-choose-us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.how-we-teach', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.mentors-by-profession', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.what-youll-learn', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.grades', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.program', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.feedback', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.articles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.progress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OSPanel\domains\asap-new-site-dev\back\resources\views/profession.blade.php ENDPATH**/ ?>