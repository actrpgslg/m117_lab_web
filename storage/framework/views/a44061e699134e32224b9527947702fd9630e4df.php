<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">查詢下載</h4>
                        <p class="category">24 小時</p>
                    </div>
                    <div class="content">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">資料下載</h4>
                        <p class="category">製成Excel</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                          <thead>
                            <th>日期</th>
                            <th>類型</th>
                            <th></th>
                          </thead>
                          <tbody>
                            <tr>
                              <td>全部</td>
                              <th>原始資料</th>
                              <td>
                                <i class="pe-7s-download"><a href="<?php echo e(URL::to('/Api/dayrecord/all')); ?>">下載</a></i>
                              </td>
                            </tr>
                          </tbody>
                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>