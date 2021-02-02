<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\ResponseMessage;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries = Country::all();
        if($countries != null){
            $response = [
                'data' => $countries,
                'message' => ResponseMessage::$response201
            ];
            return response($response, 201);
        }else {
            $response = [
                'message' => ResponseMessage::$response404
            ];
            return response($response, 404);
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
        // Get the Raw data
        $obj = json_decode($request->getContent());
        $country = new Country();
        return $this->storeCountry($country, $obj);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $country = Country::with('regions.administrativeZones')->where('id',$id)->first();
        if($country != null){
            $response = [
                'data' => $country,
                'message' => ResponseMessage::$response201
            ];
            return response($response, 201);
        }else {
            $response = [
                'message' => ResponseMessage::$response404
            ];
            return response($response, 404);
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
        //
        $obj = json_decode($request->getContent());
        $country = Country::where('id',$id)->first();
        return $this->storeCountry($country, $obj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $country = Country::where('id',$id)->first();
        if($country->delete()){
            $response = [
                'data' => $country,
                'message' => ResponseMessage::$response200
            ];
            return response($response, 200  );
        }else {
            $response = [
                'status' => 404,
                'message' => ResponseMessage::$response404
            ];
            return response($response, 404);
        }
    }

    public function storeCountry(Country $country, $obj){
        if(isset($obj->name)){
            $country->name = $obj->name;
            if($country->save()){
                $response = [
                    'data' => $country,
                    'message' => ResponseMessage::$response201
                ];
                return response($response, 201);
            }else {
                $response = [
                    'message' => ResponseMessage::$response403
                ];
                return response($response, 403);
            }
        }else {
            $response = [
                'message' => ResponseMessage::$response400
            ];
            return response($response, 400);
        }
    }
}
