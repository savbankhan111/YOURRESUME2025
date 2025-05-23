<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreadcrumbController extends Controller
{
    public function showPage()
    {
        $breadcrumbs = [
            
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Page Title', 'url' => route('page.title')]
        ];

        return view('layouts.auth', compact('breadcrumbs'));
    }
}
