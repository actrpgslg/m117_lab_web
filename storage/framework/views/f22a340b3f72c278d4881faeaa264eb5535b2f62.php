<!doctype html>
<html lang="en" class="nav-open">
 <?php echo $__env->make('partial.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>

<div class="wrapper">

 <?php echo $__env->make('partial.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

    <div class="main-panel">
    	<?php echo $__env->make('partial.topbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
    <!--     <?php echo $__env->make('partial.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
        <?php echo $__env->yieldContent('content'); ?>
  <!--      <?php echo $__env->make('partial.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
    </div>
</div>
 <?php echo $__env->make('partial.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

</body>
</html>
