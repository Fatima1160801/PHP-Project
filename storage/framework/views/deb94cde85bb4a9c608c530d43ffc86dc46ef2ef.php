<div class="col-md-12" id="fixed">
    <div class="row">
        <?php if(sizeof($doc_setting)): ?>
            <?php $__currentLoopData = $doc_setting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $fixed = $fixed_doc->where('attachment_type_id',$doc->attachment_type_id)->first();    ?>
                <?php if($fixed): ?>


                    <div class="col-md-3" id="fixed_type_<?php echo e($fixed->attachment_type_id); ?>" style="padding-top: 48px;">
                        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <img class="img" id="doc_img_"
                                         src="<?php echo e(asset('images/filetype/'.strtolower($fixed->file_type).'.png')); ?>"
                                         style="width: 100px;height:100px;    padding: 13px;">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-gray"><?php echo e($fixed->{'attachment_type_'.lang_character()}); ?></h6>
                                <h4 class="card-title" id="doc_title_"><?php echo e($fixed->file_title ?? ""); ?></h4>
                                <p class="card-description" id="doc_descpt_">
                                    <?php echo e($fixed->file_desc?? ""); ?>

                                </p>

                                <button data-href="<?php echo e(route('attachments.fixed.edit',["id"=>$fixed->id ?? ""])); ?>"
                                        id="btnEditFixedFileModal" class="btn btn-sm btn-primary btn-round btn-fab"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Edit File">
                                    <i class="material-icons">open_in_browser</i>
                                </button>

                                <a href="<?php echo e(p_url('/'.$fixed->file_path)); ?>" rel="tooltip" download
                                   class="btn btn-sm btn-info btn-round btn-fab download_link"
                                   rel="tooltip" data-original-title=""
                                   title=" <?php echo e($labels['download']??'download'); ?>"
                                   data-placement="top" id="doc_file_path_<?php echo e($fixed->id); ?>">
                                    <i class="material-icons">cloud_download</i>
                                </a>
                            </div>
                        </div>
                    </div>



                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    
                    
                    
                    

                    
                    
                    
                <?php else: ?>




                    <div class="col-md-3" id="fixed_type_<?php echo e($doc->attachment_type_id); ?>" style="padding-top: 48px;">
                        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <img class="img" id="doc_img_"

                                         src="<?php echo e(asset('images/filetype/upload.png')); ?>"
                                         style="width: 100px;height:100px;    padding: 22px;">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-gray"><?php echo e($doc->{'attachment_type_'.lang_character()}); ?></h6>
                                <h4 class="card-title" id="doc_title_"> </h4>
                                <p class="card-description" id="doc_descpt_">

                                </p>

                                <button data-href="<?php echo e(route('attachments.fixed.create',["id"=>$doc->attachment_type_id ?? ""])); ?>"
                                        id="btnFixedFileModal" class="btn btn-sm btn-primary btn-round btn-fab"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Add File">
                                    <i class="material-icons">open_in_browser</i>
                                </button>

                                <button style="display: none" data-href="" id="btnEditFixedFileModal"
                                        class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="tooltip"
                                        data-placement="top" title="" data-original-title="Edit File">
                                    <i class="material-icons">open_in_browser</i>
                                </button>

                                <a href="" rel="tooltip" download
                                   class="btn btn-sm btn-info btn-round btn-fab download_link"
                                   style="display: none"
                                   rel="tooltip" data-original-title=""
                                   title=" <?php echo e($labels['download']??'download'); ?>"
                                   data-placement="top" id="">
                                    <i class="material-icons">cloud_download</i>
                                </a>

                            </div>
                        </div>
                    </div>



                    
                        
                            
                                
                                    
                                
                                    

                                        
                                                
                                                
                                                
                                            
                                        

                                        
                                                
                                                
                                            
                                        

                                        
                                           
                                           
                                           
                                           
                                           
                                            
                                        
                                    
                                    
                                        
                                            
                                    
                                
                            
                            
                                
                                

                            
                            
                                
                                
                            
                        
                    
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>