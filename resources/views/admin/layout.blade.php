<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Dashboard</title>
    <style>#loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }</style>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body class="app">
<div id="loader">
    <div class="spinner"></div>
</div>
<script>window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
            loader.classList.add('fadeOut');
        }, 300);
    });</script>
<div>
    <div class="sidebar">
        <div class="sidebar-inner">
            <div class="sidebar-logo">
                <div class="peers ai-c fxw-nw">
                    <div class="peer peer-greed"><a class="sidebar-link td-n" href="{{route('dashboard.index')}}">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer">
                                    <div class="logo"><img src="{{asset('assets/static/images/logo.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="peer peer-greed"><h5
                                        class="lh-1 mB-0 logo-text">{{ config('app.name', 'Instagram') }}</h5></div>
                            </div>
                        </a></div>
                    <div class="peer">
                        <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i
                                    class="ti-arrow-circle-left"></i></a></div>
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu scrollable pos-r">
                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="{{route('dashboard.index')}}">
                        <span class="icon-holder"><i class="c-blue-500 ti-home"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{route('dashboard.users')}}">
                        <span class="icon-holder"><i class="c-brown-500 ti-user"></i></span>
                        <span class="title">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{route('dashboard.posts')}}">
                        <span class="icon-holder"><i class="c-orange-500 ti-layers-alt"></i></span>
                        <span class="title">Posts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{route('dashboard.comments')}}">
                        <span class="icon-holder"><i class="c-deep-purple-500 ti-comments"></i></span>
                        <span class="title">Comments</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-container">
        <div class="header navbar">
            <div class="header-container">
                <ul class="nav-left">
                    <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
                                            data-toggle="dropdown">
                            <div class="peer mR-10"><img class="w-2r bdrs-50p"
                                                         src="{{Auth::user()->avatar}}" alt="">
                            </div>
                            <div class="peer"><span class="fsz-sm c-grey-900">{{Auth::user()->name}}</span></div>
                        </a>
                        <ul class="dropdown-menu fsz-sm">
                            <li><a href="{{ route('users.edit', ['user' => Auth::user()]) }}"
                                   class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                        class="ti-settings mR-10"></i> <span>Setting</span></a></li>
                            <li><a href="{{ route('users.show', ['user' => Auth::user()]) }}"
                                   class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i>
                                    <span>Profile</span></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('logout')}}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                        class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <main class="main-content bgc-grey-100">
            <div id="mainContent">
                @yield('content')
            </div>
        </main>
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2017 Designed by <a
                    href="https://colorlib.com" target="_blank"
                    title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/vendor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bundle.js')}}"></script>
</body>
</html>
