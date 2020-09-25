<?php

namespace App\Http\Controllers;

use App\messages;
use App\messages_replay;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class other extends Controller
{
    private $file = 'https://sarahahs.s3.eu-west-3.amazonaws.com/';
    private $photo = "";
    private $cover = "";
    private $allData = [];
    public function SendMessages(Request $request,$username){
        $request->validate([
           'massages' => 'required',
        ]);
        $id = User::select('id','messages','views')->where('username',$username)->get()[0];
        $massage = new messages();
        $massage->body = $request->massages;
        $massage->user_id = $id->id;
        if($massage->save() == 1){
            $this->CountMessages(1,$username,$id->messages);
            $this->vistor($username,$id->views-2);
            return redirect(route('user',$username))->with('success', 'send!');
        }else{
            return redirect(route('user',$username))->with('error', 'error!');
        }
    }
    public function action(Request $request){
        $id = Auth::user()->id;
        $arr = explode("-",$request->value);
        $check = 0;
        if ($arr[0] == 'replay') {
            // create replay & display massage All
            $request->validate([
                'body' => 'required',
            ]);
            $messages_replay = new messages_replay();
            $messages_replay->body = $request->body;
            $messages_replay->save();
            User::where('id',$id)->update(['public_messages'=>Auth::user()->public_messages+1]);
            $check = messages::where('id',$arr[1])->where('user_id',$id)->update(['replay_id'=>$messages_replay->id,'lock'=>1]);
        }else if($arr[0] == 'deletere'){
            // create replay & hidden massage All
            $check = messages::where('replay_id',$arr[1])->where('user_id',$id)->update(['replay_id'=>0,'lock'=>0]);
            User::where('id',$id)->update(['public_messages'=>Auth::user()->public_messages-1]);
            if($check == 1){
                messages_replay::where('id',$arr[1])->delete();
            }
        }else if($arr[0] == 'delete') {
            $messages = messages::select('replay_id','lock')->where('id',$arr[1])->where('user_id',$id)->get();
            if($messages[0]->replay_id != 0){
                messages_replay::where('id',$messages[0]->replay_id)->delete();
            }
            if($messages[0]->lock != 0){
                User::where('id',$id)->update(['public_messages'=>Auth::user()->public_messages-1]);
            }
            $this->CountMessages(-1,Auth::user()->username,Auth::user()->messages);
            $messages = messages::where('id',$arr[1])->where('user_id',$id);
            $check = $messages->delete();
        }else if($arr[0] == 'unlock'){
            $check = messages::where('id',$arr[1])->where('user_id',$id)->update(['lock'=>1]);
            User::where('id',$id)->update(['public_messages'=>Auth::user()->public_messages+1]);
        }else if($arr[0] == 'lock'){
            $check = messages::where('id',$arr[1])->where('user_id',$id)->update(['lock'=>0]);
            User::where('id',$id)->update(['public_messages'=>Auth::user()->public_messages-1]);
        }
        if($check == 0){
            return redirect(route('profile'))->with('error', 'send!');
        }else{
            return redirect(route('profile'))->with('success', 'send!');
        }
    }
    public function CountMessages($count,$username,$number){
        if($count == 1){
            User::where('username',$username)->update(['messages' => $number+1]);
        }else{
            User::where('username',$username)->update(['messages' => $number-1]);
        }
    }
    static public function Vistor($username,$number){
        User::where('username',$username)->update(['views' => $number+1]);
    }
    public function Settings(Request $request){
        if($request->email != null){
        if($request->email != Auth::user()->email){
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            $this->allData = array_merge($this->allData,array('email'=>$request->email));
        }}
        if($request->name != Auth::user()->name){
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $this->allData = array_merge($this->allData,array('name'=>$request->name));
        }
        if($request->photo != null){
            $request->validate([
                'photo' => 'mimes:jpeg,png,jpg,gif|max:50000',
            ]);
        }
        if($request->cover != null){
            $request->validate([
                'cover' => 'image|mimes:jpeg,png,jpg,gif|max:50000',
            ]);
        }
        if($request->password != null){
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $this->allData = array_merge($this->allData,array('password'=>$request->password));
        }
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images','s3');
            $this->photo = $this->file . $path;
            $this->allData = array_merge($this->allData,array('img_profile'=>$this->photo));
        }
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('images','s3');
            $this->cover = $this->file . $path;
            $this->allData = array_merge($this->allData,array('cover_profile'=>$this->cover));
        }
        $value = $this->allData;
        if(User::where('id',Auth::user()->id)->update($value)){
            return redirect(route('settings'))->with('success','win');
        }
    }
    public function create(Request $request){
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images','s3');
            $this->cover = $this->file . $path;
            \App\blogs::create(['title'=>$request->title,'body'=>$request->body,'slug'=>$request->slug,'public_time'=>$request->timepublish,'keyword'=>$request->keyword,'description'=>$request->description,'is_public'=>$request->ispublish,'img'=>$this->cover]);
            return redirect(route('adminblog'));
        }
        \App\blogs::create(['title'=>$request->title,'body'=>$request->body,'slug'=>$request->slug,'public_time'=>$request->timepublish,'keyword'=>$request->keyword,'description'=>$request->description,'is_public'=>$request->ispublish]);
    }
    public function update(Request $request){
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images','s3');
            $this->cover = $this->file . $path;
            \App\blogs::where('id',$request->id)->update(['title'=>$request->title,'body'=>$request->body,'slug'=>$request->slug,'keyword'=>$request->keyword,'description'=>$request->description,'is_public'=>$request->ispublish,'img'=>$this->cover]);
        }
        \App\blogs::where('id',$request->id)->update(['title'=>$request->title,'body'=>$request->body,'slug'=>$request->slug,'keyword'=>$request->keyword,'description'=>$request->description,'is_public'=>$request->ispublish]);
        return redirect(route('blogs'));
    }
}
