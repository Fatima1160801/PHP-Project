<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">


    <div class="container-fluid" style="width: 100%;">

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
            <ul class=" navbar-nav" style="width: 100% !important;">




                @yield('nav_header')


                <li class="nav-item dropdown">
                    <a class="nav-link btn-setting-nav" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">settings</i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right setting-dropdown " aria-labelledby="navbarDropdownMenuLink"
                    >
                        <div class="row" style="margin: 0px;">
                            <div class="col-md-12">

                                <a class="setting-btn" href="#">
                                    <i class="material-icons setting-icons">location_on</i>
                                    Location Setting
                                </a>
                                <a class="setting-btn" href="#">
                                    <i class="material-icons setting-icons">account_circle</i>
                                    Users And Staff
                                </a>
                                <a class="setting-btn" href="#">
                                    <i class="material-icons setting-icons">assignment</i>
                                    Documents Settings
                                </a>
                                <a class="setting-btn" href="#">
                                    <i class="material-icons setting-icons">shopping_cart</i>
                                    Procurement Settings
                                </a>
                                <a class="setting-btn" href="#">
                                    <i class="material-icons setting-icons">video_label</i>
                                    System Settings
                                </a>
                                <a class="setting-btn" href="#">
                                    <i class="material-icons setting-icons">settings_applications</i>
                                    Other Settings
                                </a>
                            </div>
                        </div>

                    </div>
                </li>
                <li class="nav-item btn-lang-nav"  >
                    <a  class="nav-link" href="#"      onclick="event.preventDefault();  document.getElementById('user-change-language').submit();">

                        <form id="user-change-language" action="{{ route('permission.user.change.language') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        @if(Auth::user()->lang_id == '1')
                            A
                        @else
                            EN
                        @endif
                        <i class="material-icons">language</i>

                    </a>
                </li>
                <li class="nav-item dropdown  btn-lang-nav btn-notification-nav" >
                    <a class="nav-link notifications-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification" id="notification-count" style="display: none"></span>
                        <p class="d-lg-none d-md-block">
                            Some Actions
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="notifications-list"
                         aria-labelledby="navbarDropdownMenuLink" style="width: 450px;max-height:300px; overflow: auto; ">

                    </div>
                </li>
                <li class="nav-item dropdown  btn-user-nav">
                    <a class="nav-link " href="#" id="navbarDropdownMenuLink"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user ">
                            @if( !empty(Auth::user()->user_name))
                                {{ Auth::user()->user_name }}
                            @endif

                            <div class="photo">
                                @if( !empty(Auth::user()->user_photo))
                                    <img src="{{asset('images/user/photo/').'/'.Auth::user()->user_photo}}"/>
                                @else
                                    <img src="{{asset('images/placeholder.png')}}"/>
                                @endif
                            </div>

                        </div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('permission.user.showMyProfile')}}">
                            {{$labels['my_profile']??'my_profile'}}
                        </a>
                        <a class="dropdown-item" href="{{route('permission.user.editMyProfile')}}">
                            {{$labels['edit_profile']??'edit_profile'}}
                        </a>
                        <a class="dropdown-item" href="{{route('permission.user.createChangePassword')}}">
                            {{$labels['change_password']??'change_password'}}
                        </a>
                        <a class="dropdown-item" href="{{ route('permission.user.get.logout') }}">

                            {{$labels['logout']??'logout'}}
                        </a>


                    </div>
                </li>



            </ul>
        </div>
    </div>
</nav>


<script>
    $(function () {

        refreshNotifications();

        setInterval(refreshNotifications, 20000);


        $('.notifications-link').click(function () {
            var url = '';
            $.post(url);
            $('#notification-count').hide();
        });

        $('body').on('click', '.notifi', function () {
            var nid = $(this).attr('data-n-id');
            var href = $(this).attr('href');
            var url = '' + '/' + nid;
            $.get(url, function () {
                location.href = href;
            });
        });

        function refreshNotifications() {
            var noti_url = '';
            $.get(noti_url, function (response) {
                if (response.not_viewed_noti > 0) {
                    $('#notification-count').show().html(response.not_viewed_noti);
                } else {
                    $('#notification-count').hide();
                }
                $('#notifications-list').html(response.noti_html);
            });
        }


    });
</script>

