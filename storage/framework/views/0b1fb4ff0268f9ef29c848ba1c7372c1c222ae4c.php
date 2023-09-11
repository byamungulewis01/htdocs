<div class="card invoice-preview-card mb-1">
    <div class="card-body">
        <div
            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">

            <div>
                <h4> Attendence</h4>
                <p>Please Add all Advocates who succesffully completed <strong>
                        <?php echo e($training->title); ?></strong></p>
                <a href="" data-bs-toggle="modal" data-bs-target="#Addpart" class="btn btn-sm btn-success"><i class="ti ti-user ti-sm me-2"></i>Add
                    Participants</a>
                    <?php if(Request::routeIs('trainings.manage')): ?>
                        
                    <?php else: ?>
                    <a href="<?php echo e(route('trainings.manage' ,$training->id)); ?>" class="btn btn-sm btn-info"><i class="ti ti-edit ti-sm me-2"></i>Participants</a>
                    <?php endif; ?>
            
            </div>

        </div>


    </div>
    <hr class="my-0" />


</div>
<div class="card invoice-preview-card">
    <div class="card-body">
        <div
            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">

            <div>
                <h4>Attendence List </h4>
              <?php if($training->endon < now()->format('Y-m-d')): ?>
              <p>Please choose Training Day to generate eAttendance List for <strong>
                <?php echo e($training->title); ?></strong></p>
                <?php if(Request::routeIs('trainings.manage')): ?>
                <a href="" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#generate"><i class="ti ti-settings ti-sm me-2"></i>Generate</a>
                    <?php if($bookings_count == 0): ?>
                    <?php else: ?>
                        <?php if($booking->voucherNumber != null): ?>
                        <a href="<?php echo e(route('trainings.voucher', $booking->training)); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="ti ti-prints ti-sm me-2"></i>Create list</a>
                        <?php endif; ?>       
                    <?php endif; ?>
                <?php endif; ?> 
              <?php else: ?>
                  <p>Training will be Ended on <strong><?php echo e($training->endon); ?></strong></p>
              <?php endif; ?>
              

            </div>

        </div>
    </div>
    <hr class="my-0" />
</div>

<div class="modal fade" id="generate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Genarate Vouchers</h3>
                </div>
                <form method="POST" class="row g-3" action="<?php echo e(route('trainings.generateVouchers')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($training->id); ?>">
                    <input type="hidden" name="credits" value="<?php echo e($training->credits); ?>">
                    <div class="col-12">
                        <label for="title" class="form-label">Attendance Day</label>
                        <input required type="text" name="attendanceDay" class="form-control" id="attendanceDay" placeholder="Month DD, YYYY">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Genarate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Addpart" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Add Advocate to Training </h3>
                </div>
                <form method="POST" class="row g-3" action="<?php echo e(route('trainings.addParticipant')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-12">
                        <input type="hidden" name="id" value="<?php echo e($training->id); ?>">
                        <input type="hidden" name="endon" value="<?php echo e($training->endon); ?>">
                        <input type="hidden" name="credit" value="<?php echo e($training->credits); ?>">
                        <select required row="4" name="user[]" multiple class="select2 form-select" id="exampleFormControlSelect2"
                            aria-label="Multiple select example">
                            <option value="">Select Advocates</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/form-wizard-numbered.js')); ?>"></script>

<script>
 

    $(function () {
    var dtt = document.querySelector("#startAt");
    dtt && dtt.flatpickr({
        enableTime: true,
        altInput: !0,
        noCalendar: true,
        dateFormat: "H:i",
    })
});
    $(function () {
    var dtt = document.querySelector("#endAt");
    dtt && dtt.flatpickr({
        enableTime: true,
        altInput: !0,
        noCalendar: true,
        dateFormat: "H:i",
    })
});
    $(function () {
    var dtt = document.querySelector("#attendanceDay");
    dtt && dtt.flatpickr({
        enableTime: false,
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: 'today'
    })
});
$(function () {
        var dtt = document.querySelector("#starton");
        dtt && dtt.flatpickr({
            enableTime: false,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: 'today'
        })
    });
    $(function () {
        var dtt = document.querySelector("#endon");
        dtt && dtt.flatpickr({
            enableTime: false,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: 'today'
        })
    });
    $(function () {
        var dtt = document.querySelector("#early_deadline");
        dtt && dtt.flatpickr({
            enableTime: false,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        })
    });
    $(function () {
        var dtt = document.querySelector("#late_deadline");
        dtt && dtt.flatpickr({
            enableTime: !0,
            altInput: !0,
            altFormat: "F j, Y H:i",
            dateFormat: "Y-m-d H:i",
        })
    });


    $(document).ready(function () {
        $("#credit").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#price").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#price").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#seats").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#rate").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });

  
    
</script>


<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\resources\views/training/extra.blade.php ENDPATH**/ ?>