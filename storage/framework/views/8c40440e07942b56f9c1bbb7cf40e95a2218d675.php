

<?php $__env->startSection('page_name'); ?>
Discipline Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <?php
    use App\Models\User;
    use App\Models\DisciplineReport;
    ?>
    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-6 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Case Information

                        <a href="<?php echo e(route('cases.notificationsHistory',$case->id)); ?>" class="btn btn-primary btn-sm waves-effect waves-light float-end">
                            Mail sent
                            <span class="badge bg-white text-primary badge-center ms-1">
                                <?php echo e(App\Models\CaseNotifyRecords::where('case_id', $case->id)->count()); ?>

                            </span>
                        </a>
                    </h5>     

                    <?php $__currentLoopData = $sittings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Disciplinary Case Number</td>
                                    <td><?php echo e($case->case_number); ?></td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td><?php echo e($case->admin->name); ?></td>
                                </tr>
                                <tr>
                                    <td>Created On</td>
                                    <td><?php echo e($case->created_at); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php if($case->case_status =='OPEN'): ?>
                                        <span class="badge bg-label-info"><?php echo e($case->case_status); ?></span>
                                        <?php else: ?>
                                        <span class="badge bg-label-danger"><?php echo e($case->case_status); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Authority</td>
                                    <td><?php echo e($case->authority); ?></td>
                                </tr>
                                <tr>
                                    <td>Complaint</td>
                                    <td><?php echo e($case->complaint); ?></td>
                                </tr>
                                <tr>
                                    <td>Next Sitting Day</td>
                                    <td><?php echo e($sitting->sittingDay); ?></td>
                                </tr>
                                <tr>
                                    <td>Next Sitting Time</td>
                                    <td><?php echo e($sitting->sittingTime); ?></td>
                                </tr>

                                <tr>
                                    <td>Plaintiff</td>
                                    <td><?php echo e($case->p_name); ?>


                                        <?php if($case->case_type == 1): ?>

                                        <?php elseif($case->case_type == 2): ?>
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        <?php else: ?>
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Defendant</td>
                                    <td><?php echo e($case->d_name); ?>

                                        <?php if($case->case_type == 1): ?>
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        <?php elseif($case->case_type == 2): ?>

                                        <?php else: ?>
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="m-2 mr-4">
                        <?php if($case->case_status =='CLOSED'): ?>
                        <a href="javascript:" data-bs-toggle="modal" data-bs-target="#edit"
                            class="btn btn-warning btn-sm">Edit </a>
                        <?php else: ?>
                        <a href="javascript:" data-bs-toggle="modal" data-bs-target="#edit"
                            class="btn btn-warning btn-sm">Edit </a>
                        <a href="javascript:" data-bs-toggle="modal" data-bs-target="#schedule"
                            class="btn btn-primary btn-sm">Schedule Next Sitting</a>
                        <a href="javascript:" data-bs-toggle="modal" data-bs-target="#notify"
                            class="btn btn-dark btn-sm">Notify
                        </a>
                        <div class="modal fade" id="notify" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered1 modal-lg modal-simple modal-add-new-cc">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h5 class="mb-2">Send Notification Messages</h5>

                                        </div>
                                        <?php
                                        if($case->case_type == 1){
                                        $p_name = $case->p_name;
                                        $p_email = $case->p_email;
                                        $p_phone = $case->p_phone;
                                        $d_name = User::find($case->d_advocate)->name;
                                        $d_email = User::find($case->d_advocate)->email;
                                        $d_phone = User::find($case->d_advocate)->phone[0]->phone;

                                        }elseif($case->case_type == 2){
                                        $p_name = User::find($case->p_advocate)->name;
                                        $p_email = User::find($case->p_advocate)->email;
                                        $p_phone = User::find($case->p_advocate)->phone[0]->phone;
                                        $d_name = $case->d_name;
                                        $d_email = $case->d_email;
                                        $d_phone = $case->d_phone;
                                        }else{
                                        $p_name = User::find($case->p_advocate)->name;
                                        $p_email = User::find($case->p_advocate)->email;
                                        $p_phone = User::find($case->p_advocate)->phone[0]->phone;
                                        $d_name = User::find($case->d_advocate)->name;
                                        $d_email = User::find($case->d_advocate)->email;
                                        $d_phone = User::find($case->d_advocate)->phone[0]->phone;
                                        }
                                        ?>
                                        <form method="POST" class="row g-3" action="<?php echo e(route('case.notify')); ?>"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="case_type" value="<?php echo e($case->case_type); ?>">
                                            <input type="hidden" name="case_id" value="<?php echo e($case->id); ?>">

                                            <input type="hidden" name="p_name" value="<?php echo e($p_name); ?>">
                                            <input type="hidden" name="p_email" value="<?php echo e($p_email); ?>">
                                            <input type="hidden" name="p_phone" value="<?php echo e($p_phone); ?>">

                                            <input type="hidden" name="d_name" value="<?php echo e($d_name); ?>">
                                            <input type="hidden" name="d_email" value="<?php echo e($d_email); ?>">
                                            <input type="hidden" name="d_phone" value="<?php echo e($d_phone); ?>">

                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" checked name="party[]" type="radio"
                                                        value="Plaintiffs" id="partyOne" />
                                                    <label class="form-check-label" for="partyOne">Plaintiffs
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="party[]" type="radio"
                                                        value="Defendants" id="PartyTwo" />
                                                    <label class="form-check-label" for="PartyTwo">Defendants
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="party[]" type="radio"
                                                        value="All" id="All" />
                                                    <label class="form-check-label" for="All">All Parties
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" checked name="staff[]"
                                                        type="checkbox" value="3" id="supportstaff" />
                                                    <label class="form-check-label" for="supportstaff">Support
                                                        Staff</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="staff[]"
                                                        type="checkbox" value="4" id="technicalstaff" />
                                                    <label class="form-check-label" for="technicalstaff">Technical
                                                        Staff</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="switch">
                                                    <span class="switch-label">Subject <span class="text-danger">include
                                                            in Email
                                                            only</span></span>
                                                </label>
                                                <input type="text" name="subject" class="form-control"
                                                    value="<?php echo e($case->case_number); ?>" id="subject">

                                            </div>
                                            <div class="col-12">
                                                <label for="summernote" class="form-label">Message</label>
                                                <textarea required name="message" class="form-control" id="summernote"
                                                    rows="3"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="switch mb-2">
                                                    <span class="switch-label text-warning">Attache files (5
                                                        Max):</span>
                                                </label>

                                                <input type="file" name="attachments[]" class="form-control" multiple
                                                    max="5">
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="sent[]" type="checkbox"
                                                        value="SMS" id="defaultCheck3" />
                                                    <label class="form-check-label" for="defaultCheck3">SMS (Uncheck if
                                                        "NO")
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" checked name="sent[]"
                                                        type="checkbox" value="EMAIL" id="defaultCheck4" />
                                                    <label class="form-check-label" for="defaultCheck4">EMAIL (Uncheck
                                                        if "NO")
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1">Submit</button>
                                                <button type="reset" class="btn btn-label-secondary btn-reset"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endif; ?>

                    </div>
                </div>


            </div>
        </div>
        <div class="col-xl-6 col-lg-7 col-md-7">
            <div class="card mb-4">
                <h5 class="card-header">Case Sammry</h5>
                <div class="cord-body bg-light" style="padding: 2%">
                    <p>
                        <?php echo e($case->sammary); ?>

                    </p>
                </div>

            </div>
            <!-- Modal Authentication App -->
            <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Update case</h3>
                            </div>
                            <?php if($case->case_type == 1): ?>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="case" value="<?php echo e($case->id); ?>">
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Layman Or Institution Plaintiff</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>
                                    <div class="input-group input-group-merge">
                                        <input pattern="[A-Za-z0-9 ]{6,}" title="Name Must have at least 6 characters"
                                            required name="name" value="<?php echo e($case->p_name); ?>"
                                            class="form-control credit-card-mask" type="text" />
                                        <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                                class="card-type"></span></span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="modalAddCardExpiryDate">Email</label>
                                    <input type="email" id="modalAddCardExpiryDate" name="email"
                                        value="<?php echo e($case->p_email); ?>" class="form-control expiry-date-mask" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddCardName">Mobile Number</label>
                                    <input name="phone" pattern="[0-9]{10}" maxlength="10"
                                        value="<?php echo e($case->p_phone); ?>" class="form-control" />
                                </div>

                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate defendant</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>

                                    <select required name="advocate" class="select2 form-select">
                                        <option value="<?php echo e($case->d_advocate); ?>" selected><?php echo e($case->d_name); ?>

                                        </option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">complaint</label>
                                    <input pattern="[A-Za-z0-9 ]{10,}"
                                        title="complaint must have at least 10 characters" required type="text"
                                        value="<?php echo e($case->complaint); ?>" name="complaint" class="form-control"
                                        placeholder="Subject here" />
                                    <input type="hidden" name="case_type" value="1" />
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Case Sammary</label>
                                    <textarea required name="sammary" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"><?php echo e($case->sammary); ?></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </form>
                            <?php endif; ?>
                            <?php if($case->case_type == 2): ?>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="case" value="<?php echo e($case->id); ?>">
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate Plaintiff</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Advocate name</label>

                                    <select required name="advocate" class="select2 form-select">
                                        <option value="<?php echo e($case->p_advocate); ?>" selected><?php echo e($case->p_name); ?>

                                        </option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
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
                                            required name="name" value="<?php echo e($case->d_name); ?>"
                                            class="form-control credit-card-mask" type="text" />
                                        <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                                class="card-type"></span></span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="modalAddCardExpiryDate">Email</label>
                                    <input type="email" id="modalAddCardExpiryDate" name="email"
                                        value="<?php echo e($case->d_email); ?>" class="form-control expiry-date-mask" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddCardName">Mobile Number</label>
                                    <input name="phone" pattern="[0-9]{10}" maxlength="10"
                                        value="<?php echo e($case->d_phone); ?>" class="form-control" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">complaint</label>
                                    <input pattern="[A-Za-z0-9 ]{10,}"
                                        title="complaint must have at least 10 characters" required type="text"
                                        value="<?php echo e($case->complaint); ?>" name="complaint" class="form-control"
                                        placeholder="Subject here" />
                                    <input type="hidden" name="case_type" value="2" />
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Case Sammary</label>
                                    <textarea required name="sammary" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"><?php echo e($case->sammary); ?></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </form>
                            <?php endif; ?>
                            <?php if($case->case_type == 3): ?>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="case" value="<?php echo e($case->id); ?>">
                                <div class="col-12">
                                    <label class="switch">
                                        <span class="switch-label">Advocate Plaintiff</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <label class="form-label w-100" for="modalAddCard">Name</label>

                                    <select required name="plaintiff" class="select2 form-select">
                                        <option value="<?php echo e($case->p_advocate); ?>" selected><?php echo e($case->p_name); ?>

                                        </option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
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
                                        <span class="switch-label">Civilian defendant</span>
                                    </label>

                                    <select required name="defendant" class="select2 form-select">
                                        <option value="<?php echo e($case->d_advocate); ?>" selected> <?php echo e($case->d_name); ?>

                                        </option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>

                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">complaint</label>
                                    <input pattern="[A-Za-z0-9 ]{10,}"
                                        title="complaint must have at least 10 characters" required type="text"
                                        value="<?php echo e($case->complaint); ?>" name="complaint" class="form-control"
                                        placeholder="Subject here" />
                                    <input type="hidden" name="case_type" value="3" />
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Case Sammary</label>
                                    <textarea required name="sammary" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"><?php echo e($case->sammary); ?></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset"
                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Authentication App -->
            <div class="modal fade" id="schedule" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Next schedule Sitting</h3>
                            </div>
                            <form method="POST" class="row g-3" action="<?php echo e(route('cases.sitting')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="col-12">
                                    <input type="hidden" name="id" value="<?php echo e($case->id); ?>">
                                    <label class="form-label w-100" for="modalAddCard">Session Category</label>
                                    <div class="input-group input-group-merge">
                                        <select required name="category" class="form-select">
                                            <option value="" selected> - Select - </option>
                                            <option value="Hearing by BATONIER">Hearing by BATONIER</option>
                                            <option value="Mediation">Mediation</option>
                                            <option value="Disciplinary committee">Disciplinary committee</option>
                                            <option value="Inspection">Inspection</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="modalAddCardName">Date</label>
                                    <input required type="date" min="<?= date("Y-m-d") ?>" name="sittingdate"
                                        class="form-control" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="modalAddCardName">Time</label>
                                    <input required type="time" name="sittingtime" class="form-control" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardName">Avenue</label>
                                    <input required type="text" name="sittingAvenue" class="form-control" />
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


            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Participant</h5>
                    <?php if($case->case_status =='OPEN'): ?>
                    <a class="btn btn-primary btn-sm text-white pull-left float-end" data-bs-toggle="modal"
                        data-bs-target="#partipant">
                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                        <span class="d-none d-sm-inline-block">New Advocate</span></a>
                    <?php endif; ?>

                </div>
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Advocate</th>
                                    <th>Role</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $count = 1;
                                ?>
                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($member->user->name); ?></td>
                                    <td><?php echo e($member->role); ?></td>
                                    <td>
                                        <?php if($case->case_status =='OPEN'): ?>
                                        <a href="javascript:" data-bs-toggle="modal"
                                            data-bs-target="#deleteStatus<?php echo e($member->table_id); ?>" class="text-danger"><i
                                                class="ti ti-trash"></i></a>
                                        <?php endif; ?>
                                        <div class="modal modal-top fade" id="deleteStatus<?php echo e($member->table_id); ?>"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <form action="<?php echo e(route('participant.delete')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <input type="hidden" name="id"
                                                            value="<?php echo e($member->table_id); ?>" />
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel2">Are you sure
                                                                to delete <strong><?php echo e($member->user->name); ?></strong>
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes,
                                                                Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                                <?php
                                $count++
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--/ Teams -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Schedules</th>
                                    <th style="width: 700px;">Conclusions</th>
                                    <th style="width: 10px;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $count = 1;
                                ?>
                                <?php $__currentLoopData = $sittings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sitting->sittingDay == 'NONE'): ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td>

                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2"><span
                                                    class="badge bg-primary"><?php echo e($sitting['category']); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">Sitting
                                                Day:</span><?php echo e($sitting['sittingDay']); ?></span></li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">Sitting
                                                Time:</span><?php echo e($sitting['sittingTime']); ?></span></li>
                                        <li class="d-flex align-items-center"></i><span class="fw-bold mx-2">Sitting
                                                Time:</span><?php echo e($sitting['sittingVenue']); ?></span></li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">Scheduled
                                                by:</span><?php echo e($sitting->admin->name); ?></span></li>

                                    </td>
                                    <td>
                                        <li class="d-flex align-items-center mb-2"><span class="fw-bold mx-2"><span
                                                    class="badge bg-danger"><?php echo e($sitting['decisionCategory']); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">
                                                <span class="badge bg-primary">Targeting:</span>
                                            </span> <?php if($sitting->targetedAdvocate == 'N/A' ||
                                            $sitting->targetedAdvocate == NULL): ?>
                                            No One
                                            <?php else: ?>
                                            <?php echo e($sitting->user->name); ?>

                                            <?php endif; ?>
                                            </span></li>

                                        <u>Comment</u> <br>
                                        <textarea disabled cols="50" rows="5"><?php echo e($sitting['comment']); ?></textarea>
                                        <br>
                                        <?php
                                        $attachements = explode(',', $sitting->attach_file);
                                        ?>
                                        <?php if($attachements[0] != ''): ?>
                                        <?php $__currentLoopData = $attachements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('Download-files',$attachement)); ?>">Download file
                                            <?php echo e($key+1); ?></a> &nbsp;&nbsp;
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>


                                    </td>
                                    <td>
                                        <?php if($case->case_status =='OPEN'): ?>
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#decision<?php echo e($sitting->sitting_id); ?>"
                                            class="btn btn-primary btn-sm"> <i class="ti ti-plus"> Decision </i></a>

                                        <?php endif; ?>
                                        <br><br><br>
                                        <?php
                                        $reports =
                                        DisciplineReport::where('discipline_id',$case->id)->where('sitting_id',$sitting->sitting_id)->get();
                                        ?>
                                        <p>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#reports<?php echo e($sitting->sitting_id); ?>"
                                                class="btn btn-sm btn-label-secondary text-nowrap d-inline-block">
                                                Reported Events
                                                <span
                                                    class="badge bg-danger text-white badge-notifications"><?php echo e($reports->count()); ?></span>
                                            </a>
                                        </p>

                                        <div class="modal fade" id="reports<?php echo e($sitting->sitting_id); ?>" tabindex="-1"
                                            aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                <div class="modal-content p-3 p-md-5">
                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>

                                                        <div class="text-center mb-4">
                                                            <h5 class="mb-2">Reported Events</h5>
                                                        </div>
                                                        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6>Reports Details
                                                                    <span
                                                                        class="badge bg-secondary pull-left float-end"><?php echo e($report->user->name); ?></span>
                                                                </h6>
                                                                <textarea disabled name="comments" class="form-control"
                                                                    rows="4"><?php echo e($report->comments); ?></textarea>
                                                                <p>
                                                                    <h6>Attachments:</h6>
                                                                    <?php
                                                                    $attachements = explode(',', $report->attachements);
                                                                    ?>
                                                                    <?php $__currentLoopData = $attachements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a
                                                                        href="<?php echo e(route('Download-files',$attachement)); ?>">Download
                                                                        file <?php echo e($key+1); ?></a> &nbsp;&nbsp;
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                                <?php endif; ?>

                                <?php
                                $count++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <!--/ About User -->

        <!--/ Profile Overview -->
    </div>
</div>
<!--/ User Profile Content -->
<div class="modal fade" id="partipant" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Add Participant</h3>
                    <p class="text-muted">Add new Disciplene Case Member for followup Every Days</p>
                </div>
                <form method="POST" class="row g-3" action="<?php echo e(route('cases.addmember')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-12">
                        <label class="form-label w-100" for="modalAddCard">Name</label>
                        <input type="hidden" name="case_id" value="<?php echo e($case->id); ?>">
                        <select id="user" name="advcate_id" class="select2 form-select" required>
                            <option value="" selected> - Select - </option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(old('user')==$user->name): ?> selected <?php endif; ?>
                                value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="modalAddCard">Role</label>
                        <div class="input-group input-group-merge">
                            <select id="user" name="role" class="form-select" required>
                                <option value="" disabled selected> - Select - </option>
                                <option value="Plaintiff">Plaintiff</option>
                                <option value="Defendant">Defendant</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="decision<?php echo e($sitting->sitting_id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Scheduler Desision</h3>
                </div>
                <form method="POST" class="row g-3" action="<?php echo e(route('cases.scheduleDecion')); ?>"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="sittind_id" value="<?php echo e($sitting->sitting_id); ?>">
                    <input type="hidden" name="case" value="<?php echo e($case->id); ?>">
                    <div class="col-12">
                        <label class="switch">
                            <span class="switch-label">Advocate Plaintiff</span>
                        </label>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="checkbox" value="1"
                                id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                Close case on submition? (Uncheck if "NO")
                            </label>
                        </div>

                    </div>
                    <div class="col-6">
                        <label class="switch">
                            <span class="switch-label">Desision</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <select required name="desision" class="form-select">
                                <option value="" disabled selected> - Select - </option>
                                <option value="Blame">Blame</option>
                                <option value="Warning">Warning</option>
                                <option value="Referral to discipline commitee">Referral to discipline commitee</option>
                                <option value="Authorization to go to cout">Authorization to go to cout</option>
                                <option value="Reinstate / Absolve / Exculpate">Reinstate / Absolve / Exculpate</option>
                                <option value="Suspended Advocate">Suspended Advocate</option>
                                <option value="StruckOff Advocate">StruckOff Advocate</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="switch">
                            <span class="switch-label">Taget Advocate</span>
                        </label>
                        <select required name="tagetAdvocate" class="form-select">
                            <option value="N/A" selected> N/A</option>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($member->user->id); ?>"><?php echo e($member->user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>

                    <div class="col-12">
                        <label for="exampleFormControlTextarea1" class="form-label">Comment on Decision</label>
                        <textarea required name="comment" class="form-control" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label w-100" for="title">Attach File (Maximum files is 5)</label>
                        <div class="input-group input-group-merge">
                            <input accept=".doc,.docx,.ppt,.pptx,.pdf" max="5" name="attach_file[]" class="form-control"
                                type="file" multiple />

                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-profile.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/tagify/tagify.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/tagify/tagify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/form-wizard-numbered.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true // set focus to editable area after initializing summernote
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/cases/detail.blade.php ENDPATH**/ ?>