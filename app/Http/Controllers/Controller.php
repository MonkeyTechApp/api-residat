<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @SWG\Get(
 *   path="/api/testing/{mytest}",
 *   security={
 *     {"passport": {}},
 *   },
 *   summary="Get Testing",
 *   operationId="testing",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *		@SWG\Parameter(
 *          name="mytest",
 *          in="path",
 *          required=true,
 *          type="string"
 *      ),
 * )
 *
 */
/**
 * @OA\Info(title="My First API", version="0.1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
