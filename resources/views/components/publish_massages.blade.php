<div class="all-messages">
    @if(session('success'))
        <style>#main .middel .middel--inner .messages .all-messages h2{
                padding: 0px !important;
            }
        </style>
        <h2 style="font-size: 20px;padding: 0px 5rem;text-align: center;color: green;margin-top: 0;">تم ارسال رسالتك بنجاح يمكنك عمل حساب الان واستقبال الرسائل من الاصدقاء</h2>
        @if(!Auth::check())
            <div class="form-side" style="align-items: flex-start;">
                <div class="form-side-inner" style="margin-top: 0;">
                    @include('components.register_form')
                </div>
            </div>
        @endif
    @elseif(session('error'))
        <h2 style="font-size: 20px;padding: 0px 5rem;text-align: center;color: red;margin-top: 0;">لم يتم ارسال الرسالة الرجاء المحاولة لاحقا</h2>
    @else
        <div class="send-box shadow" style="padding: 10px 0px 0px;">
            {!! Form::open(['url' => '/w/' . $user->username]) !!}
            {{ Form::textarea('email','',['cols'=>30,'rows'=>10,'name'=>'massages','placeholder'=>'اكتب لصديقك ما تريد هنا','required'=>true]) }}
            
            <button class="btn btn-primary">إرسال</button>
            {!! Form::close() !!}
        </div>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- responsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2910164969130337"
     data-ad-slot="6728026500"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        @foreach(\App\messages::where('user_id',$user->id)->where('lock',1)->orderBy('created_at','desc')->get() as $massage)
            @if($massage->replay_id == 0)
                <div class="box shadow">
                    <p>{{$massage->body}}</p>
                    <div class="control">
                        <p class="time">{{\Carbon\Carbon::parse($massage->created_at)->diffForhumans()}}</p>
                        <div class="person">
                            <p style="margin-top: 0;margin-bottom: 0;">مجهول</p>
                            <img src="{{asset('images/person.png')}}" alt="مجهول">
                        </div>
                    </div>
                </div>
            @else
                <div class="box-replay">
                    <div class="box shadow">
                        <p>{{$massage->body}}</p>
                        <div class="control">
                            <p class="time">{{\Carbon\Carbon::parse($massage->created_at)->diffForhumans()}}</p>
                            <div class="person">
                                <p style="margin-top: 0;margin-bottom: 0;">مجهول</p>
                                <img src="{{asset('images/person.png')}}" alt="مجهول">
                            </div>
                        </div>
                    </div>
                    @foreach(\App\messages_replay::where('id',$massage->replay_id)->get() as $replay)
                        <div class="box-replay--inner box shadow">
                            <p>{{$replay->body}}</p>
                            <div class="control">
                                <p class="time">{{\Carbon\Carbon::parse($replay->created_at)->diffForhumans()}}</p>
                                <div class="person">
                                    <p>{{$user->name}}</p>
                                    @if($user->img_profile == '')
                                        <img src="{{asset('images/person.png')}}" alt="{{$user->name}}">
                                    @else
                                        <img src="{{$user->img_profile}}" alt="{{$user->name}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    @endif
</div>
