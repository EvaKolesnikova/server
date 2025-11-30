<?php

namespace Controller;

use Src\View;
use Src\Request;

class SiteController
{
    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function index(Request $request): string
    {
        return (new View())->render('site.post');
    }
}
