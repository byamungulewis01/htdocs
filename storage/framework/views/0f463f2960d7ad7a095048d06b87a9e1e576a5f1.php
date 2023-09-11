

<?php $__env->startSection('page_name'); ?>
Notify
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- User Content -->
        <div class="col-xl-7 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- Current Plan -->
            <div class="card mb-4">
                <h5 class="card-header">Send Notifications</h5>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                      <p><strong>Opps Something went wrong</strong></p>
                      <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>* <?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('send_notify')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlTextarea1" class="form-label">
                                    <h6>Recipients Users</h6>
                                </label>

                                <div class="form-check">
                                    <input class="form-check-input" name="recipient[]" type="checkbox" value="2"
                                        id="Active" />
                                    <label class="form-check-label" for="Active">Active
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="recipient[]" type="checkbox" value="3"
                                        id="Inactive" />
                                    <label class="form-check-label" for="Inactive">Inactive
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="recipient[]" type="checkbox" value="4"
                                        id="Suspendend" />
                                    <label class="form-check-label" for="Suspendend">Suspendend
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="recipient[]" type="checkbox" value="5"
                                        id="Struck" />
                                    <label class="form-check-label" for="Struck">Struck off
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="exampleFormControlTextarea1" class="form-label">
                                    <h6>Category</h6>
                                </label>

                                <div class="form-check">
                                    <input class="form-check-input" name="category[]" type="checkbox" value="1"
                                        id="Advocates" />
                                    <label class="form-check-label" for="Advocates">Advocates
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="category[]" type="checkbox" value="2"
                                        id="InternAdvocates" />
                                    <label class="form-check-label" for="InternAdvocates">Intern Advocates
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="category[]" type="checkbox" value="3"
                                        id="echnicalStaff" />
                                    <label class="form-check-label" for="echnicalStaff">Technical Staff
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="category[]" type="checkbox" value="4"
                                        id="SupportStaff" />
                                    <label class="form-check-label" for="SupportStaff">Support Staff
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mb-2 mt-3">
                                <label class="switch">
                                    <span class="switch-label">Subject <span class="text-danger">include in Email
                                            only</span></span>
                                </label>
                                <input type="text" name="subject" value="<?php echo e(old('subject')); ?>" class="form-control" id="subject">

                            </div>
                            <div class="col-12 mb-4">
                                <label for="summernote" class="form-label">Message</label>
                                <textarea required name="message" class="form-control" id="summernote" rows="6"><?php echo e(old('message')); ?></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="switch mb-2">
                                  <span class="switch-label text-warning">Attache files (5 Max):</span>
                                </label>
      
                                <input type="file" name="attachments[]" class="form-control" placeholder="Files" multiple
                                  max="5">
                              </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="sent[]" type="checkbox" value="SMS"
                                        id="defaultCheck3" />
                                    <label class="form-check-label" for="defaultCheck3">SMS (Uncheck if "NO")
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" checked name="sent[]" type="checkbox" value="EMAIL"
                                        id="defaultCheck4" />
                                    <label class="form-check-label" for="defaultCheck4">EMAIL (Uncheck if "NO")
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Send
                                    notify</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Current Plan -->

            </div>
            <!--/ User Content -->
        </div>
        
    </div>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/notify.blade.php ENDPATH**/ ?>