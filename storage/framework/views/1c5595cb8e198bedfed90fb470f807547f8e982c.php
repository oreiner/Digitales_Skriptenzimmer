<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name')); ?> | <?php echo $__env->yieldContent('title'); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body class="hold-transition login-page" >
<div class="wrapper" id="app">
<?php echo $__env->yieldContent('content'); ?>
<router-view></router-view>
<!-- set progressbar -->
<vue-progress-bar></vue-progress-bar>

</div>
<script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
</body>
</html>
