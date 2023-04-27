<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $airports = Airport::all();
            return response()->json(compact('airports'));
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
                "code" => "required|string|unique:airports",
                "city" => "required|string|max:60",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $airport = Airport::create($request->all());
    
            return response()->json(['message' => 'Airport created!', 'status' => 'success']);
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
            $airport = Airport::find($id);
            return response()->json(compact('airport'));
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
                "code" => "string|unique:airports",
                "city" => "required|string|max:60",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $airport = Airport::find($id);
            $airport->name = $request->name;
            $airport->code = $request->code;
            $airport->city = $request->city;
    
            $airport->save();
    
            return response()->json(['message' => 'Airport updated!', 'status' => 'success']);
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
            Airport::destroy($id);

            return response()->json(['message' => 'Airport deleted!', 'status' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
}
