<?php $__env->startSection('title','Login'); ?>
<?php $__env->startSection('content'); ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url('/admin')); ?>"><b>Skripte.Koeln</b></a>

        </div>
        <?php if(session()->has('login_error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session()->get('login_error')); ?>

            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Administrator-Anmeldung</p>
                <form method="POST" action="<?php echo e(url('/admin/login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group has-feedback">
                        <input type="text" name="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"  value="<?php echo e(old('email')); ?>" required autofocus placeholder="E-Mail-Adresse or Benutzername *">
                        <?php if($errors->has('username')): ?>
                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required placeholder="
						*">
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Passwort merken
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Einloggen</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>