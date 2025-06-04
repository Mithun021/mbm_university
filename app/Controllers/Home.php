<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }
    public function about()
    {
        echo "<h1>This is About Us page new version</h1>";
    }
}
