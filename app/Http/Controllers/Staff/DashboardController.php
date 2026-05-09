<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Memanggil file dashboard.blade.php yang ada di folder resources/views/Staff/
        return view('Staff.dashboard');
    }
}