<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoubleSwitchController extends Controller
{
    // Hanya menampilkan halaman portal Double Switch
    public function index()
    {
        return view('SuperAdmin.more.double_switch');
    }
}