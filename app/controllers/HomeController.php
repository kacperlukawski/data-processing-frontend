<?php

class HomeController extends BaseController {

    public function getIndex() {
        return View::make('hello.index')
                        ->with('user', Auth::user());
    }

}
