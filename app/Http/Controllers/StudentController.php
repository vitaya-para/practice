<?php

namespace App\Http\Controllers;

use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $cas = User::find(Auth::user()['id'])->cas_id;
        StudentCourse::getDataByCasId($cas);
    }
}
