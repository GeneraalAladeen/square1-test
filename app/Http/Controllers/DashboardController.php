<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('dashboard');
    }
}
