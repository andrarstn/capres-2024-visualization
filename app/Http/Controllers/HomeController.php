<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    public function index()
    {
        $service = new HomeService();

        $data = $service->getData();

        return view('welcome', compact('data'));
    }
}
