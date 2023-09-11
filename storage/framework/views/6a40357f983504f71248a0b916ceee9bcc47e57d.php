

<?php $__env->startSection('page_name'); ?>
Disciplinary Cases
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">



    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Disciplinary Cases
                <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                    data-bs-target="#twoFactorAuth">
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                    <span class="d-none d-sm-inline-block">New Case</span></a>
                    
                    <a class="btn btn-dark text-white pull-left float-end" href="<?php echo e(route('cases.exportExcel')); ?>"><i class="ti ti-file me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Export</span></a>
                </h5>

            <!-- Two Factor Auth Modal -->

            <div class="modal fade" id="twoFactorAuth" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">New Discipline case</h3>
                                <p class="text-muted">You also need to select one of three choise meeting to case
                                    Category</p>
                            </div>
                            <div class="form-check custom-option custom-option-basic mb-3">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp1"
                                    data-bs-target="#twoFactorAuthOne" data-bs-toggle="modal">
                                    <input name="customRadioTemp" class="form-check-input d-none" type="radio" value=""
                                        id="customRadioTemp1" />
                                    <div class="d-flex align-items-start">
                                        <i class="ti ti-message ti-xl me-3"></i>
                                        <div>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">(Layman Or Institution) => (Advocate)</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <p class="mb-0">Plaintiff is a Layman Or Institution => Defendant is an
                                                    Advocate</p>
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check custom-option custom-option-basic mb-3">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp2"
                                    data-bs-target="#twoFactorAuthTwo" data-bs-toggle="modal">
                                    <input name="customRadioTemp" class="form-check-input d-none" type="radio" value=""
                                        id="customRadioTemp2" />
                                    <div class="d-flex align-items-start">
                                        <i class="ti ti-message ti-xl me-3"></i>
                                        <div>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">(Advocate) => (Layman Or Institution)</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <p class="mb-0">Plaintiff is an Advocate => Defendant is a Layman Or
                                                    Institution</p>
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp3"
                                    data-bs-target="#twoFactorAuthThree" data-bs-toggle="modal">
                                    <input name="customRadioTemp" class="form-check-input d-none" type="radio" value=""
                                        id="customRadioTemp3" />
                                    <div class="d-flex align-items-start">
                                        <i class="ti ti-message ti-xl me-3"></i>
                                        <div>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">(Advocate) => (Advocate)</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <p class="mb-0">Plaintiff is an Advocate and Defendant is an Advocate .
                                                </p>
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Authentication App -->
            <div class="modal fade" id="twoFactorAuthOne" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Add New Case</h3>
                                <p class="text-muted">Add new Discipline Case by compliting Each field bellow</p>
                            </div>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Layman Or Institution Plaintiff</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>
                                    <div class="input-group input-group-merge">
                                        <input pattern="[A-Za-z0-9 ]{6,}" title="Name Must have at least 6 characters" name="name" value="<?php echo e(old('name')); ?>"
                                          required  class="form-control credit-card-mask" type="text" placeholder="John Doe" />
                                        <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                                class="card-type"></span></span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="modalAddCardExpiryDate">Email</label>
                                    <input type="email" id="modalAddCardExpiryDate" name="email"
                                        value="<?php echo e(old('email')); ?>" class="form-control expiry-date-mask"
                                        placeholder="johndoe@gmail.com" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddCardName">Mobile Number</label>
                                    <input name="phone" pattern="[0-9]{10}" maxlength="10"
                                        value="<?php echo e(old('phone')); ?>" class="form-control" placeholder="XXX-XXX-XXXX" />
                                </div>

                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate defendant</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>
                                        <select required name="advocate" class="select2 form-select">
                                            <option value="" selected> - Select - </option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(old('advocate')==$user->name): ?> selected <?php endif; ?>
                                                value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">Complaint</label>
                                    <input required type="text"
                                        value="<?php echo e(old('complaint')); ?>" name="complaint" class="form-control"
                                        placeholder="Subject here" />
                                    <input type="hidden" name="case_type" value="1" />
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Case Sammary</label>
                                    <textarea required name="sammary" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Authentication via SMS -->
            <div class="modal fade" id="twoFactorAuthTwo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Add New Case</h3>
                                <p class="text-muted">Add new Discipline Case by compliting Each field bellow</p>
                            </div>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate Plaintiff</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Advocate name</label>
                                        <select required name="advocate" class="select2 form-select">
                                            <option value="" selected> - Select - </option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(old('user')==$user->name): ?> selected <?php endif; ?>
                                                value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                </div>
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label"> Layman Or Institution defendant</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>
                                    <div class="input-group input-group-merge">
                                        <input pattern="[A-Za-z0-9 ]{6,}" title="Name Must have at least 6 characters"
                                         name="name" value="<?php echo e(old('name')); ?>" required
                                            class="form-control credit-card-mask" type="text" placeholder="John Doe" />
                                        <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                                class="card-type"></span></span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="modalAddCardExpiryDate">Email</label>
                                    <input type="email" id="modalAddCardExpiryDate" name="email"
                                        value="<?php echo e(old('email')); ?>" class="form-control expiry-date-mask"
                                        placeholder="johndoe@gmail.com" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddCardName">Mobile Number</label>
                                    <input name="phone" pattern="[0-9]{10}" maxlength="10"
                                        value="<?php echo e(old('phone')); ?>" class="form-control" placeholder="XXX-XXX-XXXX" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">Complaint</label>
                                    <input required type="text"
                                        value="<?php echo e(old('complaint')); ?>" name="complaint" class="form-control"
                                        placeholder="Subject here" />
                                    <input type="hidden" name="case_type" value="2" />
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Case Sammary</label>
                                    <textarea required name="sammary" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Two Factor Auth Modal -->
            <!-- Modal Authentication via SMS -->
            <div class="modal fade" id="twoFactorAuthThree" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Add New Case</h3>
                                <p class="text-muted">Add new Discipline Case by compliting Each field bellow</p>
                            </div>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate Plaintiff</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>
                                        <select required name="plaintiff" class="select2 form-select">
                                            <option value="" selected> - Select - </option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(old('user')==$user->name): ?> selected <?php endif; ?>
                                                value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                
                                </div>
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate Defendant</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Defendant</span>
                                    </label>
                                        <select required name="defendant" class="select2 form-select">
                                            <option value="" selected> - Select - </option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(old('user')==$user->name): ?> selected <?php endif; ?>
                                                value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">Complaint</label>
                                    <input required type="text"
                                        value="<?php echo e(old('complaint')); ?>" name="complaint" class="form-control"
                                        placeholder="Subject here" />
                                    <input type="hidden" name="case_type" value="3" />
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Case Sammary</label>
                                    <textarea required name="sammary" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Two Factor Auth Modal -->


        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Case number</th>
                        <th>Complaint</th>
                        <th>Plaintiff</th>
                        <th>Defendant</th>
                        <th>Authority</th>
                        <th>Status</th>
                        
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    $count = 1;
                    ?>
                    <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($count); ?></td>
                        <td><?php echo e($case->case_number); ?></td>
                        <td><?php echo e($case->complaint); ?></td>
                        <td><?php echo e($case->p_name); ?>

                            <?php if($case->case_type != 1): ?>
                            <span class="badge bg-label-warning me-2">Advocate</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($case->d_name); ?>

                            <?php if($case->case_type != 2): ?>
                            <span class="badge bg-label-warning me-2">Advocate</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($case->authority); ?></td>
                        <td>
                            <?php if($case->case_status == 'OPEN'): ?>
                            <span class="badge bg-label-info me-2"><?php echo e($case->case_status); ?></span>
                            <?php else: ?>
                            <span class="badge bg-label-danger me-2"><?php echo e($case->case_status); ?></span>
                            <?php endif; ?>
                        </td>
                        
                        <td><a href="<?php echo e(route('cases.show',$case->id)); ?>" class="btn btn-sm btn-primary">Manage</a> 
                            <a href="" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($case->id); ?>"
                                class="btn btn-sm btn-danger">Delete</a>
                                    <div class="modal modal-top fade" id="delete<?php echo e($case->id); ?>" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('case.delete')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="id" value="<?php echo e($case->id); ?>" />
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel2">Are you sure you want to
                                                            delete?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                        </td>
                    </tr>
                    <?php
                    $count++;
                    ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="col-lg-12">
                <?php echo e($cases->links('vendor.pagination.custom')); ?>

               
            </div>
        </div>

    </div>

</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/form-wizard-numbered.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<script>
    $(document).ready(function() {
        $('.selectadv').select2();
    });

</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/cases/index.blade.php ENDPATH**/ ?>