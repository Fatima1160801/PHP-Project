<div class="sidebar" data-color="rose" data-background-color="black"
     data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
    Tip 2: you can also add an image using data-image tag
-->


  <div class="logo">
    <a href="" class="simple-text logo-mini" style="">
      <img style="max-width: 54px;max-height: 50px;"
           src="{{asset('images/user/photo/').'/'.\App\Models\Setting\Setting::organization_logo()}}">
    </a>
    <a href=" " class="simple-text logo-normal" style="max-width: 150px;white-space: initial;">
      {{ \App\Models\Setting\Setting::organization_name() }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <form class="bd-search d-flex align-items-center">
      <span class="algolia-autocomplete algolia-autocomplete-left"
            style=" margin: 10px;width: 100%;background-color: #000000b3; ">
        <input type="search"
               class="form-control ds-input"
               id="search-input"
               placeholder="Search..."
                autocomplete="off"  style="color: white !important;padding: 6px;font-size: 15px !important;" >
       </span>

    </form>

    <ul class="nav">


      <li class="nav-item  @if(Request::segment(1) =='home') active @endif ">
        <a class="nav-link" href="{{route('home')}}">
          <i class="material-icons">dashboard</i>
          <p>
            {{$labels['Dashboard'] ?? 'Dashboard'}}
          </p>
        </a>
      </li>



        <li class="nav-item " id="idSettingsSidebar">
          <a class="nav-link"  href="{{route("optstatuses.index")}}"
              >
            <i class="material-icons">settings</i>
            <p>
              {{$labels['opportunity_status'] ?? 'opportunity status'}}

            </p>
          </a>

        </li>

      <li class="nav-item " id="idSettingsSidebar">
        <a class="nav-link"  href="{{route("interfaces.index")}}"
        >
          <i class="material-icons">settings</i>
          <p>
            {{$labels['interfaces'] ?? 'interfaces'}}
            
          </p>
        </a>

      </li>

      @if(in_array(175 ,$userPermissions) || in_array(217,$userPermissions) ||in_array(160,$userPermissions)  ||
       in_array(140,$userPermissions) || in_array(5,$userPermissions) || in_array(8,$userPermissions) ||
        in_array(147,$userPermissions) || in_array(115,$userPermissions) || in_array(156,$userPermissions) ||
         in_array(148,$userPermissions)|| in_array(90,$userPermissions)   || in_array(119,$userPermissions)||
          in_array(124,$userPermissions)|| in_array(209,$userPermissions) ||in_array(22,$userPermissions) ||
            in_array(27,$userPermissions)|| in_array(14,$userPermissions) ||in_array(31,$userPermissions) ||
            in_array(18,$userPermissions)||
              in_array(233,$userPermissions)  ||  in_array(124,$userPermissions) || Auth::user()->id == 1)

        <li class="nav-item " id="idSettingsSidebar">
          <a class="nav-link" data-toggle="collapse" href="#SettingsSidebar"
             @if( request()->is('jobtitle*')
           ||   request()->is('staff*')
              || request()->is('projectcategories/*')
              || request()->is('donors/types/*')
              || request()->is('donors/*')
              || request()->is('settings/cities*')
              || request()->is('settings/districts*')

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
              || request()->is('settings/email/*')
              || request()->is('settings/notifications*')
             )  aria-expanded="true" @endif
          >
            <i class="material-icons">settings</i>
            <p>
              {{$labels['settings'] ?? 'settings'}}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse  @if( request()->is('jobtitle/*')
                || request()->is('staff/*')
                || request()->is('projectcategories/*')
                || request()->is('donors/types/*')
                || request()->is('donors/*')
                || request()->is('settings/cities*')
                || request()->is('settings/districts*')

                || request()->is('procurement/screen/setting*')
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
                || request()->is('documents/settings*')
                || request()->is('settings/achievement/type*')
                || request()->is('settings/visit/type/*')
                || request()->is('settings/email/*')

               )  show @endif" id="SettingsSidebar">
            <ul class="nav">

              @if(in_array(31,$userPermissions) || in_array(18,$userPermissions) || in_array(14,$userPermissions) || Auth::user()->id == 1)
                <li class="nav-item " id="id_staffSidebar">
                  <a class="nav-link" data-toggle="collapse" href="#staffSidebar">
                    <i class="material-icons">settings</i>
                    <p>
                      {{$labels['our_organization'] ?? 'our_organization'}}
                      <b class="caret"></b>
                    </p>
                  </a>

                  <div class="collapse @if( request()->is('jobtitle/*')
                || request()->is('staff/*')
                || request()->is('projectcategories/*') )  show @endif" id="staffSidebar">
                    <ul class="nav">
                      @if(in_array(14,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item   @if( request()->is('jobtitle/*')) active @endif"
                            id="job_title">
                          <a class="nav-link" href="{{route('project.jobtitle.index')}}">
                            <i class="material-icons">work</i>
                            <span class="sidebar-normal">
                                                             {{$labels['job_title'] ?? 'job_title'}}
                                                        </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(31,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if( request()->is('staff/*')) active @endif"
                            id="staff-link">
                          <a class="nav-link" href="{{route('project.staff.index')}}">
                            <i class="material-icons">person</i>
                            <span class="sidebar-normal">
                                                           {{$labels['staff-link'] ?? 'staff-link'}}
                                                        </span>
                          </a>
                        </li>
                      @endif

                      @if(in_array(18,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if( request()->is('projectcategories/*')) active @endif"
                            id="project_category">
                          <a class="nav-link"
                             href="{{route('project.projectcategories.index')}}">
                            <i class="material-icons">local_offer</i>
                            <span class="sidebar-normal">
                                                            {{$labels['project_category'] ?? 'project_category'}}
                                                        </span>
                          </a>
                        </li>
                      @endif

                    </ul>
                  </div>
                </li>
              @endif

              @if(in_array(22,$userPermissions)||in_array(27,$userPermissions)|| Auth::user()->id == 1)
                {{--Funders Setting:--}}
                <li class="nav-item " id="id_funders_setting">
                  <a class="nav-link" data-toggle="collapse" href="#funders_setting">
                    <i class="material-icons">settings</i>
                    <p>
                      {{$labels['funders_setting'] ?? 'funders_setting'}}
                      <b class="caret"></b>
                    </p>
                  </a>
                  <div class="collapse @if(request()->is('donors/types/*')
                                || request()->is('donors/*') )  show @endif" id="funders_setting">
                    <ul class="nav">
                      @if(in_array(27,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item @if(request()->is('donors/types/*')) active @endif"
                            id="donor_types">
                          <a class="nav-link" href="{{route('project.donors.types.index')}}">
                            <i class="material-icons"> business </i>
                            <span class="sidebar-normal">{{$labels['donor_types'] ?? 'donor_types'}}</span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(22,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('donors/*')) active  @endif"
                            id="donors1">
                          <a class="nav-link" href="{{route('project.donors.index')}}">
                            <i class="material-icons"> supervised_user_circle </i>
                            <span class="sidebar-normal">
                                                          {{$labels['donors-link'] ?? 'donors-link'}}
                                                            </span>
                          </a>
                        </li>
                      @endif

                    </ul>
                  </div>
                </li>
              @endif

              @if(in_array(124,$userPermissions)|| in_array(209,$userPermissions)|| Auth::user()->id == 1)
                {{--Regons:--}}
                <li class="nav-item " id="id_regons">
                  <a class="nav-link" data-toggle="collapse" href="#regons">
                    <i class="material-icons">settings</i>
                    <p>
                      {{$labels['regons'] ?? 'regons'}}
                      <b class="caret"></b>
                    </p>
                  </a>
                  <div class="collapse @if(request()->is('settings/cities*')
                            || request()->is('settings/districts*') )  show @endif" id="regons">
                    <ul class="nav">
                      @if(in_array(209,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item @if(request()->is('settings/cities*')) active @endif"
                            id="city-link">
                          <a class="nav-link" href="{{route('settings.cities')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                       {{$labels['city-link'] ?? 'city-link'}}
                                                       </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(124,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('settings/districts*')) active @endif"
                            id="districts-link">
                          <a class="nav-link" href="{{route('settings.districts')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                   {{$labels['districts-link'] ?? 'districts-link'}}
                                                   </span>
                          </a>
                        </li>
                      @endif


                    </ul>
                  </div>
                </li>
              @endif
              {{--Other Setting:--}}

              @if(in_array(175,$userPermissions) || in_array(217,$userPermissions) || in_array(160,$userPermissions )  ||
                     in_array(140,$userPermissions )  || in_array(156,$userPermissions )  || in_array(90,$userPermissions ) || in_array(124,$userPermissions ) ||Auth::user()->id == 1)

                <li class="nav-item " id="id_other_setting">
                  <a class="nav-link" data-toggle="collapse" href="#other_setting">
                    <i class="material-icons">settings</i>
                    <p>
                      {{$labels['project_setting'] ?? 'project_setting'}}
                      <b class="caret"></b>
                    </p>
                  </a>
                  <div class="collapse @if(request()->is('settings/issues/related*')
                                            || request()->is('settings/issues/type*')

                                            || request()->is('brands*')
                                            || request()->is('sectors*')
                                            || request()->is('procurement/screen/setting')

                                            || request()->is('settings/currency*')
                                            || request()->is('settings/incomeRange*')
                                            || request()->is('settings/attachment_types*')
                                            || request()->is('optstatuses*')
                                            || request()->is('documents/settings*')
                                            || request()->is('settings/achievement/type*')
                                            || request()->is('settings/email/*')
                                            || request()->is('settings/visit/type/*')
                                            || request()->is('goals/indicators/measure/units/index*')  )  show @endif"
                       id="other_setting">
                    <ul class="nav">
                      @if(in_array(175,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item @if(request()->is('settings/issues/related*')) active @endif"
                            id="activity_lessons_related">
                          <a class="nav-link"
                             href="{{route('activity.lessons.related')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                    {{$labels['activity_lessons_related'] ?? 'activity_lessons_related'}}
                                                </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(217,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('settings/issues/type*')) active @endif"
                            id="activity_lessons_type">
                          <a class="nav-link" href="{{route('activity.lessons.type')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                    {{$labels['activity_lessons_type'] ?? 'activity_lessons_type'}}
                                                </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(160,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('settings/currency*')) active @endif"
                            id="currency-link">
                          <a class="nav-link" href="{{route('settings.currency')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                   {{$labels['currency-link'] ?? 'currency-link'}}
                                                   </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(140,$userPermissions)|| Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('settings/incomeRange*')) active @endif"
                            id="incomeRange-link">
                          <a class="nav-link"
                             href="{{route('settings.incomeRange.index')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                              {{$labels['incomeRange-link'] ?? 'incomeRange-link'}}
                                                         </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(156,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item   @if(request()->is('settings/attachment_types*')) active @endif"
                            id="attachment_types-link">
                          <a class="nav-link" href="{{route('settings.attachment_types')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                    {{$labels['attachment_types-link'] ?? 'attachment_types-link'}}
                                                   </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(90,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('goals/indicators/measure/units/index*')) active @endif"
                            id="indicators_measure_unit">
                          <a class="nav-link"
                             href="{{route('goals.indicators.measure.unit.index')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                   {{$labels['indicators_measure_unit'] ?? 'indicators_measure_unit'}}
                                                   </span>
                          </a>
                        </li>
                      @endif
                      {{--                                                @if(in_array(90,$userPermissions) || Auth::user()->id == 1)--}}
                      {{--                                                    <li class="nav-item  @if(request()->is('/optstatuses*')) active @endif" id="optstatuses">--}}
                      {{--                                                        <a class="nav-link"--}}
                      {{--                                                           href="{{route('optstatuses.index')}}">--}}
                      {{--                                                            <i class="material-icons">add</i>--}}
                      {{--                                                            <span class="sidebar-normal">--}}
                      {{--                                                          {{$labels['addOppStatus'] ?? 'Opportunity Status'}}--}}
                      {{--                                                   </span>--}}
                      {{--                                                        </a>--}}
                      {{--                                                    </li>--}}
                      {{--                                                @endif--}}

                      {{--                                                @if(in_array(90,$userPermissions) || Auth::user()->id == 1)--}}
                      {{--                                                    <li class="nav-item  @if(request()->is('/oppsources*')) active @endif" id="oppsources">--}}
                      {{--                                                        <a class="nav-link"--}}
                      {{--                                                           href="{{route('oppsources.index')}}">--}}
                      {{--                                                            <i class="material-icons">add</i>--}}
                      {{--                                                            <span class="sidebar-normal">--}}
                      {{--                                                           {{$labels['addOpportunitySource'] ?? 'Opportunity Source'}}--}}
                      {{--                                                   </span>--}}
                      {{--                                                        </a>--}}
                      {{--                                                    </li>--}}
                      {{--                                                @endif--}}

                      {{--                                                @if(in_array(90,$userPermissions) || Auth::user()->id == 1)--}}
                      {{--                                                    <li class="nav-item  @if(request()->is('/interfaces*')) active @endif" id="interfaces">--}}
                      {{--                                                        <a class="nav-link"--}}
                      {{--                                                           href="{{route('interfaces.index')}}">--}}
                      {{--                                                            <i class="material-icons">add</i>--}}
                      {{--                                                            <span class="sidebar-normal">--}}
                      {{--                                                            {{$labels['addInterface'] ?? 'Add Interface'}}--}}
                      {{--                                                   </span>--}}
                      {{--                                                        </a>--}}
                      {{--                                                    </li>--}}
                      {{--                                                @endif--}}

                      @if(in_array(90,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('/labelsSettings*')) active @endif"
                            id="labelsSettings">
                          <a class="nav-link"
                             href="{{route('labelsSettings.index')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                            {{$labels['Label_Settings'] ?? 'Label Settings'}}
                                                   </span>
                          </a>
                        </li>
                      @endif

                      @if(in_array(124,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('/settings/email/*')) active @endif"
                            id="EmailSettings">
                          <a class="nav-link"
                             href="{{route('settings.email.index')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                            {{$labels['Email_Settings'] ?? 'Email Settings'}}
                                                   </span>
                          </a>
                        </li>
                      @endif

                      @if(in_array(90,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('documents/settings*')) active @endif"
                            id="DocumentSettings">
                          <a class="nav-link"
                             href="{{route('settings.documents.index')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                            {{$labels['doc_settings'] ?? 'Document Settings'}}
                                                   </span>
                          </a>
                        </li>
                      @endif


                      <li class="nav-item @if(request()->is('settings/achievement/type*')) active @endif"
                          id="achievementtypeSettings">
                        <a class="nav-link" href="{{route('settings.achievement.type')}}">
                          <i class="material-icons">add</i>
                          <span class="sidebar-normal">
                                                       {{$labels['achievement_type'] ?? 'achievement_type'}}
                                                       </span>
                        </a>
                      </li>


                      <li class="nav-item @if(request()->is('settings/visit/type/*')) active @endif"
                          id="visittypeSettings">
                        <a class="nav-link" href="{{url('settings/visit/type/index')}}">
                          <i class="material-icons">add</i>
                          <span class="sidebar-normal">
                                   {{$labels['visit_type'] ?? 'visit_type'}}
                             </span>
                        </a>
                      </li>

                      <li class="nav-item @if(request()->is('procurement/screen/setting')) active @endif"
                          id="visittypeSettings">
                        <a class="nav-link" href="{{route('screen.index')}}">
                          <i class="material-icons">add</i>
                          <span class="sidebar-normal">
                               {{$labels['procurement_settings'] ?? 'Procurement Settings'}}
                         </span>
                        </a>
                      </li>


                    </ul>
                  </div>
                </li>
              @endif


              @if(in_array(115,$userPermissions) || in_array(5,$userPermissions) || in_array(8,$userPermissions )
               || in_array(233,$userPermissions )  ||     in_array(119,$userPermissions ) || in_array(124,$userPermissions ) ||Auth::user()->id == 1)
                <li class="nav-item " id="id_system_setting">
                  <a class="nav-link" data-toggle="collapse" href="#system_setting">
                    <i class="material-icons">settings</i>
                    <p>
                      {{$labels['system_setting'] ?? 'system_setting'}}
                      <b class="caret"></b>
                    </p>
                  </a>
                  <div class="collapse @if(request()->is('attachments*')
                                    || request()->is('permission/user/index*')
                                    || request()->is('permission/group*')
                                    || request()->is('settings/general*')
                                    || request()->is('settings/email/*')
                                    || request()->is('settings/notifications*'))  show @endif" id="system_setting">
                    <ul class="nav">
                      @if(in_array(115,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item @if(request()->is('attachments*')) active @endif"
                            id="files_management">
                          <a class="nav-link" href="{{route('attachments.index')}}">
                            <i class="material-icons">cloud_upload</i>
                            <span class="sidebar-normal">
                                                            {{$labels['files_management'] ?? 'files_management'}}
                                                        </span>

                          </a>
                        </li>
                      @endif
                      @if(in_array(5,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('permission/user/index*')) active @endif"
                            id="user">
                          <a class="nav-link"
                             href="{{route('permission.user.index')}}">
                            <i class="material-icons"> people </i>
                            <span class="sidebar-normal">{{$labels['user'] ?? 'user'}}</span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(8,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('permission/group*')) active @endif"
                            id="group">
                          <a class="nav-link"
                             href="{{route('permission.group.index')}}">
                            <i class="material-icons"> group_work </i>
                            <span class="sidebar-normal">{{$labels['group'] ?? 'group'}}</span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(233,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('settings/general*')) active @endif"
                            id="settings">
                          <a class="nav-link" href="{{route('settings.index')}}">
                            <i class="material-icons">settings</i>
                            <span class="sidebar-normal">
                                                            {{$labels['general_settings'] ?? 'general_settings'}}
                                                        </span>
                          </a>
                        </li>
                      @endif
                      @if(in_array(119,$userPermissions) || Auth::user()->id == 1)
                        <li class="nav-item  @if(request()->is('settings/notifications*')) active @endif"
                            id="notifications-link">
                          <a class="nav-link" href="{{route('settings.notifications')}}">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">
                                                       {{$labels['notifications-link'] ?? 'notifications-link'}}
                                                   </span>
                          </a>
                        </li>
                      @endif
                    </ul>
                  </div>
                </li>
              @endif

            </ul>
          </div>
        </li>
      @endif

    </ul>
  </div>
</div>

