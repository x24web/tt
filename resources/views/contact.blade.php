@extends('layouts.home')
@section('content')
    <div class="blogs">
        <div class="blog-single">
            <div class="details">
                <h3 style="text-align: center;">اتصل بنا</h3>
                <p>يمكنكم التواصل معانا من خلال الايميل الخاص بنا: sarahahs.com@gmail.com</p>
                <p>أو يمكنكم التواصل معانا من خلال احدي مواقع التواصل الاجتماعي</p>
                <div class="social-login">
                    <ul style="margin: 10px auto;">
                        <li class="instagram"><a href="https://www.instagram.com/sarahahscom/"><img src="{{asset('images/instagram.png')}}" alt="instagram"></a></li>
                        <li class="twitter"><a href="https://twitter.com/sarahahscom"><img src="{{asset('images/twitter.png')}}" alt="twitter"></a></li>
                        <li class="facebook"><a href="https://www.facebook.com/sarahahscom"><img src="{{asset('images/facebook.png')}}" alt="facebook"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
