<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentCourse extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'student_id', 'course_id', 'semester'];

    public static function parseJsonAndStore($jsonData, $semester)
    {
        $data = json_decode($jsonData, true);

        if (is_array($data)) {
            foreach ($data as $record) {
                if (isset($record['student_id']) && isset($record['courses'])) {
                    $student_id = $record['student_id'];
                    foreach ($record['courses'] as $course_id) {
                        self::create([
                            'student_id' => $student_id,
                            'course_id' => $course_id,
                            'semester' => $semester
                        ]);
                    }
                }
            }
        }
    }

    public static function getDataByCasId($cas)
    {
        $raw = DB::table('student_courses')
            ->join('courses', 'student_courses.course_id', '=', 'courses.id')
            ->where('student_courses.student_id', $cas)
            ->get();

        $data = array();
        foreach ($raw as $record) {
            if( ! isset($data[$record->semester])) {
                $data[$record->semester] = [
                    'short_name' => $record->semester,
                    'full_name' => $record->semester,
                    'courses' => []
                ];
            }

            $data[$record->semester]['courses'][] = [
                'name' => $record->name,
                'teacher' => $record->teacher,
                'exam' => $record->exam,
            ];
        }

        return view('panel', compact('data'));
    }
}
