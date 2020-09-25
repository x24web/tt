@extends('layouts.auth')

@section('content')
<h3>تسجيل دخول</h3>
<div class="social-login">
    <p>تسجيل دخول من خلال مواقع التواصل الاجتماعي</p>
    <ul>
        <li class="facebook"><a href="{{ route('login.facebook') }}"><img src="{{ asset('images/facebook.png') }}" alt="فيسبوك"></a></li>
        <li class="twitter"><a href="{{ route('login.twitter') }}"><img src="{{ asset('images/twitter.png') }}" alt="توتير"></a></li>
        <li class="google"><a href="{{ route('login.google') }}"><img src="{{ asset('images/google.png') }}" alt="جوجل"></a></li>
    </ul>
</div>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-control @error('email') error @enderror">
        <label for="email">إيميلك</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="form-control @error('password') error @enderror">
        <label for="password">الرقم السري</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div style="margin-bottom: 5px">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">تذكر تسجيل الدخول</label>
    </div>

    <div class="form-control">
        <input type="submit" class="btn btn-primary block" value="تسجيل دخول">
    </div>
    <p class="other">
        @if (Route::has('password.request'))
            لا تستطيع الدخول لحسابك؟<a href="{{ route('password.request') }}"> إعادة تعين الرقم السري</a>
        @endif
    </p>
    <p class="other">ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب</a></p>
</form>
@endsection
