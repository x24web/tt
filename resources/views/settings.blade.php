@extends('layouts.user')
@section('content')
    <div class="setting">
        <style>
            .two-col{
                margin: 8px 0px;
            }
        </style>
        @if(session('error'))
            <h2 style="text-align: center;padding: 20px;color: red;">حدث مشكلة انثاء تنفيذ العملية الرجاء المحاولة لاحقا</h2>
        @elseif(session('success'))
            <h2 style="text-align: center;padding: 20px;color: #0bb90b;">تم تنفيذ العملية بنجاح</h2>
        @endif
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        {!! Form::open(['url' => '/settings','files' => 'true']) !!}
        <div class="two-col">
                <div class="form-control">
                    <label for="">اسمك</label>
                    {!! Form::text('name',Auth::user()->name) !!}
                </div>
                @if(is_null(Auth::user()->provider))
                <div class="form-control">
                    <label for="">إيميلك</label>
                    {!! Form::email('email',Auth::user()->email) !!}
                </div>
                @endif
            </div>
            <div class="two-col">
                <div class="form-control">
                    <label for="">صورتك</label>
                    {!! Form::file('photo',['accept'=>'.png, .jpg, .jpeg']) !!}
                </div>
                <div class="form-control">
                    <label for="">صورة الغلاف</label>
                    {!! Form::file('cover',['accept'=>'.png, .jpg, .jpeg']) !!}
                </div>
            </div>
            @if(is_null(Auth::user()->provider))
            <p style="margin-bottom: 0;">لتغير الرقم السري:- في حالة تاركهم فارغين لن يتم تغير الرقم السري</p>
            <div class="two-col">
                <div class="form-control">
                    <label for="">كلمة السر</label>
                    {!! Form::password('password') !!}
                </div>
                <div class="form-control">
                    <label for="">تاكيد كلمة السر</label>
                    {!! Form::password('password_confirmation') !!}
                </div>
            </div>
            @endif
            <button class="btn btn-primary" style="display: block;margin: 10px auto 0px;">حفط</button>
        {!! Form::close() !!}
    </div>
@endsection
