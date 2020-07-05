<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <?php echo e($labels['Dashboard']??'Dashboard'); ?>

            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <div class="navbar-form">

            </div>
            <ul class=" navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"  onclick="event.preventDefault();  document.getElementById('user-change-language').submit();">

                        <form id="user-change-language" action="<?php echo e(route('permission.user.change.language')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>

                        <?php if(Auth::user()->lang_id == '1'): ?>
                            A
                        <?php else: ?>
                            EN
                        <?php endif; ?>
                        <i class="material-icons">language</i>

                    </a>
                </li>
                <li class="nav-item dropdown" >
                    <a class="nav-link notifications-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification" id="notification-count" style="display: none"></span>
                        <p class="d-lg-none d-md-block">
                            Some Actions
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="notifications-list" aria-labelledby="navbarDropdownMenuLink" style="width: 450px;max-height:300px; overflow: auto; ">

                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user">
                            <div class="photo">
                                <?php if( !empty(Auth::user()->user_photo)): ?>
                                    <img src="<?php echo e(asset('images/user/photo/').'/'.Auth::user()->user_photo); ?>"/>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/placeholder.png')); ?>"/>
                                <?php endif; ?>
                            </div>
                            <?php if( !empty(Auth::user()->user_name)): ?>
                                <?php echo e(Auth::user()->user_name); ?>

                            <?php endif; ?>
                        </div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo e(route('permission.user.showMyProfile')); ?>">
                             <?php echo e($labels['my_profile']??'my_profile'); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('permission.user.editMyProfile')); ?>">
                             <?php echo e($labels['edit_profile']??'edit_profile'); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('permission.user.createChangePassword')); ?>">
                             <?php echo e($labels['change_password']??'change_password'); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('permission.user.get.logout')); ?>">

                             <?php echo e($labels['logout']??'logout'); ?>

                        </a>



                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>

