<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function studentsList()
    {
        return Student::all();
    }

    function addStudent(Request $request)
    {
        $rules = array(
            'name' => 'required|min:2|max:10',
            'email' => 'email|required',
            'phone' => 'required'
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;

            if ($student->save()) {
                return "Student Info Saved!";
            } else {
                return "Failed Saving Student Info!";
            }
        }
    }

    function updateStudent(Request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return "Student Info Updated!";
        } else {
            return "Failed Updating Student Info!";
        }
    }

    function deleteStudent($id)
    {
        $student = Student::destroy($id);
        if ($student) {
            return "Student Info Deleted!";
        } else {
            return "Deletation Failed!!";
        }
    }

    function searchStudent($name)
    {
        $student = Student::where('name', $name)->get();

        return $student;
    }



}
