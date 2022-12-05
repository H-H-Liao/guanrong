<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:image" content="/project/images/logo_og.png" />
    <!-- At least: 200 x 200, 檔案大小必須小於8mb -->
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="{{ URL::full() }}" />
    <meta property="og:site_name" content="@yield('title')" />
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="i/project/mg/favicon.png" />
    <link rel="stylesheet" href="/project/css/plugins.css" />
    <link rel="stylesheet" href="/bootstrap-icons-1.9.0/bootstrap-icons.css">
    <link rel="stylesheet" href="/project/css/style.css?v=4" />
    @stack('css')

    @if($item=Settings::value('google_analytics_id'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $item }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ $item }}');
        </script>
    @endif

    @if($message=Session::get('message'))
        <script>
            alert('{{ $message }}');
        </script>
    @endif
</head>



<body class="{{ app()->getLocale() }}">
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Sidebar Section -->
    <a href="#" class="js-savoye-nav-toggle savoye-nav-toggle"><i></i></a>
    <aside id="savoye-aside">
        <!-- Logo -->
        @if($item = Settings::image('image'))
        <div class="savoye-logo">
            <a href="{{ TypiCMS::homeUrl() }}">
                <img src="{{ $item }}" style="width: 160px;" class="logo-img" alt="">
            </a>
        </div>
        @endif
        <!-- Menu -->
        <nav class="savoye-main-menu">
            <ul>
                <li @if(isset($page) &&  $page->template == 'home')  class="active" @endif><a href='{{ TypiCMS::homeUrl() }}'>{{ Pages::getHomeTitle() }}</a></li>
                @if($value = Pages::getPage('about'))
                <li @if(isset($page) && $page->template == 'about')  class="active" @endif><a href='{{ $value->url() }}'>{{$value->title}}</a></li>
                @endif
                @if(Route::has(app()->getLocale()."::index-services"))
                <li @if(isset($page) && $page->module == 'services')  class="active" @endif><a href='{{ route(app()->getLocale()."::index-services")  }}'>{{ Pages::getModulePageTitle('services') }}</a></li>
                @endif
                @if(Route::has(app()->getLocale()."::index-newsitems"))
                <li @if(isset($page) && $page->module == 'newsitems')  class="active" @endif><a href='{{ route(app()->getLocale()."::index-newsitems")  }}'>{{ Pages::getModulePageTitle('newsitems') }}</a></li>
                @endif
                @if(Route::has(app()->getLocale()."::index-portfolios"))
                <li @if(isset($page) && $page->module == 'portfolios')  class="active" @endif><a href='{{ route(app()->getLocale()."::index-portfolios")  }}'>{{ Pages::getModulePageTitle('portfolios') }}</a></li>
                @endif
                @if(Route::has(app()->getLocale()."::index-parners"))
                <li @if(isset($page) && $page->module == 'parners')  class="active" @endif><a href='{{ route(app()->getLocale()."::index-parners")  }}'>{{ Pages::getModulePageTitle('parners') }}</a></li>
                @endif
                @if(Route::has(app()->getLocale()."::index-fqs"))
                <li @if(isset($page) && $page->module == 'fqs')  class="active" @endif><a href='{{ route(app()->getLocale()."::index-fqs")  }}'>{{ Pages::getModulePageTitle('fqs') }}</a></li>
                @endif
                @if(Route::has(app()->getLocale()."::index-contacts"))
                <li @if(isset($page) && $page->module == 'contacts')  class="active" @endif><a href='{{ route(app()->getLocale()."::index-contacts")  }}'>{{ Pages::getModulePageTitle('contacts') }}</a></li>
                @endif
            </ul>
        </nav>
        @if(count(Socialbuttons::list())>0)
        <!-- Sidebar Footer -->
        <div class="savoye-footer">
            <ul>
                @foreach (Socialbuttons::list() as $item)
                <li><a href="{{ $item->link }}"><i class="{{ $item->icon }}"></i></a></li>
                @endforeach
            </ul>
        </div>
        @endif
    </aside>

    <!-- Main -->
    <div id="savoye-main">
        @yield('content')

        <!-- hr -->

        <!-- Top Footer Banner -->
        <div class="topbanner-footer">
            <div class="section-padding banner-img valign bg-img bg-fixed" data-overlay-darkgray="1" @if( $item = Settings::image('footer_logo')) data-background="{{$item}}" @endif>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-30 text-left caption">
                            <div class="section-title">{{ __('Contact Us') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        @if($item = Settings::value('block1_'.app()->getLocale()) )
                        <div class="col-md-3">
                            <h6>{{ $item }}</h6>
                            @if($item = Settings::value('block1_value_'.app()->getLocale()))
                            <h5 class="mb-30">{{ $item }}</h5>
                            @endif
                        </div>
                        @endif
                        @if($item = Settings::value('block2_'.app()->getLocale()) )
                        <div class="col-md-3">
                            <h6>{{ $item }}</h6>
                            @if($item = Settings::value('block2_value_'.app()->getLocale()))
                            <h5 class="mb-30">{{ $item }}</h5>
                            @endif
                        </div>
                        @endif
                        @if($item = Settings::value('block3_'.app()->getLocale()) )
                        <div class="col-md-3">
                            <h6>{{ $item }}</h6>
                            @if($item = Settings::value('block3_value_'.app()->getLocale()))
                            <h5 class="mb-30">{{ $item }}</h5>
                            @endif
                        </div>
                        @endif
                        @if($item = Settings::value('block4_'.app()->getLocale()) )
                        <div class="col-md-3">
                            <h6>{{ $item }}</h6>
                            @if($item = Settings::value('block4_value_'.app()->getLocale()))
                            <h5 class="mb-30">{{ $item }}</h5>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

     <!-- Footer -->
     <footer class="main-footer dark">
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        @if($item = Settings::value('copyright_'.app()->getLocale()) )
                        <div class="text-left">
                            <p>{{ $item }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="text-right-left">
                            @if ($enabledLocales = TypiCMS::enabledLocales() and count($enabledLocales) > 1)

                            <p>
                                @foreach ($enabledLocales as $locale)
                                @if (!$loop->first)
                                <span>|</span>
                                @endif
                                @isset($page)
                                    @isset($model)
                                    <a href="{{ url($model->uri($locale)) }}"> {{ __($locale) }}</a>
                                    @else
                                    <a href="{{ url($page->uri($locale)) }}"> {{ __($locale) }}</a>
                                    @endif
                                @else
                                <a href="/{{ app()->getLocale() }}"> {{ __($locale) }}</a>
                                @endif
                                @endforeach
                            </p>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
    <!-- jQuery -->
    <script src="/project/js/jquery-3.6.0.min.js"></script>
    <script src="/project/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="/project/js/modernizr-2.6.2.min.js"></script>
    <script src="/project/js/imagesloaded.pkgd.min.js"></script>
    <script src="/project/js/jquery.isotope.v3.0.2.js"></script>
    <script src="/project/js/popper.min.js"></script>
    <script src="/project/js/bootstrap.min.js"></script>
    <script src="/project/js/scrollIt.min.js"></script>
    <script src="/project/js/jquery.waypoints.min.js"></script>
    <script src="/project/js/owl.carousel.min.js"></script>
    <script src="/project/js/jquery.stellar.min.js"></script>
    <script src="/project/js/jquery.fancybox.min.js"></script>
    <script src="/project/js/YouTubePopUp.js"></script>
    <script src="/project/js/custom.js?v=2"></script>
    @stack('js')
</body>
</html>
