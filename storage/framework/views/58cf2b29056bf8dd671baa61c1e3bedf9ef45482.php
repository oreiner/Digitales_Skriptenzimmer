<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12 header-top-left">
                <ul class="list-unstyled">
                    <li><i class="fa fa-facebook-square top-icon"></i> <a href="<?php echo e(config('app.facebook')); ?>" target="_blank">Facebook</a></li> 
                    
					<li><i class="fa fa-envelope top-icon"></i><a href="mailto:<?php echo e(config('mail.from.address')); ?>?cc=info@skripte.koeln" target="_top"><?php echo e(config('mail.from.address')); ?></a> </li>
					
					<li><i class="fa fa-calendar top-icon"></i><a href="<?php echo e(config('app.calendar')); ?>" target="_blank" >Öffnungszeiten</a> </li>
					
                </ul>
            </div>
            <div class="col-sm-6 col-xs-12 header-top-right">
                <ul class="list-unstyled">
					<li><a href="<?php echo e(route('terms')); ?>"><i class="fa fa-gavel top-icon"></i> AGB</a></li>
					<li><a href="<?php echo e(route('faq')); ?>"><i class="fa fa-question-circle  top-icon"></i> FAQ</a></li>
                    <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(route('register')); ?>"><i class="fa fa-user-plus top-icon"></i> Registrierung</a></li>
                        <li><a href="<?php echo e(route('login')); ?>"><i class="fa fa-lock top-icon"></i>Anmeldung</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo e(url('download')); ?>"><i class="fa fa-file-text top-icon"></i> Skripte</a></li>
                            <li><a href="<?php echo e(url('profile')); ?>"><i class="fa fa-user-md top-icon"></i> Profil</a></li>				
							 						
                            <li><a href="<?php echo e(url('mailpdf')); ?>"><i class="fa fa-book top-icon"></i> Protokolle <?php /* this counts the user's remaining protocols for the day. unnecessary info?({{Auth::user()->getMailPdfCount()}}) if you want to restore, delete comment and php parantheses */ ?></a></li>
                             
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Hi (<?php echo e(Auth::user()->name); ?>) <?php echo e(__('abmelden')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                            <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div><!-- Ends: .header-top -->