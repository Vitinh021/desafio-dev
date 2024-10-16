<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        var_dump("aaa");
        die();
        return view('welcome_message');
    }
}
