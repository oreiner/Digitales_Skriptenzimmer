<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Teachers Area section -->
    <section class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form method="POST" action="<?php echo e(route('login')); ?>" class="learnpro-register-form text-center">
                        <?php echo csrf_field(); ?>
                        <p class="lead">Willkommen zurück</p>

                        <?php if(session()->has('login_error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session()->get('login_error')); ?>

                            </div>
                        <?php endif; ?>



                        <div class="form-group">
                            <input id="identity" type="text" class="required form-control<?php echo e($errors->has('identity') ? ' is-invalid' : ''); ?>" name="identity" value="<?php echo e(old('identity')); ?>" required autofocus   autocomplete="off"  placeholder="Benutzername oder E-Mail-Adresse *">
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input  name="password" type="password" id="password"  placeholder="Passwort *" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" required>  <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?></div>
                        <div class="form-group register-btn">
                             <submit class="btn btn-primary btn-lg" onclick="$(this).closest('form').submit();">Login</submit>
                        </div>
                        <p>Noch nicht registriert? <a href="<?php echo e(route('register')); ?>"><strong>registriere dich heute</strong></a></p>
						<p>Passwort vergessen? <a href="<?php echo e(route('password.request')); ?>"><strong>passwort zurücksetzen</strong></a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>