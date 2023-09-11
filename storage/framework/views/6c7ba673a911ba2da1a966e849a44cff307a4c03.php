
<?php if(session()->has('message')): ?>
<script>
$(document).ready(function() {
    $.toast({
        heading: 'Success',
        text: '<?php echo e(session()->get('message')); ?>',
        showHideTransition: 'fade',
        icon: 'success',
        position : 'top-right' 
    });
});
</script>
<?php endif; ?>
<?php if(session()->has('warning')): ?>
<script>
$(document).ready(function() {
    $.toast({
        heading: 'Message',
        text: '<?php echo e(session()->get('warning')); ?>',
        showHideTransition: 'fade',
        icon: 'warning',
        position : 'top-right' 
    });
});
</script>
<?php endif; ?>
<?php if(session()->has('error')): ?>
<script>
$(document).ready(function() {
    $.toast({
        heading: 'Error',
        text: '<?php echo e(session()->get('error')); ?>',
        showHideTransition: 'fade',
        icon: 'error',
        position : 'top-right' 
    });
});
</script>
<?php endif; ?>

           <?php if($errors->any()): ?>
           <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php
               $data = 'Error Accurs';
           ?>
           <script>
            $(document).ready(function() {
                $.toast({
                    heading: 'Error',
                    text:'<?php echo e($error); ?>' ,
                    showHideTransition: 'fade',
                    icon: 'error',
                    position : 'top-right',
                    hideAfter: 5000,
                });
            });
            </script>
            <?php endif; ?> 
                    

<?php /**PATH C:\xampp\htdocs\resources\views/layouts/flash_message.blade.php ENDPATH**/ ?>