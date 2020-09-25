@extends('layouts.home')
@section('content')
    @if(count($blogs) != 0)
        <div class="blogs">
        @foreach($blogs as $blog)
            <div class="blog-single">
                <a href="{{route('blog')}}/{{$blog->slug}}">
                    <img class="bg-img" src="{{ $blog->img }}" alt="{{ $blog->title }}">
                </a>
                <div class="details">
                    <p>بواسطة احمد الشعار - {{\Carbon\Carbon::parse($blog->public_time)->diffForhumans()}}</p>
                    <h3><a href="{{route('blog')}}/{{$blog->slug}}">{{ $blog->title }}</a></h3>
                    <p>{{ strip_tags(Str::limit($blog->body,300)) }}</p>
                </div>
            </div>
        @endforeach
            @if(($blogs->total()/10) > 1)
            <div class="pagination-nav">
                <ul class="pagination">
                    @if($blogs->currentPage() != $blogs->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{$blogs->nextPageUrl()}}" aria-label="Next">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    @endif
                    @foreach(range((integer)($blogs->total()/10)+1,1,-1) as $number)
                        @if($number == $blogs->currentPage())
                            <li class="page-item"><a class="page-link" style="background: #286ff3;color: #fff">{{$number}}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{$blogs->url($number)}}">{{$number}}</a></li>
                        @endif
                    @endforeach
                    @if($blogs->currentPage() != 1)
                    <li class="page-item">
                        <a class="page-link" href="{{$blogs->previousPageUrl()}}" aria-label="Previous">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
    @endif
@endsection
