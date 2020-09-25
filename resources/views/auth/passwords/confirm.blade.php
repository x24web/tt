@extends('layouts.auth')

@section('content')
<h3>تاكيد الرقم السري</h3>
<p>الرجاء ادخال الرقم السري للمتابعة</p>
<form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <div class="form-control @error('password') error @enderror">
        <label for="password">الرقم السري</label>
        <input id="password" type="password" class="@error('password') error @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <input type="submit" class="btn btn-primary block" value="حفظ">
    <p class="other">
        @if (Route::has('password.request'))
            لا تستطيع الدخول لحسابك؟<a href="{{ route('password.request') }}"> إعادة تعين الرقم السري</a>
        @endif
    </p>
</form>
@endsection
