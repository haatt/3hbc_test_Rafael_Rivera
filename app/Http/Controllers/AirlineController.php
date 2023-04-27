<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $airlines = Airline::all();
            return response()->json(compact('airlines'));
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
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
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:60",
                "code" => "required|string|unique:airlines",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $airline = Airline::create($request->all());
    
            return response()->json(['message' => 'Airline created!', 'status' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $airline = Airline::find($id);
            return response()->json(compact('airline'));
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:60",
                "code" => "required|string|unique:airlines",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $airline = Airline::find($id);
            $airline->name = $request->name;
            $airline->code = $request->code;
    
            $airline->save();
    
            return response()->json(['message' => 'Airline updated!', 'status' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Airline::destroy($id);

            return response()->json(['message' => 'Airline deleted!', 'status' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
}
