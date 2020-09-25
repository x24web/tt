@extends('layouts.user')
@section('content')
    <div class="setting">
        {!! Form::open(['url' => '/admin/blog/update','files' => 'true']) !!}
        <div class="form-control" style="display: none">
            <label for="">id</label>
            {!! Form::text('id',$data->id) !!}
        </div>
        <div class="form-control">
            <label for="">العنوان</label>
            {!! Form::text('title',$data->title) !!}
        </div>
        <div class="form-control">
            <label for="">النص</label>
            <textarea name="body">{{$data->body}}</textarea>
        </div>
        <div class="form-control">
            <label for="">slug</label>
            {!! Form::text('slug',$data->slug) !!}
        </div>
        <div class="form-control">
            <label for="">تاريخ النشر</label>
            <input type="datetime-local" name="timepublish" value="{{$data->public_time}}">
        </div>
        <div class="form-control">
            <label for="">keyword</label>
            {!! Form::text('keyword',$data->keyword ) !!}
        </div>
        <div class="form-control">
            <label for="">description</label>
            {!! Form::text('description',$data->description) !!}
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
