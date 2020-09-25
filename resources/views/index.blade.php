@extends('layouts.home')
@section('content')
    @if(!Auth::check())
    <div class="form-side" style="align-items: flex-start;">
        <div class="form-side-inner" style="margin-top: 0;">
            @include('components.register_form')
        </div>
    </div>
    @else
    <div class="form-side" style="height: auto !important;margin-bottom: 25px;">
        <div class="form-side-inner" style="margin-top: 0;">
                        <h3>مرحبا بك {{Auth::user()->name }} هذا بعض المقالات ربما تنال اعجابك ويمكنك الدخول لحسابك <a href="{{ route('profile') }}" > من هنا </a>
        </div>
    </div>
@endif
    @if(isset($blogs))
        @if(count($blogs) != 0)
            <div class="blogs">
            <div class="title-blog">
                <h3 class="title">اخر المقالات</h3>
                <h3 class="more"><a href="{{route('blogs')}}">عرض الكل</a></h3>
            </div>
            @foreach($blogs as $blog)
                <div class="blog-single">
                    <a href="{{route('blog')}}/{{$blog->slug}}">
                        <img class="bg-img" src="{{ $blog->img }}" alt="{{ $blog->title }}">
                    </a>
                    <div class="details">
                        <p>{{\Carbon\Carbon::parse($blog->public_time)->diffForhumans()}}</p>
                        <h3><a href="{{route('blog')}}/{{$blog->slug}}">{{ $blog->title }}</a></h3>
                        <p>{{ strip_tags(Str::limit($blog->body,300)) }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    @endif
@endsection
