<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller implements Authenticatable
{
    public function getAuthIdentifier(){

    }


    use AuthenticatesUsers;


    public $redirectTo = '/mapUser';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    public function redirectTo(){
        $user=Auth::user();
        if($user->isAdmin){
            return '/admin';
        }else{
            return '/mapUser';
        }

    }

    public function redirectToProvider()
    {

        return Socialite::driver('google')->redirect();

    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $google = Socialite::driver('google')->stateless()->user();

        $find = User::whereEmail($google->email)->first();
        if($find){
            Auth::login($find);
            return redirect('/mapUser');
        }else{
            $user = new User;
            $user->name = $google->name;
            $user->email=$google->email;
            $user->password = bcrypt(123456);
            $user->save();
            Auth::login($user);

            return redirect('/mapUser');
        }
        //return $user->getEmail();
    }

    public function redirectToProviderFacebook()
    {

        return Socialite::driver('facebook')->redirect();

    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackFacebook()
    {

        $facebook = Socialite::driver('facebook')->stateless()->user();

        $find = User::whereEmail($facebook->email)->first();
        if($find){

            Auth::login($find);

            return redirect('/mapUser');
        }else{
            $user = new User;
            $user->facebook_id = $facebook->id;
            $user->name = $facebook->name;
            $user->email=$facebook->email;
            $user->password = bcrypt(123456);
            $user->save();

            Auth::login($user);

            return redirect('/mapUser');

        }
        //return $user->getEmail();
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.

    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {

    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
