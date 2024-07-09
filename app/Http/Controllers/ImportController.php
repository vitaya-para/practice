<?php

namespace App\Http\Controllers;

use App\Models\StudentCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{

    public function courses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.course')
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('file');
        Course::parseCsvAndStore($file);

        return redirect()->route('admin.course')->with('success', 'Курсы успешно добавлены.');
    }

    public function students(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:json,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.students')
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('file');

        $semester = date('Y') . ' ' .  (((int)date('m') <= 6) ? 'весна' : 'осень');
        $jsonData = $file->get();
        StudentCourse::parseJsonAndStore($jsonData, $semester);

        return redirect()->route('admin.students')->with('success', 'File uploaded and data processed successfully.');
    }
}
