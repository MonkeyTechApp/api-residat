<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeZone;
use App\Models\Country;
use App\Models\Region;
use App\ResponseMessage;
use Illuminate\Http\Request;

class AdministrativeZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $adminZones = AdministrativeZone::all();
        if(count($adminZones) > 0){
            return response(
                $response = [
                    'data' => $adminZones,
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
        $adminZone = new AdministrativeZone();
        return $this->storeAdminZone($adminZone, $obj);
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
        $adminZone = AdministrativeZone::with('mother', 'children' , 'region')->where('id',$id)->first();
        if($adminZone != null){
            $response = [
                'data' => $adminZone,
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
        $adminZone = AdministrativeZone::where('id',$id)->first();
        return $this->storeAdminZone($adminZone, $obj);
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
        $adminZone = AdministrativeZone::where('id',$id)->first();
        if($adminZone != null){
            if($adminZone->delete()){
                $response = [
                    'data' => $adminZone,
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


    public function storeAdminZone(AdministrativeZone $adminZone, $obj)
    {
        if(isset($obj->name) && isset($obj->region_id)) {

            $region = Region::where('id', $obj->region_id)->first();
            if($region != null){
                $adminZone->region()->associate($region);
                $adminZone->name = $obj->name;
                if(isset($obj->parent_id)){
                    $parentZone = AdministrativeZone::where('id', $obj->parent_id)->first();
                    if($parentZone != null){
                        $adminZone->mother()->associate($parentZone);
                    }
                }
                if ($adminZone->save()) {
                    $response = [
                        'data' => $adminZone,
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
