<?php

namespace App\Http\Controllers;

use App\Student;
use Yajra\DataTables\Facades\DataTables;

class StudentGetController extends Controller
{
    public function index()
    {
        // return DataTables::eloquent(Student::query())->make(true);
        try
        {
            $students = Student::select(['id', 'studname', 'dob', 'class', 'gender', 'status', 'district', 'state', 'donor']);

            return DataTables::of($students)
                ->addColumn('action', function ($students) {
                    return '<button student_id="' . $students->id . '" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Edit</button> <button student_id="' . $students->id . '" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
                })
                ->make(true);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
