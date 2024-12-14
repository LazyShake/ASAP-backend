<div class="container">
        <h1>Менторы для профессии: <?php echo e($profession->name_profession); ?></h1>

        <div class="mentor-list">
            <?php $__currentLoopData = $mentors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mentor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mentor-card">
                    <img src="<?php echo e($mentor->picture); ?>" alt="<?php echo e($mentor->name_mentors); ?>" class="mentor-picture">
                    <div class="mentor-info">
                        <h3><?php echo e($mentor->name_mentors); ?></h3>
                        <p><strong>Роль:</strong> <?php echo e($mentor->role ?? 'Не указана'); ?></p>
                        <p><strong>Описание:</strong> <?php echo e($mentor->description ?? 'Нет описания'); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Список трекеров -->
        <h2>Трекеры</h2>
        <div class="tracker-list">
            <?php $__currentLoopData = $trackers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mentor-card">
                    <img src="<?php echo e($tracker->picture); ?>" alt="<?php echo e($tracker->name_mentors); ?>" class="mentor-picture">
                    <div class="mentor-info">
                        <h3><?php echo e($tracker->name_mentors); ?></h3>
                        <p><strong>Роль:</strong> <?php echo e($tracker->role ?? 'Не указана'); ?></p>
                        <p><strong>Описание:</strong> <?php echo e($tracker->description ?? 'Нет описания'); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
    </div><?php /**PATH D:\OSPanel\domains\asap-new-site-dev-main\back\resources\views/components/mentors-by-profession.blade.php ENDPATH**/ ?>