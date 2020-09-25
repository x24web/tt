@extends('layouts.user')
@section('content')
    @if(Auth::check())
        @if(strtolower(Auth::user()->username) == $user->username)
        <h2 style="text-align: center;padding: 0px 5rem;color: var(--primary--color--hover);">لا يمكنك الارسال الي نفسك شارك الرابط مع الاصدقائك حتي تسطيع استقبال الرسائل</h2>
        @else
            @include('components.publish_massages')
        @endif
    @else
        @include('components.publish_massages')
    @endif
@endsection
