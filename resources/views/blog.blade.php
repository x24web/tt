@extends('layouts.home')
@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v8.0&appId=616353995980602&autoLogAppEvents=1" nonce="JDkYTdxm"></script>
    @if(count($blogs) != 0)
        <div class="blogs">
        @foreach($blogs as $blog)
            <div class="blog-single">
                <img class="bg-img" src="{{ $blog->img }}" alt="{{ $blog->title }}">
                <div class="details">
                    <div class="social-login">
                        <p>{{\Carbon\Carbon::parse($blog->public_time)->diffForhumans()}}</p>
                        <input type="text" style="z-index: -9;position:absolute;right: -500%" value="{{route('blog')}}/{{$blog->slug}}" id="currentUrl" readonly>
                        <style>li.copy:active {
                                background: #dedede !important;
                                outline: 0;
                            }</style>
                        <ul>
                            <li class="copy"><a style="cursor: pointer;" id="copyBtn"><img src="{{asset('images/copy.png')}}" alt="copy"></a></li>
                            <li class="whatsapp"><a href="https://wa.me/?text={{route('blog')}}/{{ $blog->slug }}" target="_blank"><img src="{{asset('images/whatsapp.png')}}" alt="whatsapp"></a></li>
                            <li class="twitter"><a href="https://twitter.com/intent/tweet?text={{ $blog->title }}&amp;url={{route('blog')}}/{{ $blog->slug }}" target="_blank"><img src="{{asset('images/twitter.png')}}" alt="twitter"></a></li>
                            <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{route('blog')}}/{{ $blog->slug }}" target="_blank"><img src="{{asset('images/facebook.png')}}" alt="facebook"></a></li>
                        </ul>
                    </div>
                    <h3>{{ $blog->title }}</h3>
                    <p> {!! $blog->body !!} </p>
                </div>
            </div>
            <div class="blog-single">
                <div class="fb-comments" width="100%" data-href="{{Request::url()}}" data-numposts="5" data-width=""></div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
