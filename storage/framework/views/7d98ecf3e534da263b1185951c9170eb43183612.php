<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="app-brand-link">
            <img src="<?php echo e(asset('assets/logo/logo-simplified.png')); ?>" class="mt-1" alt="RBA Logo" width="170">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <!-- Dashboard -->
        <li class="menu-item <?php echo e(Request::routeIs('dashboard') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2, 4, 5])): ?>
            <!-- Users -->
            <li
                class="menu-item 
    <?php echo e(Request::routeIs('users.ind') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>

    <?php echo e(Request::routeIs('activepage') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>

    <?php echo e(Request::routeIs('inactivepage') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>

    <?php echo e(Request::routeIs('suspendedpage') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>

    <?php echo e(Request::routeIs('struckOffpage') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>

    <?php echo e(Request::routeIs('deseacedpage') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>

">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Users">Users</div>
                </a>
                <ul class="menu-sub">
                    <li
                        class="menu-item <?php echo e(Request::routeIs('users.ind') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('users.ind')); ?>" class="menu-link">
                            <div data-i18n="Individuals">Individuals Users</div>
                        </a>
                        
                    </li>
                    
                    <li class="menu-item <?php echo e(Request::routeIs('users.org') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('users.org')); ?>" class="menu-link">
                            <div data-i18n="Organizations">Organizations</div>
                        </a>
                    </li>
                    <li class="menu-item <?php echo e(Request::routeIs('deactivated') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('deactivated')); ?>" class="menu-link">
                            <div data-i18n="Deactivated Users">Deactivated Users</div>
                        </a>
                    </li>
                    <?php if(in_array(auth()->guard('admin')->user()->role_id,
                    [2,4])): ?>
                    <li class="menu-item <?php echo e(Request::routeIs('Compliances') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('Compliances')); ?>" class="menu-link">
                            <div data-i18n="Users CLE Compliances">Users CLE Compliances</div>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2, 3, 4, 5])): ?>
            <!-- Meetings -->
            <li
                class="menu-item <?php echo e(Request::routeIs('meetings.index') || Request::routeIs('meetings.create') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('meetings.index')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-brand-zoom"></i>
                    <div data-i18n="Meetings">Meetings</div>
                </a>
            </li>
            <!-- Meetings -->
        <?php endif; ?>
        <?php if(auth()->guard('admin')->user()->role_id == 3): ?>
            <li class="menu-item <?php echo e(Request::routeIs('Compliances') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('Compliances')); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users CLE Compliances">Users CLE Compliances</div>
            </a>
        </li>  
        <?php endif; ?>
      
        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2, 4])): ?>
            <!-- Disciplinary Cases -->
            <li class="menu-item <?php echo e(Request::routeIs('cases.index') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('cases.index')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-file-dislike"></i>
                    <div data-i18n="Disciplinary Cases">Disciplinary Cases</div>
                </a>
            </li>
            <!-- Disciplinary Cases -->
        <?php endif; ?>

        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2, 3, 4])): ?>
            <!-- >Pro Bono Cases -->
            <li class="menu-item <?php echo e(Request::routeIs('probono.index') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('probono.index')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-gavel"></i>
                    <div data-i18n="Pro Bono Cases">Pro Bono Cases</div>
                </a>
            </li>
            <!-- >Pro Bono Cases -->
        <?php endif; ?>
        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2, 4])): ?>
            <!-- Legal Education -->
            <li class="menu-item <?php echo e(Request::routeIs('trainings.index') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('trainings.index')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-link"></i>
                    <div data-i18n="Legal Education">Legal Education</div>
                </a>
            </li>
            <!-- Legal Education -->
        <?php endif; ?>
        
        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2, 5])): ?>
            <!-- Finance -->
            <li class="menu-item <?php echo e(Request::routeIs('contribution.index') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('contribution.index')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-report-money"></i>
                    <div data-i18n="Finance">Finance</div>
                </a>
            </li>
        <?php endif; ?>
        <?php if(in_array(auth()->guard('admin')->user()->role_id,
                [2])): ?>
            <!-- Apps & Pages -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Extra</span>
            </li>
            
            <!-- System settings -->
            <li class="menu-item <?php echo e(Request::routeIs('settings') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('settings')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-adjustments"></i>
                    <div data-i18n="System settings">System settings</div>
                </a>
            </li>

            <li class="menu-item <?php echo e(Request::routeIs('notify-users') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('notify-users')); ?>" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-bell"></i>
                    <div data-i18n="Notifying">Notifying</div>
                </a>
            </li>
        <?php endif; ?>
    </ul>



</aside>
<!-- / Menu -->
<?php /**PATH C:\xampp\htdocs\bar\resources\views/components/sidebar.blade.php ENDPATH**/ ?>