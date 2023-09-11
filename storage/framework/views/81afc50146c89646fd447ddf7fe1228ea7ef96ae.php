<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  
  <div class="app-brand demo ">
    <a href="<?php echo e(route('dashboard')); ?>" class="app-brand-link">
      <img src="<?php echo e(asset('assets/logo/logo-simplified.png')); ?>" class="mt-1" alt="RBA Logo" width="170">
    </a>

    
  </div>
  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Pages</span>
    </li>
    <!-- Dashboard -->
    <li class="menu-item <?php echo e(Request::routeIs('dashboard') ? 'active' : ''); ?>">
      <a href="<?php echo e(route('dashboard')); ?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <!-- Users -->
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-users')): ?><li class="menu-item <?php echo e(Request::routeIs('users') ? 'open' : (Request::routeIs('users.org') ? 'open' : '')); ?>">
      
    <?php endif; ?>
    <!-- Disciplinary Cases -->
    

    <!-- Probono Cases -->
    
  </ul>
  
  

</aside>
<!-- / Menu -->
<?php /**PATH C:\xampp\htdocs\resources\views/components/user-sidebar.blade.php ENDPATH**/ ?>