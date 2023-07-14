<?php

namespace App\Http\Controllers;

use App\Models\exam;
use Illuminate\Http\Request;
use Validator;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student= exam::all();
        return response()-> json(['exams'=>$exam],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules= array(
        "examid"    =>"required|unique:exams"
        );
        $validator = validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {
        $exam = new exam();
        $exam->examid = $request->examid;
        $result=$exam->save();

        if($result)
        {
            return response()-> json([
                'message'=>'exam_id added sucessfully.....!',
                'exams'=>$exam
            ],200);

        }
        else
        {
            return response()-> json([
                'message'=>'exam_id added sucessfully.....!'
            ],500);
        }
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules= array(
            "examid" =>"required|unique:exams"
            );
            $validator = validator::make($request->all(),$rules);

            if($validator->fails())
            {
                return response()->json($validator->errors(),401);
            }
            else{
        $exam = exam::where('id',$id)->first();
        $exam->examid = $request->examid;
        $result=$exam->save();
        if($result){
            return response()-> json([
                'message'=>'exam_id updated sucessfully.....!',
                'exams'=>$exam
            ],200);

        }else{
            return response()-> json([
                'message'=>'Something went wrong.....!'
            ],500);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = exam::find($id);

        if ($exam)
        {
            $exam->delete();
            return response()->json([
                'message' => "Exam_id Deleted Successfully!"
            ],200);
        } else
        {
            return response()->json([
                'message' => "Exam_id not exist..."
            ], 404);
        }
    }
}

