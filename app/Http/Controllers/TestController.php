<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    /**
     * @OA\Get(
     *   path="/api/testing/{mytest}",
     *   summary="Get Testing",
     *   operationId="testing",
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error"),
     *		@OA\Parameter(
     *          name="mytest",
     *          in="path",
     *          required=true
     *      ),
     * )
     *
     */
    public function index(Request $request){
        echo $request->mytest;
    }
}
