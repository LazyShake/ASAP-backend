<div class="progress-images">
    <?php $__currentLoopData = $progress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="pair">
            <div class="image-container">
                <img src="<?php echo e(asset($row->before)); ?>" alt="Изображение до" class="image">
                <p class="caption">До</p>
            </div>
            <div class="image-container">
                <img src="<?php echo e(asset($row->after)); ?>" alt="Изображение после" class="image">
                <p class="caption">После</p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php /**PATH D:\OSPanel\domains\asap-new-site-dev\back\resources\views/components/progress.blade.php ENDPATH**/ ?>