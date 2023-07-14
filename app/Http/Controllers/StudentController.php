<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student= student::all();
        return response()-> json(['students'=>$student],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules= array(
            "name"    =>"required|alpha_spaces",
            "reg_no"  =>"required|unique:students",
            "mobile"  =>"required|numeric|digits_between:10,13",
            "email"   =>"required|email|unique:students",
            "dob"     =>"required|date_format:Y-m-d|before:16 years ago",
            "gender"  =>"required",
            "address" =>"required"
        );
        $validator = validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else{
            $student = new student();
            $student->name = $request->name;
            $student->reg_no = $request->reg_no;
            $student->mobile = $request->mobile;
            $student->email = $request->email;
            $student->dob = $request->dob;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $result= $student->save();
            if($result)
            {
                return response()->json([
                    'message'=>"data inserted sucessfully!!!!..",
                    'students'=>$student
                ],200);
            }
            else{
                return response()->json([
                    'message'=>"sorry something issue!!!!..",

                ],500);
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules= array(
            "name"    =>"required|alpha_spaces",
            "reg_no"  =>"required|unique:students,reg_no,".$id,
            "mobile"  =>"required|numeric|digits_between:10,13",
            "email"   =>"required|email|unique:students,email,".$id,
            "dob"     =>"required|date_format:Y-m-d|before:16 years ago",
            "gender"  =>"required",
            "address" =>"required"
        );
        $validator = validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else{
        $student = student::where('id',$id)->first();
        $student->name = $request->name;
        $student->reg_no = $request->reg_no;
        $student->mobile = $request->mobile;
        $student->email = $request->email;
        $student->dob = $request->dob;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $result=$student->save();
        if($result)
        {
            return response()->json([
                'message'=>"data updated sucessfully!!!!..",
                'students'=>$student
            ],200);
        }
        else{
            return response()->json([
                'message'=>"sorry something issue!!!!..",

            ],500);
        }

    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = student::find($id);

        if ($student) {
            $student->delete();

            return response()->json([
                'message' => "Data deleted successfully!"
            ],200);
        } else {
            return response()->json([
                'message' => "Data not exist..."
            ], 404);
        }
    }

    }

