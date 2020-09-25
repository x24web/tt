@extends('layouts.user')
@section('content')
    @if(Auth::user()->messages == 0)
        <h2 style="text-align: center;padding: 20px;color: var(--primary--color--hover);">لم تستلم اي رسايل بعد. شارك الرابط مع الاصدقاء حتي تستطيع استقبال الرسائل</h2>
    @else
	@error('body')
            <h2 style="text-align: center;padding: 20px;color: red;">لا يمكن ان يكون الرد فارغا</h2>
        @enderror

        @if(session('error'))
            <h2 style="text-align: center;padding: 20px;color: red;">حدث مشكلة انثاء تنفيذ العملية الرجاء المحاولة لاحقا</h2>
        @elseif(session('success'))
            <h2 style="text-align: center;padding: 20px;color: #0bb90b;">تم تنفيذ العملية بنجاح</h2>
        @endif
        <div class="all-messages">
        @foreach(\App\Ads::all() as $ads)
            <div class="box shadow">
                <p>{{$ads->body}}
                    @if($ads->like != '')
                        <a href="{{$ads->like}}">إضغط هنا</a>
                    @endif
                </p>
                <div class="control">
                    <p class="time">{{\Carbon\Carbon::parse($ads->created_at)->diffForhumans()}}</p>
                    <p style="margin: 0;background: yellow;padding: 2px 15px;border-radius: 50px;">إعلان</p>
                </div>
            </div>
        @endforeach
        @foreach(\App\messages::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get() as $message)
            @if($message->replay_id == 0)
                <div class="box shadow">
                    <p>{{$message->body}}</p>
                    <div class="control">
                        <p class="time">{{\Carbon\Carbon::parse($message->created_at)->diffForhumans()}}</p>
                        <ul>
                            @if($message->lock == 0)
                            <li><a href="#" id="unlock-{{$message->id}}"><img src="{{asset('images/lock.png')}}"></a></li>
                            @else
                            <li><a href="#" id="lock-{{$message->id}}"><img width="18px" src="{{asset('images/unlock.png')}}"></a></li>
                            @endif
                            <li><a href="#" id="replay-{{$message->id}}"><img src="{{asset('images/replay.png')}}"></a></li>
                            <li><a href="#" id="delete-{{$message->id}}"><img src="{{asset('images/delete.png')}}"></a></li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="box-replay">
                    <div class="box shadow">
                        <p>{{$message->body}}</p>
                        <div class="control">
                            <p class="time">{{\Carbon\Carbon::parse($message->created_at)->diffForhumans()}}</p>
                            <ul>
                                @if($message->lock == 0)
                                    <li><a href="#" id="unlock-{{$message->id}}"><img src="{{asset('images/lock.png')}}"></a></li>
                                @else
                                    <li><a href="#" id="lock-{{$message->id}}"><img width="18px" src="{{asset('images/unlock.png')}}"></a></li>
                                @endif
                                <li><a href="#" id="delete-{{$message->id}}"><img src="{{asset('images/delete.png')}}"></a></li>
                            </ul>
                        </div>
                    </div>
                    @foreach(\App\messages_replay::where('id',$message->replay_id)->get() as $replay)
                        <div class="box-replay--inner box shadow">
                            <p>{{$replay->body}}</p>
                            <div class="control">
                                <p class="time">{{\Carbon\Carbon::parse($replay->created_at)->diffForhumans()}}</p>
                                <div class="person">
                                    <p>{{Auth::user()->name}}</p>
                                    @if(Auth::user()->img_profile == '')
                                        <img src="{{asset('images/person.png')}}" alt="{{Auth::user()->name}}">
                                    @else
                                        <img src="{{Auth::user()->img_profile}}" alt="{{Auth::user()->name}}">
                                    @endif
                                </div>
                                <ul>
                                    <li>
                                        <a href="#" id="deletere-{{$replay->id}}">
                                            <img src="{{asset('images/delete.png')}}">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
        </div>
        <div id="popup" style="display: none;position: fixed;background: #00000050;height: 100vh;width: 100vw;top: 0;right: 0;left: 0;z-index: 100">
            <div class="content" style="width: 40%;background: #FFF;padding: 10px 20px 40px;border-radius: 20px;box-shadow: 1px 1px 10px #00000036;margin: auto;margin-top: 40vh;">
                <h2 style="text-align: center">هل انت متاكد من انك تريد فعل ذلك</h2>
                <div style="display: flex;justify-content: space-around;">
                    {!! Form::open(['url' => 'profile/action','style'=>'width:100%']) !!}
                        <input id="value_action" style="display: none" value="" name="value">
                        <div style="display: flex;justify-content: space-evenly;">
                            <button class="btn btn-primary" type="submit" style="background: #0bb90b;">تاكيد</button>
                            <button class="btn btn-primary close" type="button" style="background: red;">الغاء</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div id="popuprepay" style="display: none;position: fixed;background: #00000050;height: 100vh;width: 100vw;top: 0;right: 0;left: 0;z-index: 100">
            <div class="content" style="width: 40%;background: #FFF;padding: 10px 20px 40px;border-radius: 20px;box-shadow: 1px 1px 10px #00000036;margin: auto;margin-top: 15vh;">
                <h2 style="text-align: center">اكتب الرد الخاص بك وستصبح الرسالة مرئي لجميع من يدخل حسابك</h2>
                <div style="display: flex;justify-content: space-around;">
                    {!! Form::open(['url' => 'profile/action','style'=>'width:100%']) !!}
                    <input id="id_message" style="display: none" value="" name="value">
                    <textarea name="body" rows="10" style="display: block;margin: 10px auto 15px;width: 100%;border: 0;border-radius: 10px;box-shadow: 0 2px 10px rgba(0,0,0,.21);resize: vertical;min-height: 180px;outline: 0;padding: 10px;" required></textarea>
                    <div style="display: flex;justify-content: space-evenly;">
                        <button class="btn btn-primary" type="submit" style="background: #0bb90b;">تاكيد</button>
                        <button class="btn btn-primary close" type="button" style="background: red;">الغاء</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <script defer>
                let elements = document.querySelectorAll('.control a');
                let popup = document.getElementById('popup');
                let popuprepay = document.getElementById('popuprepay');
                let popupClose = document.querySelectorAll('form .close');
                if(elements!=null){
                    elements.forEach(myFunction)
                }
                function myFunction(item) {
                    item.addEventListener('click',function (e) {
                        e.preventDefault();
                        let x = e.target.parentElement.getAttribute('id');
                        if(x.includes('replay')){
                            document.querySelector('#popuprepay form #id_message').value = x;
                            popuprepay.style.display = "block";
                        }else{
                            document.querySelector('#popup form #value_action').value = x;
                            popup.style.display = "block";
                        }
                    })
                }
                if(popupClose != null){
                    popupClose[0].addEventListener('click',function (e) {
                        e.preventDefault();
                        popup.style.display = "none";
                        popuprepay.style.display = "none";
                    });
                    popupClose[1].addEventListener('click',function (e) {
                        e.preventDefault();
                        popup.style.display = "none";
                        popuprepay.style.display = "none";
                    });
                }
            </script>
    @endif
@endsection
