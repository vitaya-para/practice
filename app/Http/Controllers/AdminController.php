<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return redirect(route('admin.course'));
    }
    public function courses()
    {
        return view('upload.courses');
    }

    public function students()
    {
        return view('upload.students');
    }
}
