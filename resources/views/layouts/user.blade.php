<?php
use App\blogs;
$blogs_sidebar = blogs::where('is_public','=','1')->where('public_time','<=', now())->orderBy('views_month','desc')->take(10)->get();
?>
@include('components.header')
<div id="main">
    <div class="profile">
        <div class="background">
        @if(Route::current()->getName() == 'user')
            @if($user->cover_profile == '')
                <img src="https://1.bp.blogspot.com/-6L9cPLUW9l4/X2okUi-3cNI/AAAAAAAANAg/vcVRD3haXQ4TtPqj4297tVWyF_vkwI1swCLcBGAsYHQ/s1200/bg.png" alt="{{$user->name}}">
            @else
                <img src="{{$user->cover_profile}}" alt="{{$user->name}}">
            @endif
        @else
            @if(Auth::user()->cover_profile == '')
                <img src="https://1.bp.blogspot.com/-6L9cPLUW9l4/X2okUi-3cNI/AAAAAAAANAg/vcVRD3haXQ4TtPqj4297tVWyF_vkwI1swCLcBGAsYHQ/s1200/bg.png" alt="{{Auth::user()->name}}">
            @else
                <img src="{{Auth::user()->cover_profile}}" alt="{{Auth::user()->name}}">
            @endif
        @endif
        </div>
        <div class="container">
            <div class="info">
                <div class="image--profile">
                    @if(Route::current()->getName() == 'user')
                        @if($user->img_profile == '')
                            <img src="{{asset('images/person.png')}}" alt="{{$user->name}}">
                        @else
                            <img src="{{$user->img_profile}}" alt="{{$user->name}}">
                        @endif
                    @else
                        @if(Auth::user()->img_profile == '')
                            <img src="{{asset('images/person.png')}}" alt="{{Auth::user()->name}}">
                        @else
                            <img src="{{Auth::user()->img_profile}}" alt="{{Auth::user()->name}}">
                        @endif
                    @endif
                    @if(Route::current()->getName() == 'user')
                        <h2>{{$user->name}}</h2>
                    @else
                        <h2>{{Auth::user()->name}}</h2>
                    @endif
                </div>
            </div>
            @if(Route::current()->getName() == 'profile' || Route::current()->getName() == 'settings')
            <div class="details">
                <div class="share">
                    <div>
                        <h3>شارك رابط حسابك ليتمكن أصدقاء من الارسال لك</h3>
                        <div class="social-login">
                            <input type="text" style="width: 80%;text-align: center;margin: 8px auto;display: block;font-size: 18px;border-radius: 10px;border: 2px solid #4867aa;" value="{{route('user',Auth::user()->username)}}" id="currentUrl" readonly>
                            <style>li.copy:active {
                                    background: #dedede !important;
                                    outline: 0;
                                }</style>
                            <ul>
                                <li class="copy"><a style="cursor: pointer;" id="copyBtn"><img src="{{asset('images/copy.png')}}" alt="copy"></a></li>
                                <li class="whatsapp"><a href="https://wa.me/?text={{route('user',Auth::user()->username)}}" target="_blank"><img src="{{asset('images/whatsapp.png')}}" alt="whatsapp"></a></li>
                                <li class="twitter"><a href="https://twitter.com/intent/tweet?text=اكتب ما هو رايك بصراحة في {{Auth::user()->name}}&amp;url={{route('user',Auth::user()->username)}}" target="_blank"><img src="{{asset('images/twitter.png')}}" alt="twitter"></a></li>
                                <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{route('user',Auth::user()->username)}}" target="_blank"><img src="{{asset('images/facebook.png')}}" alt="facebook"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="analysis">
                    <li>
                        <h4>عدد الرسائل</h4>
                        <h3>{{Auth::user()->messages}}</h3>
                    </li>
                    <li>
                        <h4>عدد الرسائل العامة</h4>
                        <h3>{{Auth::user()->public_messages}}</h3>
                    </li>
                    <li>
                        <h4>عدد زيارات الحساب</h4>
                        <h3>{{Auth::user()->views}}</h3>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
    <div class="skyscraper skyscraper-left">
        <div class="skyscraper-inner">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- left-widesky -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-2910164969130337"
     data-ad-slot="2482477978"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>            
        </div>
    </div>
    <div class="skyscraper skyscraper-right">
        <div class="skyscraper-inner">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- right-widesky -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-2910164969130337"
     data-ad-slot="9613194233"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        </div>
    </div>

    <div class="middel">
        <div class="middel--inner">
            <div class="messages">
                @yield('content')
            </div>
            <div class="sidebar">
{{--                <div class="banner">--}}
{{--                    <img src="https://lh3.googleusercontent.com/npew9dDnrDUsZl3lrIzjGAUr2SGR6qC2XLteyiNSeAp2SumD-eE3cruubr5FunAWyq0=w300-h250" alt="">--}}
{{--                </div>--}}
                @if(count($blogs_sidebar) != 0)
                <div class="box-blogs shadow">
                    <h4 class="title">أكثر المواضيع مشاهدة هذا الشهر</h4>
                    @foreach($blogs_sidebar as $blog)
                    <div class="box-blog">
                        <img src="{{ $blog->img }}" alt="{{ $blog->title }}">
                        <a href="{{route('blog')}}\{{$blog->slug}}"><h3>{{ $blog->title }}</h3></a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('components.footer')
