<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Region;
use App\ResponseMessage;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $regions = Region::all();
        if(count($regions) > 0){
            return response(
                $response = [
                    'data' => $regions,
                    'message' => ResponseMessage::$response201
                ],201
            );
        }else {
            return response(
                $response = [
                    'message' => ResponseMessage::$response404
                ],404
            );
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
        //
        $obj = json_decode($request->getContent());
        $region = new Region();
        return $this->storeRegion($region, $obj);
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
        $region = Region::with('country', 'administrativeZones')->where('id',$id)->first();
        if($region != null){
            $response = [
                'data' => $region,
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
        $region = Region::where('id',$id)->first();
        return $this->storeRegion($region, $obj);
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
        $region = Region::where('id',$id)->first();
        if($region != null){
            if($region->delete()){
                $response = [
                    'data' => $region,
                    'message' => ResponseMessage::$response200
                ];
                return response($response, 201  );
            }else {
                $response = [
                    'message' => ResponseMessage::$response403
                ];
                return response($response, 403);
            }
        }else {
            $response = [
                'message' => ResponseMessage::$response404
            ];
            return response($response, 404);
        }

    }


    public function storeRegion(Region $region, $obj)
    {
        if(isset($obj->name) && isset($obj->country_id)) {

            $country = Country::where('id', $obj->country_id)->first();
            if($country != null){
                $region->country()->associate($country);
                $region->name = $obj->name;
                if ($region->save()) {
                    $response = [
                        'data' => $region,
                        'message' => ResponseMessage::$response200
                    ];
                    return response($response, 200);
                } else {
                    $response = [
                        'message' => ResponseMessage::$response403
                    ];
                    return response($response, 403);
                }
            } else {
                $response = [
                    'message' => ResponseMessage::$response400
                ];
                return response($response, 400);
            }
        } else {
            $response = [
                'message' => ResponseMessage::$response400
            ];
            return response($response, 400);
        }
    }
}
