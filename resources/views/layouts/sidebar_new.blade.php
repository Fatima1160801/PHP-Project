<style>
    .sidebar{
        width: 130px !important;
    }
    .sidebar-wrapper{
        width: 130px !important;
    }
    .sidebar-background:after {
        /*background: #04365f !important;*/
        background: #1f1e2e !important;
        opacity: 1;

    }
    .sidebar-background {
        background-image:none !important;
    }
    .navbar-dark{
        box-shadow: none !important;
    }
    .main-panel {
        width: calc(100% - 140px);
    }
    .card .card-header{
        z-index: 0 !important;
    }
    .sidebar .logo:after{
        display: none !important;
    }
    .sidebar-wrapper .ps-scrollbar-y{
        top: 0px !important;
        height: 0px !important;
    }
    .mainli .dropdown-menu .dropdown-item{
        margin: 0px !important;
        padding: 10px !important;
        border:none;
    }
    .mainli .dropdown-menu .dropdown-item a{
        margin: auto;
    }
    .mainli:hover i{
        color:#3699ff !important;
    }
    .mainli:hover span{
        color:#fff !important;
    }

    .title-content-sp{
        /*margin: auto !important;*/
    }
    .main-a-tag:active,.main-a-tag:focus,.main-a-tag:visited{/*.main-a-tag:hover**/
        /*background: #1b1b28;*/
    }

    .mainli .dropdown-menu a:active,.mainli .dropdown-menu a:focus,.mainli .dropdown-menu a:visited,.mainli .dropdown-menu a:hover{/*.main-a-tag:hover**/
        /*background: #1b1b28 !important;*/
    }
    .mainli:active,.mainli:focus,.mainli:visited,.mainli:hover{/*.main-a-tag:hover**/
        background:#151521 ; !important;
    }

    .proposal-writing{
        margin-top: -8px !important;
        padding-top: 0px !important;
    }
    .submenu a{
        font-size: 12px !important;
    }
    .submenu li{
        box-shadow: none !important;
    }
    .sidebar .ps-container{
        overflow: initial !important;
    }
    .mainli a{
        font-size: 14px !important;
    }
    .mainli{
        margin-top: 5px;
        margin-bottom: 5px;
        /*background: #1f1e2e; !*1d344a;*!*/
        border-radius: 10px;
        /*height: 100px;*/
        /*min-height: 100px;*/
        /*max-height: 100px;*/
    }
    .main-a-tag i{
        /*font-size: 24px !important;*/
        font-size: 1.5rem !important;
        margin-bottom: 10px;
        color: #494b74;
    }

    .modern-menu{
        margin-left: 5%;
    }
    .main-a-tag{
        margin-top: 10px !important;
        color: #a2a3b7 !important;

    }
    .submenu{
        left: 112px !important;
        position: absolute !important;
        top: 0px !important;
    }
    .ps-scrollbar-y-rail{
        height: auto !important;
    }
    .navbar .collapse .navbar-nav .nav-item .nav-link{
        margin-left: 0px !important;
    }
    #navigation-example{
        border-bottom: 1px solid #d2d2d2 !important;
    }
    .ps-scrollbar-x-rail {
        width: auto !important;
        overflow-x: hidden !important;
    }
    .selectedmenu{
        background:#151521 ;   /*#1b1b28 !important;*/
        color:#fff !important;
    }
    .selectedicon{
        color:#3699ff !important;
    }

    .sidebar .dropdown-menu .dropdown-item:focus ,
    .sidebar .dropdown-menu .dropdown-item:hover,
    .sidebar.dropdown-menu a:active,
    .sidebar .dropdown-menu a:focus,
    .sidebar.dropdown-menu a:hover {
        /*background-color: #1b1b28 !important;*/
        background-color: #151521 !important;
    }
    a.nav-link.main-a-tag{
        font-size: 0.75rem !important;
    }
    .abnormal-size{
        margin-left:-8px;
    }
    .logo{
        height: 110px !important;
        background: #181824;
    }
    .sidebar .logo a.logo-mini{
        width: 65px !important;
        height: 90px !important;
    }
    .logo img{
        width: 65px !important;
        height: 65px !important;
    }
    .selectedtext{
        color: #fff !important;
    }

    @if(\Auth::user()->lang_id == 2)
        .modern-menu{
        margin-right: 5% !important;
        margin-left: 0% !important;
    }
    .submenu{
        right: 112px !important;
        left: 0px !important;
    }
    .navbar .collapse .navbar-nav .nav-item .nav-link{
        margin-right: 0px !important;
        margin-left: 0px !important;
    }

    .abnormal-size{
        margin-right:-8px !important;
        margin-left:0px !important;
    }
    /*.modern-menu{*/
    /*    padding-right: 0px;*/
    /*    padding-left: 0px;*/
    /*}*/
    @media (min-width: 768px){
        .navbar-nav {
            float: left !important;
        }
    }
    @endif
</style>



<div class="sidebar" data-color="rose" data-background-color="black"
     data-image="{{asset('/assets/img/sidebar-1.jpg')}}" >
    <div class="logo" >
        <a href="" class="simple-text logo-mini" style="">
            <img style="max-width: 65px;max-height: 65px; border-radius: 50%"
                 src="{{asset('images/user/photo/').'/'.\App\Models\Setting\Setting::organization_logo()}}">
        </a>
        {{--<a href=" " class="simple-text logo-normal" style="max-width: 150px;white-space: initial;">--}}
        {{--{{ \App\Models\Setting\Setting::organization_name() }}--}}
        {{--</a>--}}
    </div>

    <div class="sidebar-wrapper">

        <div class="">
            <nav class="navbar  navbar-dark" style="width:80%;background: transparent !important;margin: auto">
                <button hidden class="navbar-toggler" type="button" aria-expanded="true" data-toggle="collapse" data-target="#main_nav">

                </button>
                <div class="collapse navbar-collapse show" id="main_nav" style="width:100%;background: transparent !important;">
                    <ul class="navbar-nav container modern-menu" style="width:100px;background: transparent !important;" >
                        <li  class="nav-item mainli @if( request()->is('home*')) selectedmenu @endif"> <a class="nav-link main-a-tag" href="">  <i class="material-icons @if( request()->is('home*')) selectedicon @endif" >home</i> <br><span class="@if( request()->is('home*')) selectedtext @endif">{{$labels['home_menu'] ?? 'Home'}}</span>  </a> </li>
                        <li  class="nav-item dropdown mainli @if( request()->is('opportunity/*')|| request()->is('concept/*') || request()->is('proposal/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag proposal-writing"  href="#" data-toggle="dropdown"> <i class="material-icons @if( request()->is('opportunity/*')|| request()->is('concept/*') || request()->is('proposal/*')) selectedicon @endif" >description</i> <br> <span class="@if( request()->is('opportunity/*')|| request()->is('concept/*') || request()->is('proposal/*')) selectedtext @endif"> {{$labels['Proposal_writing_menu'] ?? 'Proposal Writing'}}</span> </a>
                            <ul class="dropdown-menu submenu">
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item @if( request()->is('opportunity/*')) selectedmenu @endif " href=""> <span class="title-content-sp"> {{$labels['opportunity_menu'] ?? 'Opportunities'}} </span></a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item @if( request()->is('concept/*')) selectedmenu @endif" href=""> <span class="title-content-sp">   {{$labels['concept_menu'] ?? 'Concepts'}} </span> </a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item @if( request()->is('proposal/*')) selectedmenu @endif" href=""> <span class="title-content-sp"> {{$labels['proposal_menu'] ?? 'Proposals'}} </span> </a></li>
                            </ul>
                        </li>
                        <li  class="nav-item dropdown mainli @if( request()->is('project/*')|| request()->is('activity/*') || request()->is('tasks/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons  @if( request()->is('project/*')|| request()->is('activity/*') || request()->is('tasks/*')) selectedicon @endif" >list</i> <br> <span class="@if(request()->is('project/*')|| request()->is('activity/*') || request()->is('tasks/*')) selectedtext @endif">{{$labels['project_list'] ?? 'project_list'}} </span> </a>
                            <ul class="dropdown-menu submenu" style="">
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href=""> {{$labels['project_list'] ?? 'project_list'}} </a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="">  {{$labels['activities_list'] ?? 'activities_list'}} </a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="">    {{$labels['tasks-link'] ?? 'tasks-link'}} </a></li>
                            </ul>
                        </li>
                        <li  class="nav-item dropdown mainli @if( request()->is('vendors*')|| request()->is('procurement/*') || request()->is('plans*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >shopping_cart</i> <br> <span class="abnormal-size">{{$labels['procurements_menu'] ?? 'Procurements'}}  </span>  </a>
                            <ul class="dropdown-menu submenu" style="">
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="">  {{$labels['vendors_menu'] ?? 'Vendors'}}</a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item @if( request()->is('plans*')) selectedmenu @endif" href=""> {{$labels['procurement_plan_menu'] ?? 'Procurement Plan'}}  </a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="#"> {{$labels['purchase_orders_menu'] ?? 'Purchase Orders'}}   </a></li>
                            </ul>
                        </li>

                        <li  class="nav-item dropdown mainli @if( request()->is('strategic/*')|| request()->is('beneficiaries/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >home</i> <br><span class="abnormal-size">{{$labels['organization'] ?? 'Organization'}} </span>   </a>
                            <ul class="dropdown-menu submenu" style="">
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href=""> {{$labels['goals_list'] ?? 'Strategic Plans'}}</a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="#"> {{$labels['objectives_programs_menu'] ?? 'Strategic objectives & Programs'}}  </a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="#"> {{$labels['beneficiaries'] ?? 'Beneficiaries'}} </a></li>
                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="#"> {{$labels['donors-link'] ?? 'Funders And Partners'}} </a></li>
                            </ul>
                        </li>

                        <li  class="nav-item dropdown mainli">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >insert_chart_outlined</i> <br> <span>{{$labels['Sidebar_reports'] ?? 'Reports'}}</span>  </a>
                            {{--                            <ul class="dropdown-menu submenu" style="">--}}
                            {{--                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="#"> Submenu item 1</a></li>--}}
                            {{--                                <li style="color: #fff;background: #1f1e2e;"><a style="color:#fff;"class="dropdown-item" href="#"> Submenu item 2 </a></li>--}}
                            {{--                            </ul>--}}
                        </li>
                    </ul>
                </div> <!-- navbar-collapse.// -->
            </nav>
        </div>

    </div>
</div>





