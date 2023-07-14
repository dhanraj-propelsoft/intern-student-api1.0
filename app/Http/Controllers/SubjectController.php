<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Request;
use Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student= subject::all();
        return response()-> json(['subjects'=>$subject],200);
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
            "sub_name"    =>"required",
            "sub_code"  =>"required",
            "min_pass_mark"  =>"required|numeric|max:100"
           );
        $validator = validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else{
            $subject = new subject();
            $subject->sub_name = $request->sub_name;
            $subject->sub_code = $request->sub_code;
            $subject->min_pass_mark = $request->min_pass_mark;
            $result= $subject->save();
        if($result)
        {
            return response()->json([
                'message'=>"subject data stored sucessfully!!!!..",
                'subjects'=>$subject
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
    public function show(subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $rules= array(
            "sub_name"    =>"required",
            "sub_code"  =>"required",
            "min_pass_mark"  =>"required|numeric"
        );
        $validator = validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else{
        $subject = subject::where('id',$id)->first();
        $subject->sub_name = $request->sub_name;
        $subject->sub_code = $request->sub_code;
        $subject->min_pass_mark = $request->min_pass_mark;
        $result= $subject->save();
        if($result)
        {
            return response()->json([
                'message'=>"data updated sucessfully!!!!..",
                'subjects'=>$subject
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
        $subject = subject::find($id);

        if ($subject) {
            $subject->delete();

            return response()->json([
                'message' => "subject deleted successfully!"
            ],200);
        } else {
            return response()->json([
                'message' => "subject not exist..."
            ], 404);
        }

    }
}
