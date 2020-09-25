@include('components.header')
<div class="page-into">
    <div class="container">
        <div class="img-side">
            <img src="{{ asset('images/login.png') }}" alt="موقع صراحة">
        </div>
        <div class="form-side">
            <div class="form-side-inner">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('components.footer')
