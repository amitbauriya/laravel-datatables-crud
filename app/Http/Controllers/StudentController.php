<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students.index');
    }

    public function importExportExcelORCSV(){
        return view('students.index');
    }

    public function getCustomFilter()
{
    return view('students.index');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            Student::create($request->all());

            return response()->json(['success' => 'data is successfully added'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        try
        {
            return response()->json(['success' => 'successfull retrieve data', 'data' => $student->toJson()], 200);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        try
        {

            $student = Student::findOrFail($student->id);
            $student->studname = $request->studname;
            $student->dob = $request->dob;
            $student->class = $request->class;
            $student->gender = $request->gender;
            $student->status = $request->status;
            $student->district = $request->district;
            $student->state = $request->state;
            $student->donor = $request->donor;
            $student->update();

            return response()->json(['success' => 'data is successfully updated'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try
        {
            Student::destroy($student->id);

            return response()->json(['success' => 'data is successfully deleted'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function importFileIntoDB(Request $request){
        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['studname' => $value->studname, 'dob' => $value->dob, 'class' => $value->class, 'gender' => $value->gender, 'status' => $value->status, 'district' => $value->district, 'state' => $value->state, 'donor' => $value->donor];
                }
                if(!empty($arr)){
                    \DB::table('students')->insert($arr);
                    dd('Insert Record successfully.');
                }
            }
        }
        dd('Request data does not have any files to import.');
    }

    public function downloadExcelFile($type){
        $student = Student::get()->toArray();
        return \Excel::create('student-db', function($excel) use ($student) {
            $excel->sheet('sheet name', function($sheet) use ($student)
            {
                $sheet->fromArray($student);
            });
        })->download($type);
    }



public function getCustomFilterData(Request $request)
{

    $student = Student::select(['id', 'studname', 'dob', 'class', 'gender', 'status', 'district', 'state', 'donor', 'created_at', 'updated_at'])->get();

    return Datatables::of($student)
                ->filter(function ($instance) use ($request) {
                    if ($request->has('studname')) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['studname'], $request->get('studname')) ? true : false;
                        });
                    }

                    if ($request->has('district')) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['district'], $request->get('district')) ? true : false;
                        });
                    }
                })
                ->make(true);
}

}
