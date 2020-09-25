@extends('layouts.auth')

@section('content')
<h3>إعادة تعين الرقم السري</h3>
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-control @error('email') error @enderror">
        <label for="email">إيميلك</label>
        <input id="email" type="email" class="@error('email') error @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-control @error('password') error @enderror">
        <label for="password">الرقم السري</label>
        <input id="password" type="password" class="@error('password') error @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-control">
        <label for="password_confirmation">تاكيد الرقم السري</label>
        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
    </div>
    <input type="submit" class="btn btn-primary block" value="حفظ">
</form>
@endsection
