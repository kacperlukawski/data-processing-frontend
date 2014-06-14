<?php

class UserController extends \BaseController {

    public function getLogin() {
        return View::make('hello');
    }

    public function postLogin() {
        // check user credentials and redirect to the homepage
    }

    public function getRegister() {
        // display register form
    }

    public function postRegister() {
        // add new user based on sent data
    }

    public function anyLogout() {
        // logout user
    }

}
