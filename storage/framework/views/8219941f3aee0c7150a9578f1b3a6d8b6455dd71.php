<?php if(Session::has('success')): ?>
     <div class="col-md-12 view_more_btn" id="alertmessage" style="z-index: 9999">
     <div class="btn view-more-item alert-dismissable" style="margin-top: 10px; margin-bottom:10px"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="getElementById('alertmessage').remove()">&times;</button><!--<strong>Success !</strong>&emsp;!-->
          <?php echo e(Session::get('success')); ?>  
     </div>
     </div>
     <br>

<?php endif; ?>