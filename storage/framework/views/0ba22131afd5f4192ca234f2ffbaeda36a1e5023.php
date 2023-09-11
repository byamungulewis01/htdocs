<?php $__env->startComponent('mail::message'); ?>
# Welcome to <?php echo e(config('app.name')); ?>


Your new RBA MIS account have been created, credential are:

Email: <?php echo e($email); ?> <br>
Password: <?php echo e($password); ?>


<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\bar\resources\views/emails/newAccount.blade.php ENDPATH**/ ?>