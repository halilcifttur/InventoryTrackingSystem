<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StokTakip') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        label, input { display:block; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#users-contain { width: 350px; margin: 20px 0; }
        div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style> 

    <style type="text/css">
        
        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .custom-scrollbar {
            position: relative;
            height: 244px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }

        .time-size {
            width: 50%;
        }

        .date-size {
            width: 15%;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('anasayfa') }}">
                    {{ config('app.name', 'StokTakip') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::guard('admin')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('Yönetici Paneli')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.liste') }}">{{ __('Şirket-Çalışan Takip')}}</a>
                            </li>
                        @elseif(Auth::guard('web')->check())
                            @if(Auth::user()->role_id == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sirket.dashboard') }}">{{ __('Kullanıcı Paneli')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sirket.liste') }}">{{ __('Depo Takip')}}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('calisan.dashboard') }}">{{ __('Kullanıcı Paneli')}}</a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(!Auth::guard('admin')->check() && !Auth::guard('web')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Giriş Yap') }}</a>
                            </li> 
                        @else
                            <li class="nav-item dropdown">
                                                       
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::guard('admin')->check())
                                        {{ Auth::guard('admin')->user()->name }}
                                    @else
                                        {{ Auth::guard('web')->user()->name }}
                                    @endif
                                    <span class="caret"></span>                                       
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::guard('admin')->check())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            {{ __('Yönetici Paneli') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.liste') }}">
                                            {{ __('Şirket-Çalışan Takip') }}
                                        </a>
                                    @else
                                        @if(Auth::user()->role_id == 1)
                                            <a class="dropdown-item" href="{{ route('sirket.dashboard') }}">
                                            {{ __('Kullanıcı Paneli') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('sirket.liste') }}">
                                                {{ __('Depo Takip') }}
                                            </a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('sirket.dashboard') }}">
                                            {{ __('Kullanıcı Paneli') }}
                                            </a>
                                        @endif
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Çıkış Yap') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  
    <script>

        var _ajaxProvince = @if(Auth::guard('admin')->check())'admin';@elseif(Auth::guard('web')->check())'sirket'; @endif
        
        $(document).ready(function() {

            $('#il').on('change', function() {

                var il_id = $(this).val();

                if (il_id) {

                    $.ajax({

                        url:'/'+_ajaxProvince+'/getIlce/'+il_id,
                        type: 'GET',
                        datatype: 'json',
                        success: function(data) {

                            $('#ilc').html('');

                            $.each(JSON.parse(data), function(key, values) {

                                $('#ilc').append("<option value="+key+">"+ values +"</option>");
                            });
                        }
                    });
                } else {

                    $('#ilc').empty();
                }
            });
        });
    </script>

    <script>
        
        $(document).ready(function() {

            $('#il2').on('change', function() {

                var il_id = $(this).val();

                if (il_id) {

                    $.ajax({

                        url:'/'+_ajaxProvince+'/getIlce/'+il_id,
                        type: 'GET',
                        datatype: 'json',
                        success: function(data) {

                            $('#ilc2').html('');

                            $.each(JSON.parse(data), function(key, values) {

                                $('#ilc2').append("<option value="+key+">"+ values +"</option>");
                            });
                        }
                    });
                } else {

                    $('#ilc2').empty();
                }
            });
        });
    </script>
    <script>
        
        $(document).ready(function() {

            $('#il3').on('change', function() {

                var il_id = $(this).val();

                if (il_id) {

                    $.ajax({

                        url:'/'+_ajaxProvince+'/getIlce/'+il_id,
                        type: 'GET',
                        datatype: 'json',
                        success: function(data) {

                            $('#ilc3').html('');

                            $.each(JSON.parse(data), function(key, values) {

                                $('#ilc3').append("<option value="+key+">"+ values +"</option>");
                            });
                        }
                    });
                } else {

                    $('#ilc3').empty();
                }
            });
        });
    </script>
    <script>
        
        $(document).ready(function() {

            $('#il4').on('change', function() {

                var il_id = $(this).val();

                if (il_id) {

                    $.ajax({

                        url:'/'+_ajaxProvince+'/getIlce/'+il_id,
                        type: 'GET',
                        datatype: 'json',
                        success: function(data) {

                            $('#ilc4').html('');

                            $.each(JSON.parse(data), function(key, values) {

                                $('#ilc4').append("<option value="+key+">"+ values +"</option>");
                            });
                        }
                    });
                } else {

                    $('#ilc4').empty();
                }
            });
        });
    </script>


    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@yield('javascripts')
</body>
</html>
