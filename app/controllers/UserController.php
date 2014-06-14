<?php

class UserController extends \BaseController {

    public function getLogin() {
        return View::make('user.login')
                        ->with('user', Session::get('user'));
    }

    public function postLogin() {
        $userData = Input::only('email', 'password');

        $userDataValidator = Validator::make($userData, array(
                    'email' => 'required|email|exists:users,email',
                    'password' => 'required|digits_between:3,100'
        ));

        if ($userDataValidator->fails()) {
            return Redirect::action('UserController@getLogin')
                            ->with('user', $userData)
                            ->withErrors($userDataValidator);
        }

        if (Auth::attempt($userData)) {
            return Redirect::intended('/');
        }

        return Redirect::action('UserController@getLogin')
                        ->with('user', $userData)
                        ->withErrors(array(
                            'password' => 'The given password is incorrect'
        ));
    }

    public function getRegister() {
        return View::make('user.register')
                        ->with('user', Session::get('user'));
    }

    public function postRegister() {
        $userData = Input::only('email', 'password', 'password_confirmation');

        $userDataValidator = Validator::make($userData, array(
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|digits_between:3,100',
                    'password_confirmation' => 'required|same:password'
        ));

        if ($userDataValidator->fails()) {
            return Redirect::action('UserController@getRegister')
                            ->with('user', $userData)
                            ->withErrors($userDataValidator);
        }

        $user = new User;
        $user->email = Input::get('email');
        $user->password = Input::get('password');
        $user->save();

        return Redirect::action('UserController@getLogin');
    }

    public function anyLogout() {
        Auth::logout();
        return Redirect::intended('/');
    }

}
