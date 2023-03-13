<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('meta-title', 'TISIJI: печи и камины JOTUL и SCAN - официальный сайт представителя в JOTUL GROUP в Армении. Продажа печей-каминов JOTUL оптом.')</title>
        <meta name="description" content="@yield('meta-description', 'Официальный сайт представителя производителей печей и каминов: Jotul  Scan  в Армении, оптовая и розничная продажа печей Скандинавских производителей. Каталог печей и ккминов в Ереване')">
        <meta name="keywords" content="@yield('meta-keywords', 'печи, камины, jotul, scan, скандинавские, чугунные, дровяные, армения, для печей, купить, цена, офоициальный, сайт, йотул, скан')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="/css/app.min.css">
    </head>
    <body>
        <header class="{{ request()->routeIs('front.catalog.index') ? 'head-catalog' : 'head '}}" style="background-image: url({{$background}})">
            <div class="naw-wrap">

                <div class="logo">
                    <a href="/" class="logo-link">
                        <div class="logo_img_wrap">
                            <img src="/images/src/logo_tisiji.png" alt="LOGO" class="logo_img">
                        </div>
                        <div class="logo_title_wrap">
                            <div class="logo_title">TISIJI</div>
                            <div class="logo_sub">Բուխարիներ</div>
                        </div>
                    </a>
                </div>

                <div class="nav-mob-phone"><i class="fa fa-phone"></i>{{ Config::get('common.phone') }}</div>

                <div class="naw-btn" id="mobMwnuBtn">
                    <div class="menu-icon menu-icon-3">
                        <div class="bar bar-1"></div>
                        <div class="bar bar-2"></div>
                        <div class="bar bar-3"></div>
                    </div>
                </div>
                <x-menu></x-menu>
                <div class="nav-search">
                    <div class="nav-search-phone">{{ Config::get('common.phone') }}</div>
                    <i class="fa fa-search" aria-hidden="true" id="searchBtn"></i><span class="nav-search-txt">Search</span>
                </div>
            </div>
        </header>
        <div id="search" class="search_wrap">
            <form action="{{route('front.catalog.search')}}" class="form-wrap">
                <input id="title-search-input" type="text" name="s" value="" autocomplete="off" class="search-input" required placeholder="Ищем...">
                <button type="submit" class="search-btn"><span>Поиск</button>
            </form>
        </div>
