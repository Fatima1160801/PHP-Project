

                
                    
                

            <?php echo Form::open(['route' => 'activity.location.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formLocationCreate']); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $html; ?>



            <div class="col-md-12">

                <button id="btnLocationAdd" btn="btnToggleDisabled" type="submit"
                        class="btn btn-next btn-rose pull-right btn-sm">
                    <?php echo e($labels['save'] ?? 'save'); ?>

                    <div class="loader pull-left" style="display: none;">  </div>
                </button>
            </div>


            <?php echo Form::close(); ?>



