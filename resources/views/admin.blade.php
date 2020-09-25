@extends('layouts.user')
@section('content')
    <div class="setting">
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
        {!! Form::open(['url' => '/admin/blog','files' => 'true']) !!}
        <div class="form-control">
            <label for="">العنوان</label>
            {!! Form::text('title') !!}
        </div>
        <div class="form-control">
            <label for="">النص</label>
            <textarea name="body"></textarea>
        </div>
        <div class="form-control">
            <label for="">slug</label>
            {!! Form::text('slug') !!}
        </div>
        <div class="form-control">
            <label for="">تاريخ النشر</label>
            <input type="datetime-local" name="timepublish">
        </div>
        <div class="form-control">
            <label for="">keyword</label>
            {!! Form::text('keyword') !!}
        </div>
        <div class="form-control">
            <label for="">description</label>
            {!! Form::text('description') !!}
        </div>
        <div class="form-control">
            <label for="">الصورة</label>
            {!! Form::file('photo',['accept'=>'.png, .jpg, .jpeg']) !!}
        </div>
        <div class="form-control">
            <label for="">is publish</label>
            {!! Form::text('ispublish','1') !!}
        </div>
        <button class="btn btn-primary" style="display: block;margin: 10px auto 0px;">حفط</button>
        {!! Form::close() !!}
    </div>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endsection
