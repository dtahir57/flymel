<?php

namespace App\Http\Controllers\Admin;
use app\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Super_User']);
    }
    public function index()
    {
        return view('admin.home');
    }
}
