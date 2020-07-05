<div class="sidebar" data-color="rose" data-background-color="black"
     data-image="<?php echo e(asset('/assets/img/sidebar-1.jpg')); ?>">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="" class="simple-text logo-mini" style="">
            <img style="max-width: 54px;max-height: 50px;"
                 src="<?php echo e(asset('images/user/photo/').'/'.\App\Models\Setting\Setting::organization_logo()); ?>">
        </a>
        <a href=" " class="simple-text logo-normal" style="max-width: 150px;white-space: initial;">
            <?php echo e(\App\Models\Setting\Setting::organization_name()); ?>

        </a>
    </div>
    <div class="sidebar-wrapper">

        <ul class="nav">
            <li class="nav-item  <?php if(Request::segment(1) =='home'): ?> active <?php endif; ?> ">
                <a class="nav-link" href="<?php echo e(route('home')); ?>">
                    <i class="material-icons">dashboard</i>
                    <p>
                        <?php echo e($labels['Dashboard'] ?? 'Dashboard'); ?>

                    </p>
                </a>
            </li>

            <?php if( in_array(210,$userPermissions) || in_array(79,$userPermissions) || Auth::user()->id == 1): ?>
                <li class="nav-item " id="idGoalsSidebar">
                    <a class="nav-link" data-toggle="collapse" href="#GoalsSidebar"
                       <?php if(Request::segment(1) =='strategic' || Request::segment(1) =='goals' ): ?>  aria-expanded="true" <?php endif; ?>
                    >
                        <i class="material-icons">account_balance</i>
                        <p>
                            <?php echo e($labels['organization'] ?? 'organization'); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse   <?php if(Request::segment(1) =='strategic' || Request::segment(1) =='goals' || request()->is('goals/indicators*') || request()->is('goals/sub/*') ): ?> show <?php endif; ?> "
                         id="GoalsSidebar">
                        <ul class="nav">
                            <li class="nav-item" id="id_goals_list">
                                <a class="nav-link" data-toggle="collapse" href="#goals_list">
                                    <i class="material-icons">list</i>
                                    <p>
                                        <?php echo e($labels['goals_list'] ?? 'goals_list'); ?>

                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse    <?php if(Request::segment(1) =='strategic' || Request::segment(1) =='goals'): ?> show <?php endif; ?>"
                                     id="goals_list">
                                    <ul class="nav">

                                        <?php if(in_array(210,$userPermissions) || Auth::user()->id == 1): ?>
                                            <li class="nav-item  <?php if(Request::segment(1) =='strategic'): ?> active <?php endif; ?>"  id="strategic_index">
                                                <a class="nav-link" href="<?php echo e(route('strategic.index')); ?>">
                                                    <i class="material-icons">add</i>
                                                    <span class="sidebar-normal">
                                                       <?php echo e($labels['strategic_index'] ?? 'strategic_index'); ?>

                                                        </span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(in_array(79,$userPermissions) || Auth::user()->id == 1): ?>
                                            <li class="nav-item   <?php if( request()->is('goals/main*') || request()->is('goals/indicators*') || request()->is('goals/sub/*') ): ?> active <?php endif; ?>  "
                                                id="goals">
                                                <a class="nav-link" href="<?php echo e(route('goals.main.index.table')); ?>">
                                                    <i class="material-icons">add</i>
                                                    <span class="sidebar-normal">
                                                          <?php echo e($labels['goals_list'] ?? 'goals_list'); ?>

                                                     </span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>




            <?php endif; ?>

            <?php if(in_array(225,$userPermissions) || in_array(226,$userPermissions)  ||in_array(227,$userPermissions)  ||
            in_array(222,$userPermissions) || in_array(223,$userPermissions)  ||in_array(224,$userPermissions)   ||
            in_array(221,$userPermissions)  ||in_array(102,$userPermissions)  ||
            in_array(42,$userPermissions)    || in_array(232,$userPermissions)    || in_array(152,$userPermissions)    ||
               Auth::user()->id == 1 || in_array(229,$userPermissions)  || in_array(230,$userPermissions)): ?>
                <li class="nav-item " id="idProjectSidebar">
                    <a class="nav-link" data-toggle="collapse" href="#ProjectSidebar"
                       <?php if(
                       request()->is('project/index')   ||     request()->is('project/create') ||  request()->is('project/*/edit')
                       || request()->is('activity/main/index')   ||     request()->is('activity/create/*')
                       ||  request()->is('tasks*')
                       || request()->is('visits*')
                       || request()->is('project/report')
                       || request()->is('project/report/achievement')
                       || request()->is('region/report/index')
                       || request()->is('staff/report/index')
                       || request()->is('activities/report')
                       || request()->is('activities/reportDelay')
                       || request()->is('activities/report/lessons')
                       || request()->is('beneficiary/report/project/index')
                       || request()->is('beneficiary/famindv/report')
                       || request()->is('beneficiary/organization/report')
                        ): ?>  aria-expanded="true" <?php endif; ?>
                    >
                        <i class="material-icons">content_paste</i>
                        <p>
                            <?php echo e($labels['project_management'] ?? 'project_management'); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse
                       <?php if(request()->is('project/index') || request()->is('project/create')||  request()->is('project/*/edit')
                       || request()->is('activity/main/index')   ||     request()->is('activity/create/*')
                       ||   request()->is('tasks*')
                       ||request()->is('visits*')
                       || request()->is('project/report')
                       || request()->is('project/report/achievement')
                       || request()->is('region/report/index')
                       || request()->is('staff/report/index')
                       || request()->is('activities/report')
                       || request()->is('activities/reportDelay')
                       || request()->is('activities/report/lessons')
                       || request()->is('beneficiary/report/project/index')
                       || request()->is('beneficiary/famindv/report')
                       || request()->is('beneficiary/organization/report')
                        ): ?> show <?php endif; ?> " id="ProjectSidebar">
                        <ul class="nav">
                            <?php if(in_array(102,$userPermissions) || Auth::user()->id == 1): ?>
                                <li class="nav-item <?php if(request()->is('project/index')||request()->is('project/create')|| request()->is('project/*/edit')): ?> active <?php endif; ?>"
                                    id="project-index">
                                    <a class="nav-link" id="" href="<?php echo e(route('project.project.index')); ?>">
                                        <i class="material-icons">desktop_windows</i>
                                        <span class="sidebar-normal">
                                          <?php echo e($labels['project_list'] ?? 'project_list'); ?>

                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(42,$userPermissions) || Auth::user()->id == 1): ?>
                                <li class="nav-item <?php if(request()->is('activity/main/index')   ||     request()->is('activity/create/*')  ): ?> active <?php endif; ?>"
                                    id="activities_list">
                                    <a class="nav-link" href="<?php echo e(route('activity.mainActivity.index')); ?>">
                                        <i class="material-icons">check_box_outlined</i>
                                        <span class="sidebar-normal">
                                             <?php echo e($labels['activities_list'] ?? 'activities_list'); ?>

                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(232,$userPermissions) || Auth::user()->id == 1): ?>
                                <li class="nav-item  <?php if( request()->is('tasks*')): ?> active <?php endif; ?>" id="tasks">
                                    <a class="nav-link" href="<?php echo e(route('tasks.index')); ?>">
                                        <i class="material-icons">assessment</i>
                                        <span class="sidebar-normal">
                                           <?php echo e($labels['tasks-link'] ?? 'tasks-link'); ?>

                                       </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(152,$userPermissions) || Auth::user()->id == 1): ?>
                                <li class="nav-item <?php if(request()->is('visits*')): ?> active <?php endif; ?>" id="visit-link">
                                    <a class="nav-link" href="<?php echo e(route('visits.index')); ?>">
                                        <i class="material-icons">developer_board</i>

                                        <span class="sidebar-normal">
                                    <?php echo e($labels['visits'] ?? 'visits'); ?>

                                </span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( Auth::user()->id == 1 || in_array(225,$userPermissions) || in_array(226,$userPermissions)
                                 || in_array(227,$userPermissions) || in_array(222,$userPermissions)  || in_array(223,$userPermissions) ||
                                 in_array(224,$userPermissions)|| in_array(228,$userPermissions)  || in_array(221,$userPermissions)
                                 || in_array(229,$userPermissions)  || in_array(230,$userPermissions)): ?>

                                <li class="nav-item" id="id_reportsSidebar">
                                    <a class="nav-link" data-toggle="collapse" href="#reportsSidebar"
                                       <?php if( request()->is('project/report')
                                          || request()->is('project/report/achievement')
                                          || request()->is('region/report/index')
                                          || request()->is('staff/report/index')
                                          || request()->is('activities/report')
                                          || request()->is('activities/reportDelay')
                                          || request()->is('activities/report/lessons')
                                          || request()->is('beneficiary/report/project/index')
                                          || request()->is('beneficiary/famindv/report')
                                          || request()->is('beneficiary/organization/report')
                                           ): ?>  aria-expanded="true" <?php endif; ?>
                                    >
                                        <i class="material-icons">
                                            trending_up
                                        </i>
                                        <p>
                                            <?php echo e($labels['Sidebar_reports'] ?? 'Sidebar_reports'); ?>

                                            <b class="caret"></b>
                                        </p>

                                    </a>
                                    <div class="collapse <?php if( request()->is('project/report')
                                          || request()->is('project/report/achievement')
                                          || request()->is('region/report/index')
                                          || request()->is('staff/report/index')
                                          || request()->is('activities/report')
                                          || request()->is('activities/reportDelay')
                                          || request()->is('activities/report/lessons')
                                          || request()->is('beneficiary/report/project/index')
                                          || request()->is('beneficiary/famindv/report')
                                          || request()->is('beneficiary/organization/report') ): ?>  show <?php endif; ?> "
                                         id="reportsSidebar">
                                        <ul class="nav">

                                            <?php if( Auth::user()->id == 1 || in_array(228,$userPermissions) ||
                                            in_array(221,$userPermissions)  || in_array(229,$userPermissions)  || in_array(230,$userPermissions) ): ?>
                                                <li class="nav-item " id="id_project-report">
                                                    <a class="nav-link" data-toggle="collapse" href="#project-report" <?php if(request()->is('project/report')
                                                       || request()->is('project/report/achievement')
                                                       || request()->is('region/report/index')
                                                       || request()->is('staff/report/index')): ?>show <?php endif; ?>>
                                                        <i class="material-icons">business_center</i>
                                                        <p>
                                                            <?php echo e($labels['project-report'] ?? 'project-report'); ?>

                                                            <b class="caret"></b>
                                                        </p>
                                                    </a>
                                                    <div class="collapse <?php if(request()->is('project/report')
                                                       || request()->is('project/report/achievement')
                                                       || request()->is('region/report/index')
                                                       || request()->is('staff/report/index')
                                                        ): ?>show <?php endif; ?>" id="project-report">
                                                        <ul class="nav">
                                                            <?php if( Auth::user()->id == 1 || in_array(228,$userPermissions)): ?>
                                                                <li class="nav-item  <?php if(request()->is('project/report')): ?> active <?php endif; ?>"
                                                                    id="project_report">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('project.project.reportProject')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                       <?php echo e($labels['project-report'] ?? 'project-report'); ?>

                                                                    </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if( Auth::user()->id == 1 || in_array(221,$userPermissions)): ?>
                                                                <li class="nav-item <?php if(request()->is('project/report/achievement')): ?> active <?php endif; ?>"
                                                                    id="project_achievement_report">
                                                                    <a class="nav-link  "
                                                                       href="<?php echo e(route('project.report.achievement.report')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                      <?php echo e($labels['project_achievement_report'] ?? 'project_achievement_report'); ?>

                                                                     </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if( Auth::user()->id == 1 || in_array(229,$userPermissions)): ?>

                                                                <li class="nav-item  <?php if(request()->is('region/report/index')): ?> active <?php endif; ?>"
                                                                    id="region_report">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('region.report.index')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                      <?php echo e($labels['region_report'] ?? 'region_report'); ?>

                                                                     </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if( Auth::user()->id == 1 || in_array(230,$userPermissions)): ?>
                                                                <li class="nav-item  <?php if(request()->is('staff/report/index')): ?> active <?php endif; ?>"
                                                                    id="staff_report">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('staff.report.index')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                      <?php echo e($labels['staff_report'] ?? 'staff_report'); ?>

                                                                     </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if( Auth::user()->id == 1 || in_array(222,$userPermissions)  ||  in_array(223,$userPermissions) ||  in_array(224,$userPermissions)): ?>
                                                <li class="nav-item " id="id_activityReport">
                                                    <a class="nav-link" data-toggle="collapse" href="#activityReport"
                                                       <?php if(request()->is('activities/report')
                                                          || request()->is('activities/reportDelay')
                                                          || request()->is('activities/report/lessons')
                                                          ): ?>  show <?php endif; ?> >
                                                        <i class="material-icons">business_center</i>
                                                        <p>
                                                            <?php echo e($labels['activityReport'] ?? 'activityReport'); ?>

                                                            <b class="caret"></b>
                                                        </p>
                                                    </a>
                                                    <div class="collapse <?php if(request()->is('activities/report')
                                                          || request()->is('activities/reportDelay')
                                                          || request()->is('activities/report/lessons')
                                                          ): ?>  show  <?php endif; ?>" id="activityReport">
                                                        <ul class="nav">
                                                            <?php if( Auth::user()->id == 1 || in_array(222,$userPermissions)): ?>
                                                                <li class="nav-item <?php if(request()->is('activities/report')): ?> active <?php endif; ?>"
                                                                    id="activity_report">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('activities.report.activities')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                                                   <?php echo e($labels['activityReport'] ?? 'activityReport'); ?>

                                                                                         </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if( Auth::user()->id == 1 || in_array(223,$userPermissions)): ?>
                                                                <li class="nav-item  <?php if(request()->is('activities/reportDelay')): ?> active <?php endif; ?>"
                                                                    id="activities_report_delay">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('activities.report.activities.delay')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                    <?php echo e($labels['activities_report_delay'] ?? 'activities_report_delay'); ?>

                                                               </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if(in_array(224,$userPermissions) || Auth::user()->id == 1): ?>
                                                                <li class="nav-item <?php if(request()->is('activities/report/lessons')): ?> active <?php endif; ?>"
                                                                    id="activities_report_lessons">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('activities.report.lessons.report')); ?>">
                                                                        <i class="material-icons">
                                                                            supervised_user_circle </i>
                                                                        <span class="sidebar-normal">
                                                                          <?php echo e($labels['activities_report_lessons'] ?? 'activities_report_lessons'); ?>

                                                                       </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if( Auth::user()->id == 1 || in_array(225,$userPermissions) || in_array(226,$userPermissions)
                                                                 || in_array(227,$userPermissions)): ?>
                                                <li class="nav-item " id="id_reportBeneficiary">
                                                    <a class="nav-link" data-toggle="collapse"
                                                       href="#reportBeneficiary">
                                                        <i class="material-icons">settings</i>
                                                        <p>
                                                            <?php echo e($labels['report_beneficiary'] ?? 'report_beneficiary'); ?>

                                                            <b class="caret"></b>
                                                        </p>

                                                    </a>
                                                    <div class="collapse <?php if(request()->is('beneficiary/report/project/index')
                                                                              || request()->is('beneficiary/famindv/report')
                                                                              || request()->is('beneficiary/organization/report') ): ?>  show <?php endif; ?>" id="reportBeneficiary">
                                                        <ul class="nav">

                                                            <?php if( Auth::user()->id == 1 || in_array(227,$userPermissions)): ?>
                                                                <li class="nav-item <?php if(request()->is('beneficiary/report/project/index')): ?> active <?php endif; ?>" id="beneficiary_project">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('beneficiary.report.project.index')); ?>">
                                                                        <i class="material-icons">add</i>
                                                                        <span class="sidebar-normal">
                                                                                           <?php echo e($labels['beneficiary_project'] ?? 'beneficiary_project'); ?></span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>

                                                            <?php if( Auth::user()->id == 1 || in_array(225,$userPermissions)): ?>
                                                                <li class="nav-item  <?php if(request()->is('beneficiary/famindv/report')): ?> active <?php endif; ?> " id="report_families_individuals">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('beneficiary.famindv.report.form')); ?>">
                                                                        <i class="material-icons">add</i>
                                                                        <span class="sidebar-normal">
                                                                       <?php echo e($labels['report_families_individuals'] ?? 'report_families_individuals'); ?>

                                                                     </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if( Auth::user()->id == 1 || in_array(226,$userPermissions)): ?>
                                                                <li class="nav-item   <?php if(request()->is('beneficiary/organization/report')): ?> active <?php endif; ?>"
                                                                    id="report_beneficiary_organization">
                                                                    <a class="nav-link"
                                                                       href="<?php echo e(route('beneficiary.organization.report.form')); ?>">
                                                                        <i class="material-icons">add</i>
                                                                        <span class="sidebar-normal">
                                                                         <?php echo e($labels['report_beneficiary_organization'] ?? 'report_beneficiary_organization'); ?>

                                                                       </span>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>

                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </div>
                </li>
            <?php endif; ?>





            <?php if(in_array(175 ,$userPermissions) || in_array(217,$userPermissions) ||in_array(160,$userPermissions)  ||
             in_array(140,$userPermissions) || in_array(5,$userPermissions) || in_array(8,$userPermissions) ||
              in_array(147,$userPermissions) || in_array(115,$userPermissions) || in_array(156,$userPermissions) ||
               in_array(148,$userPermissions)|| in_array(90,$userPermissions)   || in_array(119,$userPermissions)||
                in_array(124,$userPermissions)|| in_array(209,$userPermissions) ||in_array(22,$userPermissions) ||
                  in_array(27,$userPermissions)|| in_array(14,$userPermissions) ||in_array(31,$userPermissions) ||
                  in_array(18,$userPermissions) || in_array(69,$userPermissions) || in_array(75,$userPermissions) ||
                    in_array(233,$userPermissions) || Auth::user()->id == 1): ?>

                <li class="nav-item " id="idSettingsSidebar">
                    <a class="nav-link" data-toggle="collapse" href="#SettingsSidebar"
                       <?php if( request()->is('jobtitle*')
                     ||   request()->is('staff*')
                        || request()->is('projectcategories/*')
                        || request()->is('donors/types/*')
                        || request()->is('donors/*')
                        || request()->is('settings/cities*')
                        || request()->is('settings/districts*')
                        || request()->is('beneficiary/fam_indev*')
                        || request()->is('beneficiary/oraganizations*')
                        || request()->is('locality*')
                        || request()->is('settings/issues/related*')
                        || request()->is('settings/issues/type*')
                        || request()->is('settings/currency*')
                        || request()->is('settings/incomeRange*')
                        || request()->is('settings/attachment_types*')
                        || request()->is('goals/indicators/measure/units/index*')
                        || request()->is('attachments*')
                        || request()->is('permission/user/index*')
                        || request()->is('permission/group*')
                        || request()->is('settings/general*')
                        || request()->is('settings/notifications*')
                       ): ?>  aria-expanded="true" <?php endif; ?>
                    >
                        <i class="material-icons">settings</i>
                        <p>
                            <?php echo e($labels['settings'] ?? 'settings'); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse  <?php if( request()->is('jobtitle/*')
                || request()->is('staff/*')
                || request()->is('projectcategories/*')
                || request()->is('donors/types/*')
                || request()->is('donors/*')
                || request()->is('settings/cities*')
                || request()->is('settings/districts*')
                || request()->is('beneficiary/fam_indev*')
                || request()->is('beneficiary/oraganizations*')
                || request()->is('locality*')
                || request()->is('settings/issues/related*')
                || request()->is('settings/issues/type*')
                || request()->is('settings/currency*')
                || request()->is('settings/incomeRange*')
                || request()->is('settings/attachment_types*')
                || request()->is('goals/indicators/measure/units/index*')
                || request()->is('attachments*')
                || request()->is('permission/user/index*')
                || request()->is('permission/group*')
                || request()->is('settings/general*')
                || request()->is('settings/notifications*')
               ): ?>  show <?php endif; ?>" id="SettingsSidebar">
                        <ul class="nav">

                            <?php if(in_array(31,$userPermissions) || in_array(18,$userPermissions) || in_array(14,$userPermissions) || Auth::user()->id == 1): ?>
                                <li class="nav-item " id="id_staffSidebar">
                                    <a class="nav-link" data-toggle="collapse" href="#staffSidebar">
                                        <i class="material-icons">settings</i>
                                        <p>
                                            <?php echo e($labels['our_organization'] ?? 'our_organization'); ?>

                                            <b class="caret"></b>
                                        </p>
                                    </a>

                                    <div class="collapse <?php if( request()->is('jobtitle/*')
                || request()->is('staff/*')
                || request()->is('projectcategories/*') ): ?>  show <?php endif; ?>" id="staffSidebar">
                                        <ul class="nav">
                                            <?php if(in_array(14,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item   <?php if( request()->is('jobtitle/*')): ?> active <?php endif; ?>"
                                                    id="job_title">
                                                    <a class="nav-link" href="<?php echo e(route('project.jobtitle.index')); ?>">
                                                        <i class="material-icons">work</i>
                                                        <span class="sidebar-normal">
                                                             <?php echo e($labels['job_title'] ?? 'job_title'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(31,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if( request()->is('staff/*')): ?> active <?php endif; ?>"
                                                    id="staff-link">
                                                    <a class="nav-link" href="<?php echo e(route('project.staff.index')); ?>">
                                                        <i class="material-icons">person</i>
                                                        <span class="sidebar-normal">
                                                           <?php echo e($labels['staff-link'] ?? 'staff-link'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(in_array(18,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if( request()->is('projectcategories/*')): ?> active <?php endif; ?>"
                                                    id="project_category">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('project.projectcategories.index')); ?>">
                                                        <i class="material-icons">local_offer</i>
                                                        <span class="sidebar-normal">
                                                            <?php echo e($labels['project_category'] ?? 'project_category'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if(in_array(22,$userPermissions)||in_array(27,$userPermissions)|| Auth::user()->id == 1): ?>
                                
                                <li class="nav-item " id="id_funders_setting">
                                    <a class="nav-link" data-toggle="collapse" href="#funders_setting">
                                        <i class="material-icons">settings</i>
                                        <p>
                                            <?php echo e($labels['funders_setting'] ?? 'funders_setting'); ?>

                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse <?php if(request()->is('donors/types/*')
                                || request()->is('donors/*') ): ?>  show <?php endif; ?>" id="funders_setting">
                                        <ul class="nav">
                                            <?php if(in_array(27,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item <?php if(request()->is('donors/types/*')): ?> active <?php endif; ?>"
                                                    id="donor_types">
                                                    <a class="nav-link" href="<?php echo e(route('project.donors.types.index')); ?>">
                                                        <i class="material-icons"> business </i>
                                                        <span class="sidebar-normal"><?php echo e($labels['donor_types'] ?? 'donor_types'); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(22,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('donors/*')): ?> active  <?php endif; ?>"
                                                    id="donors1">
                                                    <a class="nav-link" href="<?php echo e(route('project.donors.index')); ?>">
                                                        <i class="material-icons"> supervised_user_circle </i>
                                                        <span class="sidebar-normal">
                                                          <?php echo e($labels['donors-link'] ?? 'donors-link'); ?>

                                                            </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if(in_array(124,$userPermissions)|| in_array(209,$userPermissions)|| Auth::user()->id == 1): ?>
                                
                                <li class="nav-item " id="id_regons">
                                    <a class="nav-link" data-toggle="collapse" href="#regons">
                                        <i class="material-icons">settings</i>
                                        <p>
                                            <?php echo e($labels['regons'] ?? 'regons'); ?>

                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse <?php if(request()->is('settings/cities*')
                            || request()->is('settings/districts*') ): ?>  show <?php endif; ?>" id="regons">
                                        <ul class="nav">
                                            <?php if(in_array(209,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item <?php if(request()->is('settings/cities*')): ?> active <?php endif; ?>"
                                                    id="city-link">
                                                    <a class="nav-link" href="<?php echo e(route('settings.cities')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                       <?php echo e($labels['city-link'] ?? 'city-link'); ?>

                                                       </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(124,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('settings/districts*')): ?> active <?php endif; ?>"
                                                    id="districts-link">
                                                    <a class="nav-link" href="<?php echo e(route('settings.districts')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                   <?php echo e($labels['districts-link'] ?? 'districts-link'); ?>

                                                   </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>


                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                            

                            <?php if(in_array(69,$userPermissions) || in_array(75,$userPermissions) || in_array(202,$userPermissions) || Auth::user()->id == 1): ?>
                                <li class="nav-item " id="id_BeneficiarySidebar">
                                    <a class="nav-link" data-toggle="collapse" href="#BeneficiarySidebar">
                                        <i class="material-icons">settings</i>
                                        <p>
                                            <?php echo e($labels['beneficiaries'] ?? 'beneficiaries'); ?>

                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse <?php if(request()->is('beneficiary/fam_indev*')
                                            || request()->is('beneficiary/oraganizations*')
                                            || request()->is('locality*')  ): ?>  show <?php endif; ?>" id="BeneficiarySidebar">
                                        <ul class="nav">


                                            <?php if(in_array(69,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('beneficiary/fam_indev*')): ?> active <?php endif; ?>" id="families_individuals">
                                                    <a class="nav-link" href="<?php echo e(route('beneficiary.fam_indev.index')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                          <?php echo e($labels['families_individuals'] ?? 'families_individuals'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(75,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item   <?php if(request()->is('beneficiary/oraganizations*')): ?> active <?php endif; ?>" id="organizations">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('beneficiary.oraganizations.index')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                           <?php echo e($labels['organizations'] ?? 'organizations'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(202,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item <?php if(request()->is('locality*')): ?> active <?php endif; ?>" id="Localities-link">
                                                    <a class="nav-link" href="<?php echo e(route('locality')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                           <?php echo e($labels['Localities-link'] ?? 'Localities-link'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>


                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>
                            
                            <?php if(in_array(175,$userPermissions) || in_array(217,$userPermissions) || in_array(160,$userPermissions )  ||
                                   in_array(140,$userPermissions )  || in_array(156,$userPermissions )  || in_array(90,$userPermissions )  ||Auth::user()->id == 1): ?>

                                <li class="nav-item " id="id_other_setting">
                                    <a class="nav-link" data-toggle="collapse" href="#other_setting">
                                        <i class="material-icons">settings</i>
                                        <p>
                                            <?php echo e($labels['project_setting'] ?? 'project_setting'); ?>

                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse <?php if(request()->is('settings/issues/related*')
                                            || request()->is('settings/issues/type*')
                                            || request()->is('settings/currency*')
                                            || request()->is('settings/incomeRange*')
                                            || request()->is('settings/attachment_types*')
                                            || request()->is('goals/indicators/measure/units/index*')  ): ?>  show <?php endif; ?>" id="other_setting">
                                        <ul class="nav">
                                            <?php if(in_array(175,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item <?php if(request()->is('settings/issues/related*')): ?> active <?php endif; ?>" id="activity_lessons_related">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('activity.lessons.related')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                    <?php echo e($labels['activity_lessons_related'] ?? 'activity_lessons_related'); ?>

                                                </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(217,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('settings/issues/type*')): ?> active <?php endif; ?>" id="activity_lessons_type">
                                                    <a class="nav-link" href="<?php echo e(route('activity.lessons.type')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                    <?php echo e($labels['activity_lessons_type'] ?? 'activity_lessons_type'); ?>

                                                </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(160,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('settings/currency*')): ?> active <?php endif; ?>" id="currency-link">
                                                    <a class="nav-link" href="<?php echo e(route('settings.currency')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                   <?php echo e($labels['currency-link'] ?? 'currency-link'); ?>

                                                   </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(140,$userPermissions)|| Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('settings/incomeRange*')): ?> active <?php endif; ?>" id="incomeRange-link">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('settings.incomeRange.index')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                              <?php echo e($labels['incomeRange-link'] ?? 'incomeRange-link'); ?>

                                                         </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(156,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item   <?php if(request()->is('settings/attachment_types*')): ?> active <?php endif; ?>" id="attachment_types-link">
                                                    <a class="nav-link" href="<?php echo e(route('settings.attachment_types')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                    <?php echo e($labels['attachment_types-link'] ?? 'attachment_types-link'); ?>

                                                   </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(90,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('goals/indicators/measure/units/index*')): ?> active <?php endif; ?>" id="indicators_measure_unit">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('goals.indicators.measure.unit.index')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                   <?php echo e($labels['indicators_measure_unit'] ?? 'indicators_measure_unit'); ?>

                                                   </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>


                            <?php if(in_array(115,$userPermissions) || in_array(5,$userPermissions) || in_array(8,$userPermissions )
                             || in_array(233,$userPermissions )  ||     in_array(119,$userPermissions )  ||Auth::user()->id == 1): ?>
                                <li class="nav-item " id="id_system_setting">
                                    <a class="nav-link" data-toggle="collapse" href="#system_setting">
                                        <i class="material-icons">settings</i>
                                        <p>
                                            <?php echo e($labels['system_setting'] ?? 'system_setting'); ?>

                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <div class="collapse <?php if(request()->is('attachments*')
                                    || request()->is('permission/user/index*')
                                    || request()->is('permission/group*')
                                    || request()->is('settings/general*')
                                    || request()->is('settings/notifications*')): ?>  show <?php endif; ?>" id="system_setting">
                                        <ul class="nav">
                                            <?php if(in_array(115,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item <?php if(request()->is('attachments*')): ?> active <?php endif; ?>" id="files_management">
                                                    <a class="nav-link" href="<?php echo e(route('attachments.index')); ?>">
                                                        <i class="material-icons">cloud_upload</i>
                                                        <span class="sidebar-normal">
                                                            <?php echo e($labels['files_management'] ?? 'files_management'); ?>

                                                        </span>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(5,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('permission/user/index*')): ?> active <?php endif; ?>" id="user">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('permission.user.index')); ?>">
                                                        <i class="material-icons"> people </i>
                                                        <span class="sidebar-normal"><?php echo e($labels['user'] ?? 'user'); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(8,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('permission/group*')): ?> active <?php endif; ?>" id="group">
                                                    <a class="nav-link"
                                                       href="<?php echo e(route('permission.group.index')); ?>">
                                                        <i class="material-icons"> group_work </i>
                                                        <span class="sidebar-normal"><?php echo e($labels['group'] ?? 'group'); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(233,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('settings/general*')): ?> active <?php endif; ?>" id="settings">
                                                    <a class="nav-link" href="<?php echo e(route('settings.index')); ?>">
                                                        <i class="material-icons">settings</i>
                                                        <span class="sidebar-normal">
                                                            <?php echo e($labels['general_settings'] ?? 'general_settings'); ?>

                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array(119,$userPermissions) || Auth::user()->id == 1): ?>
                                                <li class="nav-item  <?php if(request()->is('settings/notifications*')): ?> active <?php endif; ?>" id="notifications-link">
                                                    <a class="nav-link" href="<?php echo e(route('settings.notifications')); ?>">
                                                        <i class="material-icons">add</i>
                                                        <span class="sidebar-normal">
                                                       <?php echo e($labels['notifications-link'] ?? 'notifications-link'); ?>

                                                   </span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

