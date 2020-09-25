<?php
use App\blogs;
$blogs_sidebar = blogs::where('is_public','=','1')->where('public_time','<=', now())->orderBy('views_month','desc')->take(10)->get();
?>
@include('components.header')
<div id="main">
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
                <div class="banner" style="display:none;"></div>
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
