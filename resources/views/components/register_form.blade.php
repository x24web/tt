<h3>إنشاء حساب</h3>
<div class="social-login">
    <p>التسجيل من خلال مواقع التواصل الاجتماعي</p>
    <ul>
        <li class="facebook"><a href="{{ route('login.facebook') }}"><img src="{{ asset('images/facebook.png') }}" alt="فيسبوك"></a></li>
        <li class="twitter"><a href="{{ route('login.twitter') }}"><img src="{{ asset('images/twitter.png') }}" alt="توتير"></a></li>
        <li class="google"><a href="{{ route('login.google') }}"><img src="{{ asset('images/google.png') }}" alt="جوجل"></a></li>
    </ul>
</div>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-control @error('name') error @enderror">
        <label for="name">إسمك</label>
        <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-control @error('email') error @enderror">
        <label for="email">إيميلك</label>
        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div id="username" class="form-control @error('username') error @enderror">
        <label for="username">اسم المستخدم</label>
        <input type="text" name="username" value="{{ old('username') }}" required autocomplete="username">
        <p style="text-align: left;direction: ltr;margin: 0;">www.sarahahs.com/w/<span></span></p>
        <p style="margin: 0;"></p>
        @error('username')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-control @error('password') error @enderror">
        <label for="password">الرقم السري</label>
        <input type="password" name="password" required autocomplete="current-password">
        @error('password')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-control">
        <label for="password_confirmation">تاكيد الرقم السري</label>
        <input type="password" name="password_confirmation" required autocomplete="current-password">
    </div>
    <div class="two-col">
        <div class="form-control">
            <label for="gender">اختار الجنس</label>
            <select name="gender" required>
                <option value="0" selected="selected" disabled="disabled" hidden="">اختار</option>
                <option value="1">انثي</option>
                <option value="2">ذكر</option>
            </select>
            @error('gender')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-control">
            <label for="age">اختار السن</label>
            <select name="age" required  onmousedown="if(this.options.length>5){this.size=5;}" onchange="this.blur()" onblur="this.size=0;" style="position: absolute;z-index: 2;">
                <option value="0" selected="selected" disabled="disabled" hidden="">اختار</option>
                @foreach(range(16,70,1) as $number)
                    <option value="{{$number}}">{{$number}}</option>
                @endforeach
            </select>
            @error('age')
            <p>{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-control">
        <input type="submit" class="btn btn-primary block" value="تسجيل">
    </div>
    <p class="other">هل لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل دخول</a></p>
</form>
