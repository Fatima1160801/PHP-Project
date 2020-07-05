
<div class="card">
  <header class="card-header bg-primary ">
    <a href="#" data-toggle="collapse" data-target="#collapseModule<?php echo e($achievementType->id); ?>"
       aria-expanded="true" class="">
      <i class="icon-action fa fa-chevron-down text-white"></i>
      <span class="title "> <?php echo e($achievementType->{'achivement_type_'.lang_character1()}); ?> </span>
    </a>
  </header>
  <div class="collapse   show  " id="collapseModule<?php echo e($achievementType->id); ?>" style="">
    <article class="card-body">
      <a href="#" data-achievement_type="<?php echo e($achievementType->id); ?>"
         class="btn btn-round btn-primary btn-fab btn-sm addBeneficiaryToAchievement"
         data-toggle="modal" data-target="#modalAchievementBeneficiary">
        <i class="fa fa-plus"></i>
      </a>

      <div class="col-md-12" id="achievementBeneficiaryTable_<?php echo e($achievementType->id); ?>">

      </div>

    </article> <!-- card-body.// -->
  </div> <!-- collapse .// -->
</div> <!-- card.// -->
