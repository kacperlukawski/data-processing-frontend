<?php

class HomeController extends BaseController {

    public function getIndex() {
        return View::make('hello')->with('user', Auth::user());
    }

}
