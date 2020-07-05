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
    </ul>
  </div>
</div>

