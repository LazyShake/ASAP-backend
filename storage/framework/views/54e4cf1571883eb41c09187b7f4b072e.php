<?php if($articles->isNotEmpty()): ?>
    <h3>Кейсы по этой профессии:</h3>
    <ul>
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <h4><?php echo e($article->name_article); ?></h4>
                        <p><?php echo e($article->text); ?></p>
                        <?php if($article->picture): ?>
                            <img src="<?php echo e(asset($article->picture)); ?>" alt="Image for <?php echo e($article->name_article); ?>" width="200">
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
<?php else: ?>
    <p>Нет кейсов для этой профессии.</p>
<?php endif; ?><?php /**PATH D:\OSPanel\domains\asap-new-site-dev\back\resources\views/components/articles.blade.php ENDPATH**/ ?>