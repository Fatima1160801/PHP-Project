
<style>
    .sidebar{
        width: 130px !important;
    }
    .sidebar-wrapper{
        width: 130px !important;
    }
    .sidebar-background:after {
        /*background: #04365f !important;*/
        background: #22263d !important;
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
    }
    .mainli .dropdown-menu .dropdown-item a{
        margin: auto;
    }
    .title-content-sp{
        /*margin: auto !important;*/
    }
    .main-a-tag:active,.main-a-tag:focus,.main-a-tag:visited{/*.main-a-tag:hover**/
        /*background: #5d76a8;*/
    }

    .mainli .dropdown-menu a:active,.mainli .dropdown-menu a:focus,.mainli .dropdown-menu a:visited,.mainli .dropdown-menu a:hover{/*.main-a-tag:hover**/
        /*background: #5d76a8 !important;*/
    }
    .mainli:active,.mainli:focus,.mainli:visited,.mainli:hover{/*.main-a-tag:hover**/
        background: #5d76a8 !important;
    }

    .proposal-writing{
        margin-top: -8px !important;
        padding-top: 0px !important;
    }
    .submenu a{
        font-size: 12px !important;
    }
    .ps-container{
        overflow: initial !important;
    }
    .mainli a{
        font-size: 14px !important;
    }
    .mainli{
        margin-top: 5px;
        margin-bottom: 5px;
        background: #1d344a;
        border-radius: 10px;
        height: 100px;
        min-height: 100px;
        max-height: 100px;
    }
    .main-a-tag i{
        font-size: 24px !important;
        margin-bottom: 10px;
    }
    .modern-menu{
        margin-left: 5%;
    }
    .main-a-tag{
        margin-top: 10px !important;
    }
    .submenu{
        left: 124px !important;
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
        background: #5d76a8 !important;
    }


</style>



<div class="sidebar" data-color="rose" data-background-color="black"
     data-image="{{asset('/assets/img/sidebar-1.jpg')}}" style="top: 70px;">

    <div class="sidebar-wrapper">

        <div class="">
            <nav class="navbar  navbar-dark" style="width:100%;background: transparent !important;">
                <button hidden class="navbar-toggler" type="button" aria-expanded="true" data-toggle="collapse" data-target="#main_nav">

                </button>
                <div class="collapse navbar-collapse show" id="main_nav" style="width:100%;background: transparent !important;">
                    <ul class="navbar-nav container modern-menu" style="width:100%;background: transparent !important;" >
                        <li  class="nav-item mainli"> <a class="nav-link main-a-tag" href="">  <i class="material-icons" >home</i> <br> Home </a> </li>
                        <li  class="nav-item dropdown mainli @if( request()->is('opportunity/*')|| request()->is('concept/*') || request()->is('proposal/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag proposal-writing"  href="#" data-toggle="dropdown"> <i class="material-icons" >description</i> <br> Proposal Writing </a>
                            <ul class="dropdown-menu submenu">
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item @if( request()->is('opportunity/*')) selectedmenu @endif " href=""> <span class="title-content-sp"> Opportunities </span></a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item @if( request()->is('concept/*')) selectedmenu @endif" href=""> <span class="title-content-sp"> Concept </span> </a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item @if( request()->is('proposal/*')) selectedmenu @endif" href=""> <span class="title-content-sp"> Proposal </span> </a></li>
                            </ul>
                        </li>
                        <li  class="nav-item dropdown mainli @if( request()->is('project/*')|| request()->is('activity/*') || request()->is('tasks/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >list</i> <br> {{$labels['project_list'] ?? 'project_list'}}  </a>
                            <ul class="dropdown-menu submenu" style="">
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href=""> {{$labels['project_list'] ?? 'project_list'}} </a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="">  {{$labels['activities_list'] ?? 'activities_list'}} </a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="">    {{$labels['tasks-link'] ?? 'tasks-link'}} </a></li>
                            </ul>
                        </li>
                        <li  class="nav-item dropdown mainli @if( request()->is('vendors*')|| request()->is('procurement/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >shopping_cart</i> <br> Procurements  </a>
                            <ul class="dropdown-menu submenu" style="">
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="">  {{$labels['vendors_menu'] ?? 'Vendors'}}</a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href=""> Procurement Plan </a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> Purchase Orders </a></li>
                            </ul>
                        </li>

                        <li  class="nav-item dropdown mainli @if( request()->is('strategic/*')|| request()->is('beneficiaries/*')) selectedmenu @endif">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >home</i> <br> Organization  </a>
                            <ul class="dropdown-menu submenu" style="">
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> {{$labels['goals_list'] ?? 'Strategic Plans'}}</a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> Strategic objectives & Programs </a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> {{$labels['beneficiaries'] ?? 'Beneficiaries'}} </a></li>
                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> {{$labels['donors-link'] ?? 'Funders And Partners'}} </a></li>
                            </ul>
                        </li>

                        <li  class="nav-item dropdown mainli">
                            <a  class="nav-link  dropdown-toggle main-a-tag" href="#" data-toggle="dropdown"> <i class="material-icons" >assignment</i> <br> Reports  </a>
                            {{--                            <ul class="dropdown-menu submenu" style="">--}}
                            {{--                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> Submenu item 1</a></li>--}}
                            {{--                                <li style="color:#000;background: #eee;"><a style="color:#000;"class="dropdown-item" href="#"> Submenu item 2 </a></li>--}}
                            {{--                            </ul>--}}
                        </li>
                    </ul>
                </div> <!-- navbar-collapse.// -->
            </nav>
        </div>

    </div>
</div>





