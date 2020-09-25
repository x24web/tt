<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $existingUser = User::where('provider_id', $user->getId())->first();
        if($existingUser){
            if(strpos($existingUser->img_profile,"aws") == false){
            	$existingUser->img_profile = $user->getAvatar();
            	$existingUser->save();
            }
            auth()->login($existingUser, true);
        } else {
            $newuser                   = new User;
            $newuser->name             = $user->getName();
            $newuser->provider_id      = $user->getId();
            $username = strtolower(preg_replace("/[^a-zA-Z0-9]+/", '', $newuser->name));
            while (true){
                $check = User::where('username',$username)->get();
                if(count($check) != 0){
                    $username = $username . rand(1, 99999);
                }else{
                    break;
                }
            }
            $newuser->username          = $username;
            $newuser->email            = $username."@google.com";
            $newuser->img_profile      = $user->getAvatar();
            $newuser->provider         = "google";
            $newuser->save();
            auth()->login($newuser, true);
        }
        return redirect()->to('/profile');
    }
}
