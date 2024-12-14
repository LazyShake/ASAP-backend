<div class="container mt-5">
    <h1>Программа курса для профессии <?php echo e($profession->name_profession); ?></h1>

    <?php if($programs->isEmpty()): ?>
        <p>Программа для данной профессии отсутствует.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Название модуля</th>
                    <th>Тип программы</th>
                    <th>Содержание модуля</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($program->number_module); ?></td>
                    <td><?php echo e($program->name_module); ?></td>
                    <td><?php echo e($program->type_program); ?></td>
                    <td><?php echo e($program->content_module); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div><?php /**PATH D:\OSPanel\domains\asap-new-site-dev-main\back\resources\views/components/program.blade.php ENDPATH**/ ?>