<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $flights = Flight::all();
            return response()->json(compact('flights'));
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
            $validator = Validator::make(
                $request->all(),
                [
                    "code" => "required|string|unique:flights",
                    "type" => ['required', Rule::in(['PASSENGER', 'FREIGHT'])],
                    "departure_time" => "required|date|before:today",
                    "arrival_time" => "required|date|after:departure_time",
                    "departure_id" => "required|integer|min:1|exists:airports,id",
                    "destination_id" => "required|integer|min:1|exists:airports,id",
                    "airline_id" => "required|integer|min:1|exists:airlines,id",
                ],
                [
                    'type.in' => 'The type field must be one of the following values: PASSENGER o FREIGHT',
                ]
            );
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $flight = Flight::create($request->all());
    
            return response()->json(['message' => 'Flight created!', 'status' => 'success']);
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
            $flight = Flight::find($id);
            return response()->json(compact('flight'));
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
            $validator = Validator::make(
                $request->all(),
                [
                    "code" => "required|string|unique:flights",
                    "type" => ['required', Rule::in(['PASSENGER', 'FREIGHT'])],
                    "departure_time" => "required|date|after:today",
                    "arrival_time" => "required|date|after:departure_time",
                    "departure_id" => "required|integer|min:1|exists:airports,id",
                    "destination_id" => "required|integer|min:1|exists:airports,id",
                    "airline_id" => "required|integer|min:1|exists:airlines,id",
                ],
                [
                    'type.in' => 'The type field must be one of the following values: PASSENGER o FREIGHT',
                ]
            );
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $flight = Flight::find($id);
            $flight->code = $request->code;
            $flight->type = $request->type;
            $flight->departure_time = $request->departure_time;
            $flight->arrival_time = $request->arrival_time;
            $flight->departure_id = $request->departure_id;
            $flight->destination_id = $request->destination_id;
            $flight->airline_id = $request->airline_id;
            $flight->save();
    
            return response()->json(['message' => 'Flight updated!', 'status' => 'success']);
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
            Flight::destroy($id);

            return response()->json(['message' => 'Flight deleted!', 'status' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
}
