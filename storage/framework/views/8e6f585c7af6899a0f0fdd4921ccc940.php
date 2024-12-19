<div class="block-what-awaits">
    <h2>Что вас ждет</h2>
    <p>
        Вы изучите все необходимые инструменты для UX/UI дизайнера и будете участвовать в реальном проекте. 
        Вас и нескольких учеников других профессий с потока определят в реальный проект, в ходе которого 
        вы разработаете продукт для реального заказчика.
    </p>
    <div class="skills-tags">
            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="tag"><?php echo e($skill); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</div>
<?php /**PATH D:\OSPanel\domains\asap-new-site-dev\back\resources\views/components/what-youll-learn.blade.php ENDPATH**/ ?>