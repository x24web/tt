@extends('layouts.auth')

@section('content')
@if (session('status'))
    <p style="color: green;padding: 0px 10px;text-align: center;">
        {{ session('status') }}
    </p>
@endif
<h3>إعادة تعين الرقم السري</h3>
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-control @error('email') error @enderror">
        <label for="email">إيميلك</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="form-control">
        <input type="submit" class="btn btn-primary block" value="إرسال رابط اعادة تعيين الرقم السري">
    </div>
</form>
@endsection
