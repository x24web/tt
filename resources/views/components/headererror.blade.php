<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>        
 صراحات - sarahahs
    </title>
    <meta property="twitter:card" content="summary">
        <meta property="twitter:title"              content="موقع صراحات" />
        <meta name="description" content="صراحة يساعدك في الحصول على آراء الآخرين عنك مع الحفاظ على سرية المرسل اليك - صراحات">
        <meta name="twitter:description" content="صراحة يساعدك في الحصول على آراء الآخرين عنك مع الحفاظ على سرية المرسل اليك - صراحات">
        <meta property="og:image"        content="{{asset('images/sarahahs.png')}}" />
        <meta name="twitter:image:src" content="{{asset('images/sarahahs.png')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&family=Tajawal:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177297254-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-177297254-1');
    </script>
<script data-ad-client="ca-pub-2910164969130337" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<body>
<nav id="navbar">
    <div class="container">
        <ul>
            <li><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
            <li><a href="{{route('blogs')}}">مقالات</a></li>
            <li><a href="{{route('contact')}}">اتصل بنا</a></li>
        </ul>
        <ul class="logo">
            <li><a href="{{route('home')}}">صراحات</a></li>
        </ul>
        <ul>
            @if (Auth::check())
                <li><a class="btn btn-primary" href="{{ route('profile') }}">حسابك</a></li>
                <li><a class="btn btn-primary" href="{{ route('settings') }}">الإعدادات</a></li>
                <li><a class="btn btn-primary" href="{{ route('logout') }}">خروج</a></li>
            @else
                <li><a class="btn btn-primary" href="{{ route('login') }}">تسجيل دخول</a></li>
                <li><a class="btn btn-primary" href="{{ route('register') }}">تسجيل</a></li>
            @endif
        </ul>
    </div>
    <div class="menu-wrap">
        <input type="checkbox" class="toggler">
        <div class="hamburger">
            <div></div>
        </div>
        <div class="menu">
            <div>
                <div>
                    <ul>
                        <li><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
                        <li><a href="{{route('blogs')}}">مقالات</a></li>
                        <li><a href="{{route('contact')}}">اتصل بنا</a></li>
                        @if (Auth::check())
                            <li><a href="{{ route('profile') }}">حسابك</a></li>
                            <li><a href="{{ route('settings') }}">الإعدادات</a></li>
                            <li><a href="{{ route('logout') }}">خروج</a></li>
                        @else
                            <li><a href="{{ route('login') }}">تسجيل دخول</a></li>
                            <li><a href="{{ route('register') }}">تسجيل</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
