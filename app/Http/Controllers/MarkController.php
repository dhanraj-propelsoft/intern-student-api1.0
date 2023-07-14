<?php

namespace App\Http\Controllers;

use App\Models\mark;
use Illuminate\Http\Request;
use Validator;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mark= mark::all();
        return response()-> json(['marks'=>$mark],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mark= mark::all();
        return response()-> json(['marks'=>$mark],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules= array(
            "reg_no"    =>"required|unique:marks,reg_no,NULL,id,examid,".$request->examid,
            "examid"  =>"required|unique:marks,examid,NULL,id,reg_no,".$request->reg_no,
            "sub_id1"  =>"required",
            "sub_id1_mark"   =>"required|numeric",
            "sub_id2"     =>"required",
            "sub_id2_mark"  =>"required|numeric",
            "sub_id3" =>"required",
            "sub_id3_mark"  =>"required|numeric"

        );
        $validator = validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else{
            $mark = new mark();
            $mark->reg_no = $request->reg_no;
            $mark->examid = $request->examid;
            $mark->sub_id1 = $request->sub_id1;
            $mark->sub_id1_mark = $request->sub_id1_mark;
            $mark->sub_id2 = $request->sub_id2;
            $mark->sub_id2_mark = $request->sub_id2_mark;
            $mark->sub_id3 = $request->sub_id3;
            $mark->sub_id3_mark = $request->sub_id3_mark;
            $result = $request->sub_id1_mark + $request->sub_id2_mark + $request->sub_id3_mark;
            $mark->total_mark = $result;
            $result= $mark->save();
            if($result)
            {
                return response()->json([
                    'message'=>"data inserted sucessfully!!!!..",
                    'marks'=>$mark
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
    public function show(mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
{
    $rules = [
        "reg_no" => "required|unique:marks,reg_no,".$id.",id,examid,".$request->examid,
        "examid" => "required|unique:marks,examid,".$id.",id,reg_no,".$request->reg_no,
        "sub_id1" => "required",
        "sub_id1_mark" => "required|numeric|max:100",
        "sub_id2" => "required",
        "sub_id2_mark" => "required|numeric|max:100",
        "sub_id3" => "required",
        "sub_id3_mark" => "required|numeric|max:100"
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 401);
    } else {
        $mark = mark::findorfail($id);
        $mark->reg_no = $request->reg_no;
        $mark->examid = $request->examid;
        $mark->sub_id1 = $request->sub_id1;
        $mark->sub_id1_mark = $request->sub_id1_mark;
        $mark->sub_id2 = $request->sub_id2;
        $mark->sub_id2_mark = $request->sub_id2_mark;
        $mark->sub_id3 = $request->sub_id3;
        $mark->sub_id3_mark = $request->sub_id3_mark;
        $result = $request->sub_id1_mark + $request->sub_id2_mark + $request->sub_id3_mark;
        $mark->total_mark = $result;
        $result= $mark->save();



        if ($result) {
            return response()->json([
                'message' => "Data updated successfully!",
                'marks' => $mark
            ], 200);
        } else {
            return response()->json([
                'message' => "Sorry, something went wrong!"
            ], 500);
        }
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mark = mark::find($id);

        if ($mark) {
            $mark->delete();

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
